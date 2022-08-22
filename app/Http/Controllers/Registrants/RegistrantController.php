<?php

namespace App\Http\Controllers\Registrants;

use App\Http\Controllers\Controller;
use App\Models\Eapplication;
use App\Models\Eventversion;
use App\Models\Fileserver;
use App\Models\Fileuploadfolder;
use App\Models\Registrant;
use App\Models\Userconfig;
use App\Traits\UpdateRegistrantStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class RegistrantController extends Controller
{
    use UpdateRegistrantStatusTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Registrant
     * @return Response
     */
    public function show(Registrant $registrant)
    {
        $eventversion = Eventversion::find(Userconfig::getValue('eventversion',auth()->id()));
        $fileserver = new Fileserver($registrant);

        $folders = $this->getFolders($eventversion, $registrant);

        $sjcdaeapplicationshutdown = (Carbon::now() > '2021-10-19 23:59:59');

        $uploadspermitted = !(($eventversion->id === 66) || ($eventversion->id === 67));
        
        $instrumentations = ($eventversion->id != 73)
            ? $eventversion->eventensembles()->first()->eventensembletype()->instrumentations
            : (($registrant->student->grade < 9)
                ? $eventversion->eventensembles()[0]->eventensembletype()->instrumentations
                : $eventversion->eventensembles()[1]->eventensembletype()->instrumentations);

        return view('registrants.registrant.show', [
            'eventversion' => $eventversion,
            'filename' => $fileserver->buildFilename($registrant),
            'fileserver' => $fileserver,
            'folders' => $folders,
            'registrant' => $registrant,
            'countsignatures' => $this->countSignatures($eventversion, $registrant),
            'sjcdaeapplicationshutdown' => $sjcdaeapplicationshutdown,
            'exception' => $this->exceptions(),
            'uploadspermitted' => $uploadspermitted,
            'instrumentations' => $instrumentations,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Registrant $registrant
     * @return Response
     */
    public function update(Request $request, Registrant $registrant)
    {
        $data = $request->validate([
            'programname' => ['string','required'],
            'instrumentations' => ['array','required'],
            'instrumentations.*' => ['numeric'],
            'instrumentations.0' => ['required'],
        ]);

        $registrant->programname = $data['programname'];

        $registrant->save();

        $registrant->instrumentations()->sync($data['instrumentations']);

        $registrant->refresh();

        $this->updateRegistrantStatus($registrant);

        $sjcdaeapplicationshutdown = (Carbon::now() > '2021-10-19 23:59:59');

        $eventversion = Eventversion::find($registrant->eventversion_id);
        $fileserver = new Fileserver($registrant);
        $folders = $this->getFolders($eventversion, $registrant);

        /**
         * @todo fix this to repair the commented code.
         * When moved into production, it produced a fatal error on hitting a null eventversiondates value
         */
        $uploadspermitted = !(($eventversion->id === 66) || ($eventversion->id === 67));

        //$uploadspermitted = true; //(Carbon::now() < $eventversion->eventversiondates->where('datetype_id', \App\Models\Datetype::VIDEOS_CLOSE_MEMBERSHIP)->first()->dt);

        $instrumentations = ($eventversion->id != 73)
            ? $eventversion->eventensembles()->first()->eventensembletype()->instrumentations
            : (($registrant->student->grade < 9)
                ? $eventversion->eventensembles()[0]->eventensembletype()->instrumentations
                : $eventversion->eventensembles()[1]->eventensembletype()->instrumentations);
        
        return view('registrants.registrant.show', [
            'eventversion' => $eventversion,
            'filename' => $fileserver->buildFilename($registrant),
            'fileserver' => $fileserver,
            'folders' => $folders,
            'registrant' => $registrant,
            'countsignatures' => $this->countSignatures($registrant->eventversion, $registrant),
            'sjcdaeapplicationshutdown' => $sjcdaeapplicationshutdown,
            'exception' => $this->exceptions(),
            'uploadspermitted' => $uploadspermitted,
            'instrumentations' => $instrumentations,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    private function countSignatures(Eventversion $eventversion, Registrant $registrant)
    {
        //early exit
        if(! $eventversion->eventversionconfigs->eapplication){ return 0;}

        $cntr = 0;

        $eapplication = Eapplication::find($registrant->id);

        $cntr += $eapplication ? $eapplication->signatureguardian : 0;
        $cntr += $eapplication ? $eapplication->signaturestudent : 0;

        return $cntr;
    }

    /**
     * Return boolean true if auth()->id() meets exception
     */
    private function exceptions()
    {
        $exception = false;

        //2022-23 NJ All-State
        $users = [180,9136,10125]; //John Wilson, Matt Wolf, Blaze Dalio
        if(in_array(auth()->id(), $users) &&
            (Carbon::now() > '2022-04-04 00:00:01') &&
            (Carbon::now() < '2022-04-04 23:59:59')
        ){
            $exception = true;
        }

        //pre-2022-23 NJ All-State
        //Patrick Carpenter
        if((auth()->id() === 8460) &&
            (Carbon::now() > '2021-10-25 00:00:01') &&
            (Carbon::now() < '2021-10-26 23:59:59')){

            $exception = true;
        }

        //Katherine Teall
        if((auth()->id() === 252) &&
            (Carbon::now() > '2021-10-27 13:30:01') &&
            (Carbon::now() < '2021-10-29 23:59:59')){

            $exception = true;
        }

        return $exception;
    }

    private function getFolders(Eventversion $eventversion, Registrant $registrant)
    {
        //early exit
        if(! $registrant->instrumentations->count()){ return collect();}

        if($registrant->instrumentations->count() === 1){

            return Fileuploadfolder::where('eventversion_id', $eventversion->id)
                ->where('instrumentation_id', $registrant->instrumentations->first()->id)
                ->get();
        }

        return Fileuploadfolder::where('eventversion_id', $eventversion->id)
            ->whereIn('instrumentation_id', $registrant->instrumentations)
            ->get();

    }
}
