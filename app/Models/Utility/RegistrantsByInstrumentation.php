<?php

namespace App\Models\Utility;

use App\Models\Eventversion;
use App\Models\Registranttype;
use App\Models\School;
use App\Models\Userconfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegistrantsByInstrumentation extends Model
{
    private $results;
    private $eventversionid;
    private $registranttypeid;
    private $schoolid;
    private $instrumentations;

    public function __construct()
    {
        self::init();
    }

    public function getArray()
    {
        return $this->results;
    }
/** END OF PUBLIC FUNCTIONS **************************************************/

    private function buildResultsArray()
    {
        foreach($this->instrumentations AS $instrumentation){
            $this->results[$instrumentation->id] = $this->registrantCount($instrumentation->id);
        }
    }

    private function init()
    {
        $eventversion = Eventversion::find(Userconfig::getValue('eventversion', auth()->id()));
        $this->eventversionid = $eventversion->id;
        $this->instrumentations = $eventversion->instrumentations();
        $this->registranttypeid = Registranttype::REGISTERED;
        $this->schoolid = School::find(Userconfig::getValue('school', auth()->id()))->id;
        $this->results = [];

        self::buildResultsArray();
    }

    private function registrantCount($instrumentation_id) : int
    {
        return DB::table('registrants')
            ->join('instrumentation_registrant','instrumentation_registrant.registrant_id','=','registrants.id')
            ->where('registrants.eventversion_id', $this->eventversionid)
            ->where('registrants.school_id', $this->schoolid)
            ->where('registrants.registranttype_id', $this->registranttypeid)
            ->where('instrumentation_registrant.instrumentation_id',$instrumentation_id)
            ->count('id');
    }
}
