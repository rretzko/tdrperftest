<?php

namespace App\Models\Utility;

use App\Models\Eventversion;
use App\Models\Registrant;
use App\Models\Registranttype;
use App\Models\Student;
use App\Models\Userconfig;
use App\Traits\SenioryearTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Registrants extends Model
{
    use SenioryearTrait;

    private static $eventversion;
    private static $eventversion_id;
    private static $school_id;

    public static function applied($search='')
    {
        self::setVars();

        $classofs = array_map('self::getClassofFromGrade',
            explode(',',self::$eventversion['eventversionconfigs']->grades));

        return self::appliedRegistrants($search,$classofs);
    }

    public static function eligible($search='')
    {
        self::setVars();

        $classofs = array_map('self::getClassofFromGrade',
            explode(',',self::$eventversion['eventversionconfigs']->grades));

        return self::eligibleRegistrants($search,$classofs);
    }

    public static function registered($search='')
    {
        self::setVars();

        $classofs = array_map('self::getClassofFromGrade',
            explode(',',self::$eventversion['eventversionconfigs']->grades));

        return self::registeredRegistrants($search,$classofs);
    }



    /** END OF PUBLIC FUNCTIONS **************************************************/

    private static function appliedRegistrants(string $search, array $classofs)
    {
        $registrants = collect();
        $students = self::confirmEligibleStudentsAreRegistrants($search, $classofs);
        $eventversion_id = self::$eventversion_id;
        $school_id = Userconfig::getValue('school', auth()->id());

        $applieds = $students->filter(function($student) use ($eventversion_id, $school_id){
           return (bool)Registrant::where('user_id', $student->user_id)
               ->where('eventversion_id', $eventversion_id)
               ->where('school_id', $school_id)
               ->where('registranttype_id', Registranttype::APPLIED)
               ->first();
        });

        foreach($applieds AS $student) {

            $registrants->push($student->registrants
                ->where('eventversion_id', self::$eventversion_id)->first());
        }

        return $registrants;
    }

    private static function confirmEligibleStudentsAreRegistrants(string $search, array $classofs)
    {
        $students = self::eligibleStudents($search, $classofs);

        //ensure that all eligible students have a registrant record
        foreach($students AS $student) {

            $id = self::makeRegistrantId();

            $registrant = Registrant::firstOrCreate(
                [
                    'user_id' => $student->user_id,
                    'eventversion_id' => self::$eventversion_id,
                    'school_id' => self::$school_id,
                ],
                [
                    'id' => $id,
                    'programname' => $student->person->fullName,
                    'registranttype_id' => Registranttype::ELIGIBLE,
                ]
            );

            //ensure that newly created $registrant has its properties
            if($registrant->id){

                $registrant->fresh();

            }else{

                $registrant = Registrant::find($id);
            }

            // if $registrant does not already have an assigned instrumentation,
            // assign the $registrant->student's first instrumentation
            // OR if none exists, assign the first instrumentation for the $eventversion->ensemble
            if (! $registrant->instrumentations->count()){
                $registrant->instrumentations()->attach(self::defaultInstrumentationId($registrant));
            }
        }

        /**
         * Workaround to ensure that newly created registrant objects are loaded into the student models
         */
        $students = self::eligibleStudents($search, $classofs);

        return $students;
    }

    /**
     * If no registrant instrumentation currently exists,
     *  a) Choose the first instrumentation for the $registrant->student IF
     *      a.1) that instrumentation exists for the first $eventensemble ELSE
     *  b) Choose the first instrumentation for the $eventensemble
     *
     * @param Registrant $registrant
     * @return int
     */
    private static function defaultInstrumentationId(Registrant $registrant)
    {
        $eventversion = (self::$eventversion_id != 73) //Morris Area Chorus
            ? Eventversion::with('eventensembles')->where('id', self::$eventversion_id)->first()
            : Eventversion::find(Userconfig::getValue('eventversion', auth()->id()));

        $eventversioninstrumentations = (self::$eventversion_id != 73) //Morris Area Chorus
            ? $eventversion->eventensembles()->first()->eventensembletype()->instrumentations
            : (($registrant->student->grade < 9)
                ? $eventversion->eventensembles()[0]->eventensembletype()->instrumentations //Middle School
                : $eventversion->eventensembles()[1]->eventensembletype()->instrumentations); //High School
                                 
        $eventversionfirstinstrumentid = $eventversioninstrumentations->first()->id;

        $registrantinstrumentations = $registrant->student->person->user->instrumentations ?? null;

        $registrantfirstinstrumentid = ($registrantinstrumentations && $registrantinstrumentations->first())
            ? $registrantinstrumentations->first()->id
            : 0;

        return ($registrantinstrumentations && $eventversioninstrumentations->contains($registrantfirstinstrumentid))
                ? $registrantfirstinstrumentid
                : $eventversionfirstinstrumentid;
    }

    /**
     * Returns ALL registrants except HIDDEN
     * @param string $search
     * @param array $classofs
     * @return Collection
     */
    private static function eligibleRegistrants(string $search, array $classofs)
    {
        $registrants = collect();
        $students = self::confirmEligibleStudentsAreRegistrants($search, $classofs);
        $schoolid = Userconfig::getValue('school', auth()->id());

        foreach($students AS $student) {

            $registrants->push($student->registrants
                ->where('eventversion_id', self::$eventversion_id)
                ->where('school_id', $schoolid)
                ->first());
        }

        return $registrants;
    }

    private static function eligibleStudents(string $search, array $classofs)
    {
        /**
         * Raw sql:
         * SELECT b.user_id,concat(c.last,",",c.first," ",c.middle) AS fullNameAlpha, (12 - (b.classof - 2022)) AS grade
        FROM students b, people c, student_teacher d
        WHERE b.classof IN (2022,2023,2024)
        AND b.user_id=c.user_id
        AND c.user_id=d.student_user_id
        AND d.teacher_user_id=28
        ORDER BY fullNameAlpha
         */
        $school_id = Userconfig::getValue('school', auth()->id());

        return Student::with('person','person.user.schools','registrants')
            ->whereIn('classof', $classofs)
            ->whereHas('person.user.schools', function(Builder $query) use ($school_id) {
                $query->where('school_id','=' , $school_id);
            })
            ->whereHas('teachers', function(Builder $query){
                $query->where('teacher_user_id','=' , auth()->id());
            })
            ->whereHas('person', function(Builder $query) use ($search){
                $query->where('last','LIKE','%'.$search.'%');
            })
            ->get()
            ->sortBy('person.last');
    }

    private static function getClassofFromGrade($grade) : int
    {
        static $senioryear = null;

        if(is_null($senioryear)){
            $senioryear = (new Registrants)->senioryear();
        }

        return ($senioryear + (12 - $grade));
    }

    private static function makeRegistrant(Student $student)
    {
        Registrant::updateOrCreate([
          'id' => self::makeRegistrantId(),
          'user_id' => $student->user_id,
          'eventversion_id' => self::$eventversion_id,
          'school_id' => self::$school_id,
          'programname' => $student->person->fullName,
          'registranttype_id' => Registranttype::ELIGIBLE,
        ]);
    }

    private static function makeRegistrantId() : int
    {
        $id = self::$eventversion_id.rand(1000,9999);

        while(Registrant::find($id)){

            $id = self::$eventversion_id.rand(1000,9999);
        }

        return $id;
    }

    private static function registeredRegistrants(string $search, array $classofs)
    {
        $registrants = collect();
        $students = self::confirmEligibleStudentsAreRegistrants($search, $classofs);
        $eventversion_id = self::$eventversion_id;
        $school_id = Userconfig::getValue('school', auth()->id());

        $registereds = $students->filter(function($student) use ($eventversion_id, $school_id){
            return (bool)Registrant::where('user_id', $student->user_id)
                ->where ('school_id', $school_id)
                ->where('eventversion_id', $eventversion_id)
                ->where('registranttype_id', Registranttype::REGISTERED)
                ->first();
        });

        foreach($registereds AS $student) {

            $registrants->push($student->registrants
                ->where('eventversion_id', self::$eventversion_id)->first());
        }

        return $registrants;
    }


    private static function setVars()
    {
        self::$eventversion_id = Userconfig::getValue('eventversion', auth()->id());
        self::$eventversion = Eventversion::find(self::$eventversion_id);
        self::$school_id = Userconfig::getValue('school', auth()->id());

    }
}
