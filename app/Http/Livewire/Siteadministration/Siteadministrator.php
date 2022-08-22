<?php

namespace App\Http\Livewire\Siteadministration;

use App\Models\Address;
use App\Models\County;
use App\Models\Fileuploadfolder;
use App\Models\Membership;
use App\Models\Person;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Siteadministrator extends Component
{
    public $resetpasswordusername='';
    public $resetpasswordpassword='';
    public $search='';
    public $searchloginas='';
    public $searchschool='';
    public $searchuser='';
    //public $selectedschool=NULL;
    public $selectedschoolname='';
    public $students=NULL;
    public $teachers=NULL;

    private $selectedteachers=[];

    public function mount()
    {
        //$this->selectedschool = NULL;
        //$this->selectedschoolname = '';
        //$this->students=NULL;
        //$this->teachers=NULL;
    }

    public function render()
    {
        if(auth()->id() === 368) {
            return view('livewire.siteadministration.siteadministrator',
                [
                    'persons' => $this->persons(),
                    'schools' => $this->schools(),
                    'loginas' => $this->loginas(),
                    'users' => $this->users(),
                ]);
        }

        auth()->logout();
        return view('login');
    }

    public function switchLogin($value)
    {
        Auth::loginUsingId($value);
        // \Illuminate\Auth\RequestGuard::loginUsingId($value,true);
        //auth()->loginUsingId($value, true);

        $_SESSION['loginas'] = true;
    }

    private function nonsubscriberEmailLookup($lookup)
    {
        foreach(\App\Models\NonsubscriberEmail::all() AS $email){

            if(strtolower($email->email) === strtolower($lookup)){

                dd($email);
            }
        }

        dd('Not Found');
    }

    public function transferStudents()
    {
        //2021-09-21: Add Casey Shields membership, delete second profile for Casey Shields
        //2021-09-20: To Natalie Cardillo FROM Steven Bourque

        //$this->nonsubscriberEmailLookup('mike96k@yahoo.com');
        //$this->updateAddress(8980);
        //self::transferToNewTeacher();
        //self::addToNewTeacher();
        //self::addMembership();
        //$this->deleteDirectorWithPrejudice();

        //2021-09-20
        //County::create([
        //    'name' => 'Unknown',
        //]);

        //DB::table('schools')
        //    ->where('county_id', '=', 1)
        //    ->update([
        //        'county_id' => 22,
        //    ]);

        //2021-09-13
        /*
        DB::table('eventversiondates')
            ->where('eventversion_id', '=', 69)
            ->where('datetype_id', '=', 5)
            ->update(
                [
                    'dt' => '2021-10-01 00:00:01',
                    'updated_at' => '2021-09-13 14:35:45'
                ]);

        DB::table('eventversiondates')
            ->where('eventversion_id', '=', 69)
            ->where('datetype_id', '=', 19)
            ->update(
            [
                'dt' => '2021-10-01 00:00:01',
                'updated_at' => '2021-09-13 14:35:45'
            ]);
        */

        //2021-09-12
        //update filecontent type to 2 (arpeggio) from 5 (solo) for eventversion 69 (all-shore)
        /*
         DB::table('eventversion_filecontenttype')
            ->where('eventversion_id', '=', 69)
            ->where('filecontenttype_id', '=', 5)
            ->update([
                'filecontenttype_id' => 2,
                'title' => 'arpeggio',
            ]);
        */

        //2021-09-11
        //$this->updateFileuploadfolders();

        //2021-09-10
        //add filetypes for SJCDA, All-Shore
        /*
        $eventversions = [66,67,69];
        $filecontenttypes = [1,5,3]; //scales, solo, quartet
        $titles = [NULL,'solo','quartet'];

        foreach($eventversions AS $evid){

            foreach($filecontenttypes AS $key => $fctid){

                //insert record if record not found
                DB::table('eventversion_filecontenttype')
                    ->insert([
                        'eventversion_id' => $evid,
                        'filecontenttype_id' => $fctid,
                        'title' => $titles[$key],
                        'created_at' => '2021-09-10 17:50:50',
                        'updated_at' => '2021-09-10 17:50:50',
                    ]);
            }
        }
        */
        //2021-09-09
        //add instrumentation for jr high chorus (ssaatb)
        /*
        $ids = [63,64,65,66,6,3];
        foreach($ids AS $key => $id) {
            DB::table('eventensembletype_instrumentation')
                ->insert([
                    'eventensembletype_id' => 18,
                    'instrumentation_id' => $id,
                    'order_by' => ($key + 1),
                    'created_at' => '2021-09-09 16:16:16',
                    'updated_at' => '2021-09-09 16:16:16'
                ]);
        }
        //add domain owner to SJCDA
        Membership::updateOrCreate(
            [
                'user_id' => 368,
                'organization_id' => 8,

            ],
            [
                'membershiptype_id' => 1,
                'membership_id' => 'sjcda',
                'expiration' => '2021-09-09',
                'grade_levels' => 'Secondary',
                'subject' => 'chorus',
            ]
        );
        */

        /*
        DB::table('eventversionconfigs')
            ->where('eventversion_id', '=', '65')
            ->update([
                'paypalteacher' => 0,
                'paypalstudent' => 0,
            ]);
        */
/*
        DB::table('eventversionconfigs')
            ->where('eventversion_id', '=', '65')
            ->update([
                'audiofiles' => 1,
                'virtualaudition' => 1,
            ]);

        DB::table('eventversionconfigs')
            ->where('eventversion_id', '=', '66')
            ->update([
                'eapplication' => 1,
                'audiofiles' => 1,
                'virtualaudition' => 1,
            ]);

        DB::table('eventversionconfigs')
            ->where('eventversion_id', '=', '67')
            ->update([
                'eapplication' => 1,
                'audiofiles' => 1,
                'virtualaudition' => 1,
            ]);

        DB::table('eventversionconfigs')
            ->where('eventversion_id', '=', '68')
            ->update([
                'eapplication' => 1,
                'virtualaudition' => 1,
                'audiofiles' => 1,
            ]);

        DB::table('eventversionconfigs')
            ->where('eventversion_id', '=', '69')
            ->update([
                'audiofiles' => 1,
                'virtualaudition' => 1,
            ]);
*/

        /*$studentuserids = [3610,3639,3583,3568,1267,3628,3561,2817];

        foreach($studentuserids AS $id){
            DB::table('student_teacher')
                ->where('student_user_id', '=', $id)
                ->where('teacher_user_id', '=', 54)
                ->update(['teacher_user_id' => 8495]);
        }*/

        //Kai Cleary for West Morris Central: Mark Stingle
        /*DB::table('school_user')
            ->insert([
                'user_id' => 8497,
                'school_id' => 3547
            ]);

        DB::table('student_teacher')
            ->insert([
                'student_user_id' => 8497,
                'teacher_user_id' =>324,
                'created_at' => '2021-09-07 07:48:00',
                'updated_at' => '2021-09-07 07:48:00'
            ]);
        */
    }

    private function addMembership()
    {
        $allshore = ['id' => 9,'label' => 'allshore'];
        $sjcda = ['id' => 8,'label' => 'sjcda'];
        $njmea = ['id' => 3,'label' => 'njmea'];
        $cardilloNatalie = 8525;
        $johnsonCaela = 8496;
        $shieldsCasey = 8708;
        $scireCiera = 8495;

        $user_id = $johnsonCaela;

        //add domain owner to organization
        Membership::updateOrCreate(
            [
                'user_id' => $user_id,
                'organization_id' => $njmea['id'],

            ],
            [
                'membershiptype_id' => 1,
                'membership_id' => $njmea['label'],
                'expiration' => '2021-09-09',
                'grade_levels' => 'Secondary',
                'subject' => 'chorus',
            ]
        );

        Membership::updateOrCreate(
            [
                'user_id' => $user_id,
                'organization_id' => $sjcda['id'],

            ],
            [
                'membershiptype_id' => 1,
                'membership_id' => $sjcda['label'],
                'expiration' => '2021-09-09',
                'grade_levels' => 'Secondary',
                'subject' => 'chorus',
            ]
        );
    }

    private function addToNewTeacher()
    {
        $howellhs = [1604,2160]; //howell high school
        $ridgehs = [3492,1752,2676,3519,524,840];

        $shieldsCasey = 8708;
        $beadleCarol = 8454;

        $studentids = $ridgehs;
        $teacher_user_id = $beadleCarol;

        foreach($studentids AS $id){
            DB::table('student_teacher')
                ->insert([
                    'student_user_id' => $id,
                    'teacher_user_id' => $teacher_user_id,
                    'studenttype_id' => 7, //active
                    'created_at' => '2021-09-21 08:40:40',
                    'updated_at' => '2021-09-21 08:40:40',
                ]);
        }

    }

    /**
     * Francis,Maureen mfrancismfrancis567 8712
     */
    private function deleteDirectorWithPrejudice()
    {
        $id_user = 8712;

        DB::table('userconfigs')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('tenures')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('teachers')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('signatures')
            ->where('confirmed', '=',$id_user)
            ->delete();

        DB::table('student_teacher')
            ->where('teacher_user_id', '=',$id_user)
            ->delete();

        DB::table('subscriberemails')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('school_user')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('roles')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('phones')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('people')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('payments')
            ->where('updated_by', '=',$id_user)
            ->delete();

        DB::table('organization_user')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('obligations')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('memberships')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('instrumentation_user')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('guardian_student')
            ->where('guardian_user_id', '=',$id_user)
            ->delete();

        DB::table('guardians')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('gradetype_school_user')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('eventversionteacherconfigs')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('applications')
            ->where('updated_by', '=',$id_user)
            ->delete();

        DB::table('addresses')
            ->where('user_id', '=',$id_user)
            ->delete();

        DB::table('users')
            ->where('id', '=',$id_user)
            ->delete();

    }

    private function transferToNewTeacher()
    {
        $beadleFromRetzko = [3492,1752,2676,3519,524,840];
        $cardilloFromBourque = [1085,2996,3395,3212,2849,2274];
        $johnsonFromKnight = [7539,7538,1751,1044];
        $johnsonFromTkachenko = [1155,2482,2639,2847,472,7488,3079,813,1657,7949,711,990,919,1921,3167,1005,2284,1137,7489,585,7512,7490,7491,2352,1858,2868];

        $beadleCarol = 8454;
        $johnsonCaela = 8496;
        $knightHope = 164;
        $natalieCarillo = 8525;
        $retzkoBarbara = 45;
        $stevenBourque = 386;
        $tkachenkoSergi = 411;

        $studentids = $johnsonFromKnight;
        $from_teacher_user_id = $knightHope;
        $to_teacher_user_id = $johnsonCaela;

        foreach($studentids AS $id){
            DB::table('student_teacher')
                ->where('student_user_id', '=', $id)
                ->where('teacher_user_id', '=', $from_teacher_user_id)
                ->update(['teacher_user_id' => $to_teacher_user_id]);
        }

        $studentids2 = $johnsonFromTkachenko;
        $from_teacher_user_id2 = $tkachenkoSergi;
        $to_teacher_user_id2 = $johnsonCaela;

        foreach($studentids2 AS $id){
            DB::table('student_teacher')
                ->where('student_user_id', '=', $id)
                ->where('teacher_user_id', '=', $from_teacher_user_id2)
                ->update(['teacher_user_id' => $to_teacher_user_id2]);
        }

    }

    public function updateAddress($user_id)
    {
        $address = Address::find($user_id);

        $address->update([
            'address01' => '',
            'address02' => '',
            'city' => '',
            'geostate_id' => 37,
            'postalcode' => '',
        ]);
    }

    public function updatePassword()
    {
        $user = User::where('username', $this->resetpasswordusername)->first();
        $user->forceFill([
            'password' => Hash::make($this->resetpasswordpassword),
        ])->save();
    }

    public function updateSchool($value)
    {
        $this->selectedschool = School::find($value);
        $this->selectedschoolname = ($this->selectedschool ? $this->selectedschool->name : '');
        $this->students = $this->selectedschool->currentStudents;
        $this->teachers = $this->selectedschool->teachersForTransfer();
        //$this->reset('searchschool');
    }

    public function updatedSearch($value)
    {
        //$this->reset(['selectedschool','selectedschoolname', 'teachers']);

        //$this->render();
    }

    public function updatedSearchloginas()
    {
        //dd('as: '.$this->searchloginas);
    }

    public function updatedSearchschool()
    {
        //$this->reset('search','selectedschool','selectedschoolname','selectedteachers','students','teachers');

        //$this->render();
    }

    public function updateSelectedTeachers($value)
    {
        $this->selectedteachers[] = $value;
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private function updateFileuploadfolders()
    {
        $seeds = [
            //SJCDA SR High
            ['bd95dabc1210e630',66,63,5,NULL,'sjcda-sr-master'],
            ['3595dabc1210eeb8',66,63,3,'bd95dabc1210e630','sjcda-sr-si'],
            ['4e95dabc121de8c3',66,63,3,'3595dabc1210eeb8','sjcda-sr-si-quartet'],
            ['7995dabc121deff4',66,63,1,'3595dabc1210eeb8','sjcda-sr-si-scales'],
            ['a895dabc121dee25',66,63,5,'3595dabc1210eeb8','sjcda-sr-si-solo'],
            ['6495dabc1210efe9',66,64,3,'bd95dabc1210e630','sjcda-sr-sii'],
            ['6495dabc121ce3e9',66,64,3,'6495dabc1210efe9','sjcda-sr-sii-quartet'],
            ['bd95dabc121deb30',66,64,1,'6495dabc1210efe9','sjcda-sr-sii-scales'],
            ['ec95dabc121dea61',66,64,5,'6495dabc1210efe9','sjcda-sr-sii-solo'],
            ['bd95dabc1211e730',66,65,3,'bd95dabc1210e630','sjcda-sr-ai'],
            ['db95dabc121cec56',66,65,3,'bd95dabc1211e730','sjcda-sr-ai-quartet'],
            ['0a95dabc121ced87',66,65,1,'bd95dabc1211e730','sjcda-sr-ai-scales'],
            ['3595dabc121ce2b8',66,65,5,'bd95dabc1211e730','sjcda-sr-ai-solo'],
            ['ec95dabc1211e661',66,66,3,'bd95dabc1210e630','sjcda-sr-aii'],
            ['4e95dabc121ce9c3',66,66,3,'ec95dabc1211e661','sjcda-sr-aii-quartet'],
            ['7995dabc121ceef4',66,66,1,'ec95dabc1211e661','sjcda-sr-aii-scales'],
            ['a895dabc121cef25',66,66,5,'ec95dabc1211e661','sjcda-sr-aii-solo'],
            ['1f95dabc1211e592',66,67,3,'bd95dabc1210e630','sjcda-sr-ti'],
            ['bd95dabc121cea30',66,67,3,'1f95dabc1211e592','sjcda-sr-ti-quartet'],
            ['ec95dabc121ceb61',66,67,1,'1f95dabc1211e592','sjcda-sr-ti-scales'],
            ['1f95dabc121ce892',66,67,5,'1f95dabc1211e592','sjcda-sr-ti-solo'],
            ['4e95dabc1211e4c3',66,68,3,'bd95dabc1210e630','sjcda-sr-tii'],
            ['0a95dabc1213e287',66,68,3,'4e95dabc1211e4c3','sjcda-sr-tii-quartet'],
            ['3595dabc1213edb8',66,68,1,'4e95dabc1211e4c3','sjcda-sr-tii-scales'],
            ['6495dabc1213ece9',66,68,5,'4e95dabc1211e4c3','sjcda-sr-tii-solo'],
            ['7995dabc1211e3f4',66,69,3,'bd95dabc1210e630','sjcda-sr-bi'],
            ['7995dabc1213e1f4',66,69,3,'7995dabc1211e3f4','sjcda-sr-bi-quartet'],
            ['a895dabc1213e025',66,69,1,'7995dabc1211e3f4','sjcda-sr-bi-scales'],
            ['db95dabc1213e356',66,69,5,'7995dabc1211e3f4','sjcda-sr-bi-solo'],
            ['a895dabc1211e225',66,70,3,'bd95dabc1210e630','sjcda-sr-bii'],
            ['ec95dabc1213e461',66,70,3,'a895dabc1211e225','sjcda-sr-bii-quartet'],
            ['1f95dabc1213e792',66,70,1,'a895dabc1211e225','sjcda-sr-bii-scales'],
            ['4e95dabc1213e6c3',66,70,5,'a895dabc1211e225','sjcda-sr-bii-solo'],
            //SJCDA Junior High
            ['ec95dabc1210e761',67,63,3,NULL,'sjcda-jr-master'],
            ['1f95dabc1210e492',67,63,3,'ec95dabc1210e761','sjcda-jr-si'],
            ['3595dabc1212ecb8',67,63,3,'1f95dabc1210e492','sjcda-jr-si-quartet'],
            ['6495dabc1212ede9',67,63,1,'1f95dabc1210e492','sjcda-jr-si-scales'],
            ['bd95dabc1213e530',67,63,5,'1f95dabc1210e492','sjcda-jr-si-solo'],
            ['4e95dabc1210e5c3',67,64,3,'ec95dabc1210e761','sjcda-jr-sii'],
            ['a895dabc1212e125',67,64,3,'4e95dabc1210e5c3','sjcda-jr-sii-quartet'],
            ['db95dabc1212e256',67,64,1,'4e95dabc1210e5c3','sjcda-jr-sii-scales'],
            ['0a95dabc1212e387',67,64,5,'4e95dabc1210e5c3','sjcda-jr-sii-solo'],
            ['7995dabc1210e2f4',67,65,3,'ec95dabc1210e761','sjcda-jr-ai'],
            ['bd95dabc1315e230',67,65,3,'7995dabc1210e2f4','sjcda-jr-ai-quartet'],
            ['ec95dabc1315e361',67,65,1,'7995dabc1210e2f4','sjcda-jr-ai-scales'],
            ['1f95dabc1315e092',67,65,5,'7995dabc1210e2f4','sjcda-jr-ai-solo'],
            ['a895dabc1210e325',67,66,3,'ec95dabc1210e761','sjcda-jr-aii'],
            ['1f95dabc1212e692',67,66,3,'a895dabc1210e325','sjcda-jr-aii-quartet'],
            ['4e95dabc1212e7c3',67,66,1,'a895dabc1210e325','sjcda-jr-aii-scales'],
            ['7995dabc1212e0f4',67,66,5,'a895dabc1210e325','sjcda-jr-aii-solo'],
            ['db95dabc1210e056',67,6,3,'ec95dabc1210e761','sjcda-jr-t'],
            ['6495dabc1211eee9',67,6,3,'db95dabc1210e056','sjcda-jr-t-quartet'],
            ['bd95dabc1212e430',67,6,1,'db95dabc1210e056','sjcda-jr-t-scales'],
            ['ec95dabc1212e561',67,6,5,'db95dabc1210e056','sjcda-jr-t-solo'],
            ['0a95dabc1210e187',67,3,3,'ec95dabc1210e761','sjcda-jr-b'],
            ['db95dabc1211e156',67,3,3,'0a95dabc1210e187','sjcda-jr-b-quartet'],
            ['0a95dabc1211e087',67,3,1,'0a95dabc1210e187','sjcda-jr-b-scales'],
            ['3595dabc1211efb8',67,3,5,'0a95dabc1210e187','sjcda-jr-b-solo'],
            //NJ All-Shore
            ['4e95dabc1315e1c3',69,63,2,NULL,'njallshore-master'],
            ['7995dabc1315e6f4',69,63,2,'4e95dabc1315e1c3','njallshore-si'],
            ['7995dabc1314e7f4',69,63,2,'7995dabc1315e6f4','njallshore-si-arpeggio'],
            ['4e95dabc1314e0c3',69,63,3,'7995dabc1315e6f4','njallshore-si-quartet'],
            ['1f95dabc1314e192',69,63,1,'7995dabc1315e6f4','njallshore-si-scales'],
            ['a895dabc1315e725',69,64,2,'4e95dabc1315e1c3','njallshore-sii'],
            ['0a95dabc1314e487',69,64,2,'a895dabc1315e725','njallshore-sii-arpeggio'],
            ['db95dabc1314e556',69,64,3,'a895dabc1315e725','njallshore-sii-quartet'],
            ['a895dabc1314e625',69,64,1,'a895dabc1315e725','njallshore-sii-scales'],
            ['db95dabc1315e456',69,65,2,'4e95dabc1315e1c3','njallshore-ai'],
            ['bd95dabc1317e030',69,65,2,'db95dabc1315e456','njallshore-ai-arpeggio'],
            ['6495dabc1314eae9',69,65,3,'db95dabc1315e456','njallshore-ai-quartet'],
            ['3595dabc1314ebb8',69,65,1,'db95dabc1315e456','njallshore-ai-scales'],
            ['0a95dabc1315e587',69,66,2,'4e95dabc1315e1c3','njallshore-aii'],
            ['4e95dabc1317e3c3',69,66,2,'0a95dabc1315e587','njallshore-aii-arpeggio'],
            ['1f95dabc1317e292',69,66,3,'0a95dabc1315e587','njallshore-aii-quartet'],
            ['ec95dabc1317e161',69,66,1,'0a95dabc1315e587','njallshore-aii-scales'],
            ['3595dabc1315eab8',69,67,2,'4e95dabc1315e1c3','njallshore-ti'],
            ['db95dabc1317e656',69,67,2,'3595dabc1315eab8','njallshore-ti-arpeggio'],
            ['a895dabc1317e525',69,67,3,'3595dabc1315eab8','njallshore-ti-quartet'],
            ['7995dabc1317e4f4',69,67,1,'3595dabc1315eab8','njallshore-ti-scales'],
            ['6495dabc1315ebe9',69,68,2,'4e95dabc1315e1c3','njallshore-tii'],
            ['6495dabc1317e9e9',69,68,2,'6495dabc1315ebe9','njallshore-tii-arpeggio'],
            ['3595dabc1317e8b8',69,68,3,'6495dabc1315ebe9','njallshore-tii-quartet'],
            ['0a95dabc1317e787',69,68,1,'6495dabc1315ebe9','njallshore-tii-scales'],
            ['bd95dabc1314e330',69,69,2,'4e95dabc1315e1c3','njallshore-bi'],
            ['1f95dabc1316e392',69,69,2,'bd95dabc1314e330','njallshore-bi-arpeggio'],
            ['ec95dabc1316e061',69,69,3,'bd95dabc1314e330','njallshore-bi-quartet'],
            ['bd95dabc1316e130',69,69,1,'bd95dabc1314e330','njallshore-bi-scales'],
            ['ec95dabc1314e261',69,70,2,'4e95dabc1315e1c3','njallshore-bii'],
            ['a895dabc1316e425',69,70,2,'ec95dabc1314e261','njallshore-bii-arpeggio'],
            ['7995dabc1316e5f4',69,70,3,'ec95dabc1314e261','njallshore-bii-quartet'],
            ['4e95dabc1316e2c3',69,70,1,'ec95dabc1314e261','njallshore-bii-scales'],

        ];

        foreach($seeds AS $seed){

            Fileuploadfolder::updateOrCreate(
                [
                    'folder_id' => $seed[0],
                    'eventversion_id' => $seed[1],
                    'instrumentation_id' => $seed[2],
                    'filecontenttype_id' => $seed[3],
                ],
                [
                    'parent_id' => $seed[4],
                    'name' => $seed[5],
                ],
            );
        }
    }

    private function loginas()
    {
        //early exit
        if(! strlen($this->searchloginas)){ return collect(); }

        $likevalue = '%'.$this->searchloginas.'%';

        return Person::where('last','LIKE', $likevalue)
            ->orWhere('first', 'LIKE', $likevalue)
            ->limit(40)
            ->get()
            ->sortBy(['person.last','person.first']);
    }

    private function persons()
    {
        //early exit
        if(! strlen($this->search)){ return collect(); }

        $likevalue = '%'.$this->search.'%';

        return Person::where('last','LIKE', $likevalue)
            ->orWhere('first', 'LIKE', $likevalue)
            ->limit(40)
            ->get()
            ->sortBy(['person.last','person.first']);
    }

    private function schools()
    {
        //early exit
        if(! strlen($this->searchschool)){ return collect(); }

        $likevalue = '%'.$this->searchschool.'%';

        return School::where('name','LIKE', $likevalue)
            ->limit(40)
            ->get()
            ->sortBy(['name', 'city']);
    }

    private function users()
    {
        //early exit
        if(! strlen($this->searchuser)){ return collect(); }

        $likevalue = '%'.$this->searchuser.'%';

        return User::where('username','LIKE', $likevalue)
            ->limit(40)
            ->get()
            ->sortBy(['username']);
    }


}
