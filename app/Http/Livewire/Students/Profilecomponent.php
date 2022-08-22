<?php

namespace App\Http\Livewire\Students;

use App\Models\Gradetype;
use App\Models\Person;
use App\Models\Pronoun;
use App\Models\School;
use App\Models\Shirtsize;
use App\Models\Student;
use App\Models\Studenttype;
use App\Models\Teacher;
use App\Models\Tenure;
use App\Models\User;
use App\Models\Userconfig;
use App\Traits\FormatPhoneTrait;
use App\Traits\SenioryearTrait;
use App\Traits\UsernameTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Profilecomponent extends Component
{
    use SenioryearTrait,UsernameTrait,FormatPhoneTrait;

    public $birthday = '';
    public $classof = 0;
    public $classofs = [];
    public $email='';
    public $first = '';
    public $height = 30;
    public $heights = [];
    public $heightininches = '3\' 0"';
    public $last = '';
    public $middle = '';
    public $parentfirst='';
    public $parentlast='';
    public $parentemail='';
    public $parentcell='';
    public $fparentcell='';
    public $pronoun_id = 1;
    public $pronouns = [];
    public $shirtsize_id = 1;
    public $shirtsizes = [];
    public $student = null;
    public $test = 'test';

    public function mount()
    {
        self::setStudentProperties();
        $this->classofs = self::setClassofs();
        $this->heights = self::setHeights();
        $this->pronouns = Pronoun::all()->sortBy('order_by');
        $this->shirtsizes = Shirtsize::all()->sortBy('order_by');
        $this->birthday = Carbon::now();
        $this->classof = $this->calcClassof();
    }

    public function render()
    {
        return view('livewire.students.profilecomponent');
    }

    public function save()
    {
        if(is_null($this->student)){

            $this->addNewStudent();

        }else {

            $this->student->birthday = $this->birthday;
            $this->student->classof = $this->classof;
            $this->student->height = $this->height;
            $this->student->shirtsize_id = $this->shirtsize_id;

            $this->student->save();

            $person = $this->student->person;

            $person->first = $this->first;
            $person->middle = $this->middle;
            $person->last = $this->last;
            $person->pronoun_id = $this->pronoun_id;

            $person->save();
        }

        $this->emit('profile-saved');
    }

    private function setStudentProperties()
    {
        //early exit
        if(! $this->student){ return '';}

        $this->birthday = $this->student->birthday;
        $this->classof = $this->student->classof;
        $this->first = $this->student->person->first;
        $this->height = $this->student->height;
        $this->last = $this->student->person->last;
        $this->middle = $this->student->person->middle;
        $this->pronoun_id = $this->student->person->pronoun_id;
        $this->shirtsize_id = $this->student->shirtsize_id;
    }

    private function setClassofs()
    {
        $a = [];

        //grades (ex. 9, 10, 11, 12) with classof as key
        foreach(Gradetype::first()->schoolUser() AS $gradetype){

            $classof = ($gradetype->id>12) ? $gradetype->id : ($this->senioryear() + (12 - $gradetype->id));
            $a[$classof] = $gradetype->descr;
        }

        //classofs starting with the $startyear of user/teacher for current school
        //WORKAROUND: DEFAULT TO PREVIOUS YEAR IF NO startyear FOUND
        /** @todo  Tenure::startyear should default to previous year upon School creation */
        $startyear = Tenure::where('user_id', auth()->id())
            ->where('school_id', Userconfig::getValue('school', auth()->id()))
            ->first()
            ->value('startyear') ?: (date('Y')-1);

        for($i = ($this->senioryear() - 1); $i >= $startyear; $i--){

            $a[$i] = $i;
        }

        //sort classofs in descending order
        krsort($a );

        return $a;
    }

    /**
     * heights range from 2' 6" to 7'
     */
    public function setHeights()
    {
        $a = [];

        for($i = 30; $i <= (7*12); $i++){

            $a[$i] = floor($i / 12)."' ".($i % 12).'"';
        }

        return $a;
    }

    public function addNewStudent()
    {
        //add user
        $user = User::create([
            'username' => $this->username($this->first,$this->last),
            'password' => bcrypt('Password1!'),
        ]);

        $user->fresh();

        //add person
        $person = Person::create([
            'user_id' => $user->id,
            'first' => $this->first,
            'middle' => $this->middle,
            'last' => $this->last,
            'pronoun_id' => $this->pronoun_id,
        ]);

        //add student
        Student::create([
            'user_id' => $user->id,
            'classof' => $this->classof,
            'height' => $this->height,
            'birthday' => $this->birthday,
            'shirtsize_id' => $this->shirtsize_id,
        ]);

        $this->student = Student::find($user->id);

        //sync student to school
        DB::table('student_teacher')->insert(
            [
                'student_user_id' => $user->id,
                'teacher_user_id' => auth()->id(),
                'studenttype_id' => Studenttype::TEACHER_ADDED,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        //$teacher = Teacher::where('user_id', auth()->id())->first();
        //$teacher->students()->sync([$user->id => ['studenttype_id' => Studenttype::TEACHER_ADDED]]);
        //$this->student->teachers()->sync([auth()->id() =>['studenttype_id' => Studenttype::TEACHER_ADDED]]);

        //sync student to school
        $user->schools()->sync(Userconfig::getValue('school', auth()->id()));

        //autoregister student for events
        $this->eventRegistration($user);

        //Student Email
        \App\Models\Nonsubscriberemail::create(
            [
                'user_id' => $user->id,
                'emailtype_id' => 4, //email_student_school
                'email' => $this->email,
            ]
        );

        //Guardian
        //add guardian-user
        $guardianuser = User::create([
            'username' => $this->username($this->first,$this->last),
            'password' => bcrypt('Password1!'),
        ]);

        $guardianuser->fresh();

        //add guardian-person
        \App\Models\Person::create(
            [
                'user_id' => $guardianuser->id,
                'first' => $this->parentfirst,
                'last' => $this->parentlast,
                'pronoun_id' => 1, //she/her/etc.
                'honorific_id' => 1, //Ms.
            ]
        );

        //add guardian-email
        \App\Models\Nonsubscriberemail::create(
            [
                'user_id' => $guardianuser->id,
                'emailtype_id' => 7, //email_guardian_primary
                'email' => $this->parentemail,
            ]
        );

        //add guardian-cell
        \App\Models\Phone::create(
            [
                'user_id' => $guardianuser->id,
                'phonetype_id' => 6, //phone_guardian_mobile
                'phone' => $this->formatPhone($this->parentcell),
            ]
        );

        //Guardian
        \App\Models\Guardian::create(['user_id' => $guardianuser->id]);
        $guardian = \App\Models\Guardian::find($guardianuser->id);

        $guardiansync[$guardian->user_id] = ['guardiantype_id' => 1];
        //$this->student->guardians()->sync([$guardian => ['guardiantype_id' => 1]]);
        $this->student->guardians()->sync($guardiansync);

        $this->emit('profile-saved');
    }

    public function updatedParentcell()
    {
        $this->fparentcell = $this->parentcell;
    }

    private function calcClassof()
    {
        if($this->student){

            return $this->student->classof;
        }
        return date('Y');
    }

    private function eventRegistration(User $user)
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        //identify open eventversions for which user is a member
        foreach($teacher->openEventversions AS $eventversion){

            $reasons = $eventversion->isQualifiedStudent($user);

            if( empty($reasons) &&
                (! \App\Models\Registrant::where('user_id', $user->id)
                    ->where('eventversion_id', $eventversion->id)
                    ->exists())){

                $registrant = new \App\Models\Registrant;
                $registrant->id = $registrant->createId($eventversion->id);
                $registrant->user_id = $user->id;
                $registrant->eventversion_id = Userconfig::getValue('eventversion', auth()->id());
                $registrant->school_id = Userconfig::getValue('school', auth()->id());
                $registrant->teacher_user_id = auth()->id();
                $registrant->programname = $user->person->fullname;
                $registrant->registranttype_id = \App\Models\Registranttype::ELIGIBLE;
                $registrant->save();

            }else{

                $mssg = 'Registrant ('.$user->person->fullname.' ('.$user->id.') for: '.$eventversion->name
                    .' ('.$eventversion->id.') not created as: '
                    .implode(', ',$reasons);

                event(new \App\Events\NewStudentNonRegistrantEmailEvent($user, $eventversion, $reasons));

                //mail('rick@mfrholdings.com', 'Registrant non-creation', $mssg);
                info('***** '.$mssg);
            }
        }
    }
}
