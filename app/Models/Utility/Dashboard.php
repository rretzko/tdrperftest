<?php

namespace App\Models\Utility;

use App\Models\Eventversion;
use App\Models\Teacher;
use App\Models\Userconfig;
use App\Traits\SenioryearTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory, SenioryearTrait;

    public $eventversion;
    public $user;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->init();
    }

    public function getCountStudentsAlumniAttribute() : int
    {
        return $this->teacher->myStudents()
            ->where('classof', '<', $this->senioryear())
            ->count();
    }

    public function getCountStudentsAttribute() : int
    {
        return $this->teacher->myStudents()->count();
    }

    public function getCountStudentsCurrentAttribute() : int
    {
        return $this->teacher->myStudents()
            ->where('classof', '>=', $this->senioryear())
            ->count();
    }

    public function getSchoolsUlAttribute() : string
    {
        $str = '<ul class="ml-8 list-disc mr-4">';

        foreach($this->user->schools AS $school){

            $str .= '<li>'.$school->shortName.'</li>';
        }

        $str .= '</ul>';

        return $str;
    }

    private function init()
    {
        $this->eventversion = Eventversion::find(Userconfig::getValue('eventversion', auth()->id()));
        $this->teacher = Teacher::find(auth()->id());
        $this->user = $this->teacher->person->user;
    }
}
