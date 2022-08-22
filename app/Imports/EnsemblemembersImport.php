<?php

namespace App\Imports;

use App\Models\Ensemble;
use App\Models\Ensemblemember;
use App\Models\Instrumentation;
use App\Models\Person;
use App\Models\Student;
use App\Models\Studenttype;
use App\Models\User;
use App\Models\Userconfig;
use App\Traits\SenioryearTrait;
use App\Traits\UsernameTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class EnsemblemembersImport
{
    use SenioryearTrait, UsernameTrait;

    public $ensemble_id;
    public $schoolyear_id;

    private $clean;
    private $cntr;
    private $dirty;
    private $errors;
    private $headers;
    private $matches;
    private $school_id;
    private $senioryear;
    private $studenttypes;
    private $teacher_user_id;

    public function __construct()
    {
        $this->clean = [];
        $this->cntr = 0;
        $this->dirty = [];
        $this->errors = [];
        $this->headers = [];
        $this->teacher_user_id = $this->getUserId();
        $this->ensemble_id = Userconfig::getValue('ensemble_id', $this->teacher_user_id);
        $this->matches = [];
        $this->senioryear = $this->senioryear();
        $this->school_id = Userconfig::getValue('school_id', $this->teacher_user_id);
        $this->schoolyear_id = Userconfig::getValue('schoolyear_id', $this->teacher_user_id);
        $this->studenttypes = [
            'teacher_added' => Studenttype::where('descr', 'teacher_added')->first()->id,
            'alum' => Studenttype::where('descr', 'alum')->first()->id,
            ];
    }

    public function errors()
    {
        return $this->errors;
    }

    public function matches()
    {
        return $this->matches;
    }

    /**
     *
     * @return Ensemblemember
     *
     * ex:
     * array:6 [▼
     *    "first" => "Mariana"
     *    "last" => "Banegas"
     *    "middle" => null
     *    "ensemble" => "Ridge Chorale"
     *    "voicepart" => "si"
     *    "grade" => 9
     * ]
     */
    public function onRow(array $row)
    {
        //user row reference number
        $this->cntr++;

        $this->dirty = [
            $this->headers[0] => $row[0],
            $this->headers[1] => $row[1],
            $this->headers[2] => $row[2],
            $this->headers[3] => $row[3],
            $this->headers[4] => $row[4],
            $this->headers[5] => $row[5],
        ];

        $this->cleanInputs();

        if (!$this->errors) {

            if (! $this->findCurrentUser()) {

                $this->addStudent();
            }
        }

    }

    public function setColumnHeaders(array $row){

        foreach($row AS $label){
            $this->headers[] = $label;
        }
    }
/** END OF PUBLIC FUNCTIONS **************************************************/

    /**
     * $this->clean:6 [▼
     *  "first" => "Mariana"
     *  "last" => "Banegas"
     *  "middle" => null
     *  "ensemble" => App\Models\Ensemble {#1976 ▶}
     *  "instrumentation" => App\Models\Instrumentation {#1987 ▶}
     *  "classof" => 2025
     * ]
     */
    private function addStudent()
    {
        $user = User::create([
            'username' => $this->username($this->clean['first'], $this->clean['last']),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ]);

        Person::create([
            'user_id' => $user->id,
            'first' => $this->clean['first'],
            'middle' => $this->clean['middle'],
            'last' => $this->clean['last'],
        ]);

        Student::create(
            [
                'user_id' => $user->id,
                'classof' => $this->clean['classof'],
            ]
        );

        //reconstruct $user with constituent parts
        $user = User::with('person', 'person.student')->find($user->id);

        $this->attachUserToInstrumentation($user);
        $this->attachStudentToTeacher($user);
        $this->attachUserToSchool($user);
        $this->addStudentToEnsemble($user);
    }

    /**
     * $this->clean:6 [▼
     *  "first" => "Mariana"
     *  "last" => "Banegas"
     *  "middle" => null
     *  "ensemble" => App\Models\Ensemble {#1976 ▶}
     *  "instrumentation" => App\Models\Instrumentation {#1987 ▶}
     *  "classof" => 2025
     * ]
     */
    private function addStudentToEnsemble(User $user)
    {
        //add row if not already exists
        if(! Ensemblemember::where('user_id', $user->id)
            ->where('ensemble_id', $this->clean['ensemble']->id)
            ->where('schoolyear_id', $this->schoolyear_id)
            ->where('teacher_user_id', $this->teacher_user_id)
            ->where('instrumentation_id', $this->clean['instrumentation']->id)
            ->first()) {
            $ensemblemember = Ensemblemember::firstOrCreate([
                'user_id' => $user->id,
                'ensemble_id' => $this->clean['ensemble']->id,
                'schoolyear_id' => $this->schoolyear_id,
                'teacher_user_id' => $this->teacher_user_id,
                'instrumentation_id' => $this->clean['instrumentation']->id,
            ]);
            $ensemblemember->save();
        }
    }

    private function attachStudentToTeacher(User $user)
    {
        //ensure teacher is attached to the student
        if(! $user->person->student->teachers->contains($this->teacher_user_id)) {
            $user->person->student->teachers()->attach($this->teacher_user_id, [
                'studenttype_id' => $this->studenttypeId(),
            ]);
        }
    }

    private function attachUserToInstrumentation(User $user)
    {
        //ensure user is attached to instrumentation
        if(! $user->instrumentations->contains($this->clean['instrumentation'])) {

            $user->instrumentations()->attach($this->clean['instrumentation']->id, [
                'order_by' => 1,
            ]);
        }
    }

    private function attachUserToSchool(User $user)
    {
        //ensure user is attached to school
        if(! $user->schools->contains($this->school_id)) {
            $user->schools()->attach($this->school_id);
        }
    }

    private function getUserId()
    {
        return auth()->id();
    }

    private function cleanInputs()
    {
        //FIRST NAME
        if(strlen($this->dirty['first'])){
            $this->clean['first'] = trim(filter_var($this->dirty['first'], FILTER_SANITIZE_STRING));
        }else{
            $this->errors[$this->cntr]['first'] = 'First name is required.';
        }

        //LAST NAME
        if(strlen($this->dirty['last'])){
            $this->clean['last'] = trim(filter_var($this->dirty['last'], FILTER_SANITIZE_STRING));
        }else{
            $this->errors[$this->cntr]['last'] = 'Last name is required.';
        }

        //MIDDLENAME
        if(strlen($this->dirty['middle'])){
            $this->clean['middle'] = trim(filter_var($this->dirty['middle'], FILTER_SANITIZE_STRING));
        }else{
            $this->clean['middle'] = NULL;
        }

        //ENSEMBLE
        $this->clean['ensemble'] = Ensemble::where('name', 'LIKE', $this->dirty['ensemble'])
            ->where('school_id', $this->school_id)
            ->first();

        if(is_null($this->clean['ensemble'])){
            $this->errors[$this->cntr]['ensemble'] = 'No ensemble found with the name: '.$this->dirty['ensemble'].'.';
        }

        //INSTRUMENTATION
        $instrumentation = Instrumentation::where('descr', 'LIKE', $this->dirty['voicepart'])->first();

        if(! $instrumentation){
            $instrumentation = Instrumentation::where('abbr', 'LIKE', $this->dirty['voicepart'])->first();
        }

        if($instrumentation){
            $this->clean['instrumentation'] = $instrumentation;
        }else{
            $this->errors[$this->cntr]['instrumentation'] = 'No voice part found as: '.$this->dirty['voicepart'];
        }

        //CLASSOF
        if(! is_numeric($this->dirty['grade'])){
            $this->errors[$this->cntr]['grade'] = 'Grade must be a whole number.';
        }else{
            $this->clean['classof'] = $this->classOf($this->dirty['grade']);
        }
    }

    private function findCurrentUser() : int
    {
        $found = false;

        //filter criteria
        $unames = $this->findCurrentUser_Username();
        $names = $this->findCurrentUser_FilterName($unames);
        $schools = $this->findCurrentUser_Schools($names);
        $persons = $this->findCurrentUser_IsStudent($schools);
        $users = $this->findCurrentUser_Classofs($persons);

        //multiple records found
        if($users->count() && ($users->count() > 1)){

            $this->matches[$this->cntr] =
                'Multiple records were found for: '.$this->dirty['first'].' '.$this->dirty['last'].' '
                . 'at row: ' . $this->cntr . ' in grade/class '.$this->dirty['grade'].'. '
                . 'We are unable to automatically add this student and ask that you manually '
                . 'update the ensemble member roster.';

            //return true to tell the system that a potential match was found
            $found = true; //$users->first()->id;
        }

        //single record found; return user->id
        if($users->count() && ($users->count() === 1)){

            if($this->isEnsemblemember($users->first())) {

                $user = $users->first();

                $this->matches[$this->cntr] = $user->person->fullName . ' at row ' . $this->cntr . ' is in the system '
                    . 'and is included on '. $this->dirty['ensemble'] . '\'s member roster.';

                //return $users->first()->id;
                $found = true;

            }else {

                $user = $users->first();
                $this->addStudentToEnsemble($user);
                $this->matches[$this->cntr] =
                    $user->person->fullName . ' at row: ' . $this->cntr . ' appears to be currently in the system. '
                    . 'We have added this record to ' . $this->dirty['ensemble'] . '. '
                    . 'Please review the ensemble member roster for accuracy.';

                //return $user->id;
                $found = true;
            }
        }
        
        //no student record identified
        return $found;
    }

    private function findCurrentUser_Classofs(Collection $users)
    {
        //early exit
        if(! $users->count()){ return $users;}

        return $users->filter(function($user){
            return $user &&
                $user->person->student->classof == $this->clean['classof'];
        });
    }

    private function findCurrentUser_FilterName(Collection $users)
    {
        //early exit
        if(! $users->count()){ return $users;}

        $a = [];
        foreach($users AS $user){

            $person = $user->person;

            if($person::where('first', 'LIKE', $this->clean['first'])
                ->where('last', 'LIKE', $this->clean['last'])
                ->first()){

                $a[] = $user;
            }
        }

        return collect($a);
    }

    private function findCurrentUser_IsStudent(Collection $users)
    {
        //early exit
        if(! $users->count()){return $users;}

        return $users->filter(function($user){
            return $user->isStudent();
        });
    }

    private function findCurrentUser_Schools(Collection $users)
    {
        //early exit
        if(! $users->count()){ return $users;}

        return $users->filter(function($user){
            return $user->schools &&
                $user->schools->contains($this->school_id);
        });
    }

    private function findCurrentUser_Username()
    {
        //find username matches
        return User::where('username', 'LIKE', '%'.substr($this->clean['first'], 0, 1).$this->clean['last'].'%')
            ->with('person')->get();
    }

    private function isEnsemblemember(User $user) : bool
    {
        return (bool)Ensemblemember::where('user_id', $user->id)
            ->where('ensemble_id', $this->clean['ensemble']->id)
            ->where('schoolyear_id', $this->schoolyear_id)
            ->where('teacher_user_id', $this->teacher_user_id)
            ->where('instrumentation_id', $this->clean['instrumentation']->id)
            ->first();
    }

    private function studenttypeId() : int
    {
        return ($this->clean['classof'] >= $this->senioryear)
            ? $this->studenttypes['teacher_added']
            : $this->studenttypes['alum'];
    }
}
