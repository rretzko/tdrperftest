<?php

namespace App\Http\Controllers\Ensembles;

use App\Http\Controllers\Controller;
use App\Imports\EnsemblemembersImport;
use App\Models\Ensemble;
use App\Models\Ensemblemember;
use App\Models\Schoolyear;
use App\Models\User;
use App\Models\Userconfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MembersController extends Controller
{
    public function index(Ensemble $ensemble)
    {
        $schoolyear_id = Userconfig::getValue('schoolyear_id', auth()->id());

        Userconfig::setValue('ensemble_id', auth()->id(), $ensemble->id);

        return view('ensembles.members.index',
            [
                'ensemble' => $ensemble,
                'countmembers' => Ensemblemember::with('person')
                    ->where('ensemble_id', $ensemble->id)
                    ->where('schoolyear_id', $schoolyear_id)
                    ->count(),
                'schoolyear' => Schoolyear::find($schoolyear_id),
            ]);
    }

        public function import(Request $request)
        {
            Userconfig::setValue('schoolyear_id', auth()->id(), $request['schoolyear_id']);

            $path = $request->file('ensemblemembers_csv')->storeAs('ensemblemembers',auth()->id().'_'.strtotime('NOW').'.csv');
            $res = fopen('../storage/app/'.($path), 'r');
            $headerrow = 1;
            $import = new EnsemblemembersImport();
            $ensemble_id = $import->ensemble_id;
            $schoolyear_id = $import->schoolyear_id;
            $cntr=0;
           while($row = fgetcsv($res)){
                //don't use first row
                if($headerrow){
                    $import->setColumnHeaders($row);
                    $headerrow = 0;
                }else{
                    //process add rows with data
                    $import->onRow($row);
                    $cntr++;
                }
            }

            return view('ensembles.members.index',
                [
                    'ensemble' => Ensemble::find($ensemble_id),
                    'countmembers' => Ensemblemember::with('person')
                        ->where('ensemble_id',$ensemble_id)
                        ->where('schoolyear_id', $schoolyear_id)
                        ->count(),
                    'schoolyear' => Schoolyear::find($schoolyear_id),
                    'errors' => $import->errors(),
                    'matches' => $import->matches(),
                ]);
    }
}
