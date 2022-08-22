<?php

namespace App\Http\Controllers\Registrants;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\County;
use App\Models\Estimateform;
use App\Models\Eventversion;
use App\Models\Membership;
use App\Models\Registrant;
use App\Models\School;
use App\Models\Teacher;
use App\Models\Userconfig;
use App\Models\Utility\Paypalregister;
use App\Models\Utility\Registrants;
use App\Models\Utility\RegistrantsByInstrumentation;
use App\Traits\MembershipcardUrlTrait;
use Barryvdh\DomPDF\Facade AS PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegistrantEstimateFormController extends Controller
{
    use MembershipcardUrlTrait;

    /**
     * PDF download of application
     *
     * @todo Test screen display and printing of membership card
     *
     * @param  Registrant
     * @return Response
     */
    public function download(Eventversion $eventversion)
    {
        $teacher = Teacher::find(auth()->id());
        $school = School::find(Userconfig::getValue('school',auth()->id()));

        $filename = self::build_Filename($eventversion, $school); //ex: "2021_NJASC_2021_Cinnaminson.pdf"
        $me = auth()->user();

        $registrants = Registrants::registered();
        $rbi = new RegistrantsByInstrumentation;
        $registrantsbyinstrumentation = $rbi->getArray();

        //used for NJ All-State Chorus
        $sendto = $this->sendTo($school->county_id);

        $landscapeportrait = (($eventversion->event->id === 11) || ($eventversion->event->id === 12)) //SJCDA
            ? 'landscape'
            : 'portrait';

        $paypalregister = new Paypalregister;
        $paypalregister->setEventversion($eventversion);
        $paypalcollected = $paypalregister->paymentsBySchool($school);

        $amountduegross = ($registrants->count() * $eventversion->eventversionconfigs->registrationfee);
        $amountduenet = ($paypalcollected < $amountduegross) ? ($amountduegross - $paypalcollected) : 0;

        $maxcount = $eventversion->eventversionconfigs->max_count ?: array_sum($registrantsbyinstrumentation);

        $maxcounterror = (! $eventversion->eventversionconfigs->max_count)
            ? false
            : (array_sum($registrantsbyinstrumentation) > $eventversion->eventversionconfigs->max_count);

        $uppervoices = [1,5,63,64,65,66]; //Alto, Soprano, Soprano I, II, Alto I, II
        $uppervoicecount = 0;
        foreach($registrantsbyinstrumentation AS $key => $value){

            if(in_array($key, $uppervoices)){

                $uppervoicecount += $registrantsbyinstrumentation[$key];
            }
        }

        $maxuppervoiceerror = (! $eventversion->eventversionconfigs->max_uppervoice_count)
            ? false
            : ($uppervoicecount > $eventversion->eventversionconfigs->max_uppervoice_count);

        $membership = Membership::where('user_id', auth()->id())
            ->where('organization_id', Userconfig::getValue('organization', auth()->id()))
            ->first();

        $membership_card_url = $this->membershipcardurl($membership);

        //ex. pages.pdfs.applications.12.64.application
        $pdf = PDF::loadView('pdfs.estimateforms.'//9.65.2021_22_application',
            . $eventversion->event->id
            .'.'
            . $eventversion->id
            . '.estimateform',
            compact('eventversion', 'teacher', 'school', 'me', 'registrants',
                'registrantsbyinstrumentation', 'sendto','paypalcollected', 'amountduenet',
                'maxcount', 'maxcounterror','maxuppervoiceerror','membership','membership_card_url')
        )->setPaper('letter', $landscapeportrait);

        //log application printing
        Estimateform::create([
            'user_id' => auth()->id(),
        ]);

        return $pdf->download($filename);
    }

    /**
     * Display the specified resource.
     *
     * @param  Registrant
     * @return Response
     */
    public function show(Eventversion $eventversion)
    {
        $registrants = Registrants::registered();
        $registrantsbyinstrumentation = new RegistrantsByInstrumentation;
        $registrantsbyinstrumentationarray = $registrantsbyinstrumentation->getArray();

        $counties = ($eventversion->id === 65) ? County::all() : collect();

        $school = School::find(Userconfig::getValue('school', auth()->id()));

        $paypalregister = new Paypalregister;
        $paypalregister->setEventversion($eventversion);
        $paypalcollected = $paypalregister->paymentsBySchool($school);

        $amountduegross = ($registrants->count() * $eventversion->eventversionconfigs->registrationfee);
        $amountduenet = ($paypalcollected < $amountduegross) ? ($amountduegross - $paypalcollected) : 0;

        $maxcounterror = (! $eventversion->eventversionconfigs->max_count)
            ? false
            : (array_sum($registrantsbyinstrumentation->getArray()) > $eventversion->eventversionconfigs->max_count);

        $uppervoices = [63,64,65,66]; //Soprano I, II, Alto I, II
        $uppervoicecount = 0;
        foreach($registrantsbyinstrumentationarray AS $key => $value){

            if(in_array($key, $uppervoices)){

                $uppervoicecount += $registrantsbyinstrumentationarray[$key];
            }
        }

        $maxuppervoiceerror = (! $eventversion->eventversionconfigs->max_uppervoice_count)
            ? false
            : ($uppervoicecount > $eventversion->eventversionconfigs->max_uppervoice_count);

        $membership = Membership::where('user_id', auth()->id())
            ->where('organization_id', Userconfig::getValue('organization', auth()->id()))
            ->first() ?? false;

        $membership_card_url = $this->membershipcardurl($membership);

        return view('registrants.estimateforms.'.$eventversion->event->id.'.'.$eventversion->id.'.show',
            [
                'amountduenet' => $amountduenet,
                'eventversion' => $eventversion,
                'registrants' => $registrants,
                'registrantsbyinstrumentation' => $registrantsbyinstrumentationarray,
                'school' => $school,
                'counties' => $counties,
                'updated' => false,
                'sendto' => $this->sendTo($school->county_id),
                'paypalcollected' => $paypalcollected,
                'maxcounterror' => $maxcounterror,
                'maxuppervoiceerror' => $maxuppervoiceerror,
                'maxcount' => $eventversion->eventversionconfigs->max_count ?: array_sum($registrantsbyinstrumentationarray),
                'membership' => $membership,
                'membership_card_url' => $membership_card_url,
            ]);
    }

    public function update(Request $request)
    {
        $registrantsbyinstrumentation = new RegistrantsByInstrumentation;

        $school = School::find(Userconfig::getValue('school', auth()->id()));
        $school->county_id = $request['county_id'];
        $school->save();

        $eventversion = Eventversion::find(Userconfig::getValue('eventversion', auth()->id()));
        $counties = ($eventversion->id === 65) ? County::all() : collect();

        return view('registrants.estimateforms.'.$eventversion->event->id.'.'.$eventversion->id.'.show',
            [
                'eventversion' => $eventversion,
                'registrants' => Registrants::registered(),
                'registrantsbyinstrumentation' => $registrantsbyinstrumentation->getArray(),
                'school' => $school->fresh(),
                'counties' => $counties,
                'updated' => true,
                'sendto' => $this->sendTo($school->county_id),
            ]);
    }


    /**
     * @since 2021.08.16
     *
     * @param Eventversion $eventversion
     * @param School $school
     * @return string ex: SJCDA_Sr_High_2021_Cinnaminson.pdf
     */
    private function build_Filename(Eventversion $eventversion, School $school) : string
    {
        return str_replace(' ', '_', //'2022_NJASC_2022_BhargavaV(2022).pdf';
                str_replace('.', '', $eventversion->short_name))
            . '_'
            . $eventversion->senior_class_of
            . '_'
            . substr($school->shortName, 0, 10)
            . '.pdf';
    }

    private function registrationManagers()
    {
        return [
            [
                'name' => 'BARBARA RETZKO',
                'address01' => '45 Dayton Crescent',
                'address02' => 'Bernardsville, NJ 07924',
                'address03' => '',
                'email' => '<a href="mailto:barbararetzko@hotmail.com" class="text-blue-600">Barbararetzko@hotmail.com</a>'
            ],
            [
                'name' => 'CHERYL BREITZMAN',
                'address01' => '332 N. Leipzig Avenue',
                'address02' => 'Egg Harbor City, NJ 08215',
                'address03' => '',
                'email' => '<a href="mailto:cherylbreitzman@gmail.com" class="text-blue-600">Cherylbreitzman@gmail.com</a>',
            ],
            [
                'name' => 'KRISTEN MARKOWSKI',
                'address01' => '562 Parsippany Blvd',
                'address02' => 'Booton, NJ 07005',
                'address03' => '',
                'email' => '<a href="mailto:kristen.markowski@montville.net" class="text-blue-600">Kristen.markowski@montville.net</a>',
            ],
            [
                'name' => 'VIRAJ LAL',
                'address01' => 'NEWARK ACADEMY',
                'address02' => '91 South Orange Avenue',
                'address03' => 'Livingston, NJ 07039',
                'email' => '<a href="mailto:vlal@newarka.edu" class="text-blue-600">Vlal@newarka.edu</a>',
            ],
        ];
    }

    private function pathApplication(Registrant $registrant)
    {
        return $path='applications/'
            .$registrant->eventversion->event->id
            .'/'
            .$registrant->eventversion->id
            .'/application';
    }

    private function sendTo($county_id)
    {
        $registrationmanagers = $this->registrationManagers();

        //counties by registration manager
        $rm_counties = [
            0 => [1,6,7,9,15,17,19],
            1 => [4,11,12,16,20],
            2 => [5,8,10,13,21],
            3 => [2,3,14,18],
        ];

        foreach($rm_counties AS $rm => $counties){

            if(in_array($county_id, $counties)){

                return $registrationmanagers[$rm];
            }
        }

        //default
        return $registrationmanagers[0];
    }
}
