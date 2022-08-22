<?php

namespace App\Http\Livewire\Students;

use App\Models\User;
use App\Models\Phone;
use App\Models\Person;
use App\Models\School;
use App\Models\Address;
use App\Models\Pronoun;
use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;
use App\Models\Geostate;
use App\Models\Guardian;
use App\Models\Emailtype;
use App\Models\Honorific;
use App\Models\Phonetype;
use App\Models\Shirtsize;
use App\Models\Userconfig;
use App\Models\Studenttype;
use App\Models\Guardiantype;
use App\Traits\UsernameTrait;
use Livewire\WithFileUploads;
use App\Exports\StudentsExport;
use App\Models\Instrumentation;
use App\Traits\SenioryearTrait;
use Illuminate\Validation\Rule;
use App\Traits\FormatPhoneTrait;
use App\Models\Nonsubscriberemail;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Instrumentationbranch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class Studentrostertabbed extends Component
{
    use FormatPhoneTrait,SenioryearTrait,UsernameTrait,WithFileUploads;

    public $address01;
    public $address02;
    public $birthday;
    public $choralinstrumentation;
    public $city;
    public $classof;
    public $classofs;
    public $countstudents;
    public $displayclassofserror = false;
    public $displayform = false;
    public $displayhide = false; //for (def.) section
    public $emailguardianalternate;
    public $emailguardianprimary;
    public $emailpersonal;
    public $emailschool;
    public $filter;
    public $first;
    public $geostates;
    public $geostate_id=37;
    public $guardian = null;
    public $guardians;
    public $guardianfirst;
    public $guardianfullname;
    public $guardianhonorific_id=1;
    public $guardianlast;
    public $guardianmiddle;
    public $guardianpronoun_id=1;
    public $guardiantype_id=1;
    public $guardiantypes;
    public $guardian_id;
    public $height;
    public $heights;
    public $honorifics;
    public $instrumentalinstrumentation;
    public $instrumentationbranch_id = 0;
    public $instrumentationbranches;
    public $instrumentationbranch;
    public $instrumentations;
    public $instrumentation_id = 0;
    public $last;
    public $middle;
    public $newinstrumentations;
    public $phoneguardianhome;
    public $phoneguardianmobile;
    public $phoneguardianwork;
    public $phonehome;
    public $phonemobile;
    public $photo = null;
    public $postalcode;
    public $pronouns;
    public $pronoun_id=1;
    public $removeguardianchickentest = 0;
    public $school;
    public $school_id;
    public $schools;
    public $search;
    public $searchstring = '';
    public $shirtsizes;
    public $shirtsize_id=1;
    public $showimportexport = false;
    public $showmodalguardian = false;
    public $showmodalremoveguardian = false;
    public $showmodalinstrumentation = false;
    public $student = null;
    public $students;
    public $tab;
    public $tabcontent;
    public $teacher;
    public $username;

    public function mount()
    {
        $this->choralinstrumentation = $this->instrumentationChoral();
        $this->classofs = $this->classofs();
        $this->displayhide = Userconfig::getValue('pagedef_students', auth()->id());
        $this->filter = Userconfig::getValue('filter_studentroster', auth()->id());
        $this->geostates = $this->geostates();
        $this->guardians = $this->guardians();
        $this->guardiantypes = $this->guardiantypes();
        $this->heights = $this->heights();
        $this->honorifics = $this->honorifics();
        $this->instrumentalinstrumentation = $this->instrumentationInstrumental();
        $this->instrumentationbranches = Instrumentationbranch::where('id', '<', 3)->get();
        $this->newinstrumentations = collect(); //$this->newInstrumentations();
        $this->pronouns = $this->pronouns();
        $this->school_id = $this->getSchoolId();
        $this->school = School::find($this->school_id);
        $this->schools = $this->schools();
        $this->shirtsizes = $this->shirtsizes();
        $this->tab = Userconfig::getValue('studentform_tab', auth()->id());
    }

    public function render()
    {
        $this->students = $this->search();
        $this->countstudents = $this->students->count();
        $this->teacher = Teacher::with(['person', 'person.user','person.honorific', ])->find(auth()->id());

        return view('livewire.students.studentrostertabbed', []);
    }

    public function rules()
    {
        return [
            //'instrumentation_id' => ['numeric', 'min:1'],
            //'instrumentationbranch_id' => ['numeric', 'min:1'],
        ];
    }

    /** Close ALL modals */
    public function closeModal()
    {
        $this->showmodalinstrumentation = false;
        $this->showmodalguardian = false;
    }

    public function createGuardian()
    {
        $this->showmodalguardian = true;
        $this->guardian = new Guardian;

        $this->guardianlast = '';
        $this->guardianmiddle = '';
        $this->guardianfirst = '';
        $this->emailguardianprimary = '';
        $this->emailguardianalternate = '';
        $this->phoneguardianhome = '';
        $this->phoneguardianmobile = '';
        $this->phoneguardianwork = '';
        $this->guardiantype_id = 1;
    }

    public function createInstrumentation()
    {
        $this->instrumentation_id = 0;
        $this->instrumentationbranch_id = 0;
        $this->showmodalinstrumentation = true;
    }

    public function createStudent()
    {
        $this->student = new Student;

        $this->username = '';

        $this->classof = date('Y');
        $this->first = '';
        $this->height = 30;
        $this->last = '';
        $this->middle = '';
        $this->pronoun_id = 1;

        $this->birthday = date('Y-n-d');
        $this->shirtsize_id = 1;

        $this->choralinstrumentation = [];
        $this->instrumentalinstrumentation = [];

        $this->emailpersonal = '';
        $this->emailschool = '';
        $this->phonehome = '';
        $this->phonemobile = '';

        $this->address01 = '';
        $this->address02 = '';
        $this->city = '';
        $this->geostate_id = '37';
        $this->postalcode = '';

        //final actions
        $this->tab = 'profile';
        $this->displayform = true;
    }

    public function export($ext)
    {
        abort_if(!in_array($ext, ['csv', 'xlsx', 'pdf']), Response::HTTP_NOT_FOUND);

        return Excel::download(new StudentsExport($this->students), 'students.' . $ext);
    }

    public function deleteInstrumentation($id)
    {
        $this->student->person->user->instrumentations()->detach($id);

        $this->instrumentation_id = 0;
        $this->instrumentationbranch_id = 0;

        $this->choralinstrumentation = $this->instrumentationChoral();
        $this->instrumentalinstrumentation = $this->instrumentationInstrumental();

        $this->emit('removed-instrumentation');
    }

    public function editGuardian($user_id)
    {
        $this->showmodalguardian = true;
        $this->showmodalremoveguardian = false;

        $this->guardian = Guardian::with('person')->find($user_id);
        $this->guardianfullname = $this->guardian->person->fullName;

        $this->emailguardianalternate = $this->guardian->emailAlternate->id ? $this->guardian->emailAlternate->email : '';
        $this->emailguardianprimary = $this->guardian->emailPrimary->id ? $this->guardian->emailPrimary->email : '';

        $this->guardianfirst = $this->guardian->person->first;
        $this->guardianlast = $this->guardian->person->last;
        $this->guardianmiddle = $this->guardian->person->middle;
        $this->guardianhonorific_id = $this->guardian->person->honorific_id;
        $this->guardianpronoun_id = $this->guardian->person->pronoun_id;

        $this->guardiantype_id = $this->guardian->students()
            ->where('student_user_id', $this->student->user_id)
            ->first()
            ->pivot->guardiantype_id;

        $this->phoneguardianhome = $this->guardian->phoneHome->id ? $this->guardian->phoneHome->phone : '';
        $this->phoneguardianmobile = $this->guardian->phoneMobile->id ? $this->guardian->phoneMobile->phone : '';
        $this->phoneguardianwork = $this->guardian->phoneWork->id ? $this->guardian->phoneWork->phone : '';
    }

    public function editStudentForm($user_id)
    {
        $this->student = Student::find($user_id);

        $this->username = $this->student->person->user->username;

        $this->classof = $this->student->classof;
        $this->first = $this->student->person->first;
        $this->height = $this->student->height;
        $this->last = $this->student->person->last;
        $this->middle = $this->student->person->middle;
        $this->pronoun_id = $this->student->person->pronoun_id;

        $this->birthday = $this->student->birthday;
        $this->shirtsize_id = $this->student->shirtsize_id;

        $this->choralinstrumentation = $this->instrumentationChoral();
        $this->instrumentalinstrumentation = $this->instrumentationInstrumental();

        $this->emailpersonal = $this->student->emailPersonal->id ? $this->student->emailPersonal->email : '';
        $this->emailschool = $this->student->emailSchool->id ? $this->student->emailSchool->email : '';
        $this->phonehome = $this->student->phoneHome->id ? $this->student->phoneHome->phone : '';
        $this->phonemobile = $this->student->phoneMobile->id ? $this->student->phoneMobile->phone : '';

        $this->address01 = $this->student->person->user->address ? $this->student->person->user->address->address01 : '';
        $this->address02 = $this->student->person->user->address ? $this->student->person->user->address->address02 : '';
        $this->city = $this->student->person->user->address ? $this->student->person->user->address->city : '';
        $this->geostate_id = $this->student->person->user->address ? $this->student->person->user->address->geostate_id : '37';
        $this->postalcode = $this->student->person->user->address ? $this->student->person->user->address->postalcode : '';

        //final action
        $this->displayform = true;
    }

    public function footInches($inches)
    {
        return floor($inches / 12)."' ".($inches % 12).'"';
    }

    private function getSchoolId()
    {
        //fetch the value from the current value from the database
        $stored = Userconfig::getValue('school_id', auth()->id());

        //initialize $this->>school_id
        if (! $this->school_id) {
            $this->school_id = $stored;
        }

        //early exit
        if ($stored === $this->school_id) {
            return $stored;
        } //return the stored value

        //$this->schoolid has been changed; register and return the new value
        Userconfig::setValue('school_id', auth()->id(), $this->school_id);

        //return the newly stored value (recursive function)
        self::getSchoolId();
    }

    private function guardians()
    {
        if ($this->student) {
            $this->student->refresh();
        }

        return $this->student
            ? $this->student->guardians
            : collect();
    }

    public function newInstrumentations()
    {
        return Instrumentation::where('instrumentationbranch_id', $this->instrumentationbranch)->get()->sortBy('descr');
    }

    public function removeGuardian($user_id)
    {
        //set $this->guardian
        $this->guardian = Guardian::find($user_id);

        $this->guardianfullname = $this->guardian->person->fullName;

        //display chickentest
        $this->showmodalremoveguardian = true;
    }

    public function removeGuardianChickenTest()
    {
        if ($this->removeguardianchickentest) {
            $this->student->guardians()->detach($this->guardian->user_id);

            $this->student->refresh();

            $this->emit('removed-guardian');
        }

        //reinitialize to hide modal
        $this->showmodalremoveguardian = false;
    }

    public function storeGuardian()
    {
        $this->validate(
            [
                'emailguardianprimary' => ['email','nullable','max:120'],
                'emailguardianalternate' => ['email','nullable','max:120'],
                'guardianfirst' => ['string','required','min:2','max:60'],
                'guardianlast' => ['string','required','min:2','max:60'],
                'guardianmiddle' => ['string','nullable','min:1','max:60'],
                'guardianpronoun_id' => ['required','numeric','exists:pronouns,id'],
                'phoneguardianhome' => ['string','nullable'],
                'phoneguardianmobile' => ['string','nullable'],
                'phoneguardianwork' => ['string','nullable'],
            ],
            [
                'emailguardianalternate:email' => 'The :attribute must be correctly formed.',
                'emailguardianprimary:email' => 'The :attribute must be correctly formed.',
                'guardianfirst:required' => 'The :attribute cannot be empty.',
                'guardianlast:required' => 'The :attribute cannot be empty.',
            ],
            [
                'emailguardianalternate' => 'alternate email',
                'emailguardianprimary' => 'primary email',
                'guardianfirst' => 'first name',
                'guardianlast' => 'last name',
                'guardianmiddle' => 'middle name',
                'phoneguardianhome' => 'home phone',
                'phoneguardianmobile' => 'mobile phone',
                'phoneguardianwork' => 'work phone',
            ],
        );

        //create user
        $username = $this->username($this->guardianfirst, $this->guardianlast);

        $user = User::create([
            'username' => $username,
            'password' => Hash::make($username),
        ]);

        //create guardian
        Guardian::create([
            'user_id' => $user->id,
        ]);

        $this->guardian = Guardian::find($user->id);

        //create person
        $this->updateGuardianPerson();

        //attach guardian to $this->student
        $this->student->guardians()->attach($user->id, ['guardiantype_id' => $this->guardiantype_id]);

        //create emails
        $this->updateGuardianEmails();

        //create phone
        $this->updateGuardianPhones();

        //update guardians
        $this->guardians();

        //update table

        $this->showmodalguardian = false;

        $this->emit('saved-guardian');
    }

    public function storeInstrumentation()
    {
        $this->validate([
            'instrumentationbranch_id' => ['required', 'numeric', 'exists:instrumentationbranches,id'],
            'instrumentation_id' => ['required','numeric', 'exists:instrumentations,id'],
        ]);

        $this->student->person->user->instrumentations()->attach($this->instrumentation_id, ['order_by' => 1]);

        //refresh $this->student instrumentation collections
        $this->choralinstrumentation = $this->instrumentationChoral();
        $this->instrumentalinstrumentation = $this->instrumentationInstrumental();

        //reinitialize select values
        $this->instrumentationbranch_id = 0;
        $this->instrumentation_id = 0;

        $this->closeModal();

        $this->emit('saved-instrumentation');
    }

    public function toolsMenu()
    {
        $this->showimportexport = true;
    }

    /**
     * User is submitting the Biography form
     */
    public function updateBiography()
    {
        $this->validate([
            'username' => ['string', 'required', 'min:3','max:61',Rule::unique('users')->ignore($this->student->user_id ?? 0)],
        ]);

        $user = $this->student->person->user;
        $user->username = $this->username;

        if ($this->photo) {
            $user->profile_photo_path = $this->photo->storeAs('profile-photo/' . $user->id, $this->photo->getClientOriginalName(), 'public');
        }

        $user->save();

        $this->photo = '';

        $user->refresh();

        $this->emit('saved-biography');
    }

    public function deleteProfilePhoto()
    {
        $user = $this->student->person->user;

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            //$user->update(['profile_photo_path' => null]);
            $user->profile_photo_path = null;
            $user->save();
        }

        $this->emit('saved-biography');
    }

    public function updateCommunication()
    {
        $this->validate(
            [
                'emailpersonal' => ['email', 'nullable'],
                'emailschool' => ['email', 'nullable'],
                'phonehome' => ['string', 'nullable','min:10'],
                'phonemobile' => ['string', 'nullable','min:10'],
            ],
            [
                'emailpersonal:email' => 'The :attribute must be correctly formed.',
                'emailschool:email' => 'The :attribute must be correctly formed.',
                'phonehome:min' => 'The :attribute must include the area code.',
                'phonemobile:min' => 'The :attribute must include the area code.',
        ],
            [
                'emailpersonal' => 'personal email',
                'emailschool' => 'school email',
                'phonehome' => 'home phone',
                'phonemobile' => 'mobile phone',
            ],
        );

        $this->updateCommunicationEmails();

        $this->updateCommunicationPhones();

        $this->student->refresh();

        $this->student->setSearchables();

        $this->emit('saved-communication');
    }

    public function updateGuardian()
    {
        $this->validate(
            [
                'emailguardianprimary' => ['email','nullable','max:120'],
                'emailguardianalternate' => ['email','nullable','max:120'],
                'guardianfirst' => ['string','required','min:2','max:60'],
                'guardianlast' => ['string','required','min:2','max:60'],
                'guardianmiddle' => ['string','nullable','min:1','max:60'],
                'guardianpronoun_id' => ['required','numeric','exists:pronouns,id'],
                'phoneguardianhome' => ['string','nullable'],
                'phoneguardianmobile' => ['string','nullable'],
                'phoneguardianwork' => ['string','nullable'],
            ],
            [
                'emailguardianalternate:email' => 'The :attribute must be correctly formed.',
                'emailguardianprimary:email' => 'The :attribute must be correctly formed.',
                'guardianfirst:required' => 'The :attribute cannot be empty.',
                'guardianlast:required' => 'The :attribute cannot be empty.',
            ],
            [
                'emailguardianalternate' => 'alternate email',
                'emailguardianprimary' => 'primary email',
                'guardianfirst' => 'first name',
                'guardianlast' => 'last name',
                'guardianmiddle' => 'middle name',
                'phoneguardianhome' => 'home phone',
                'phoneguardianmobile' => 'mobile phone',
                'phoneguardianwork' => 'work phone',
            ],
        );

        $this->guardian->students()->updateExistingPivot($this->student->user_id, [
            'guardiantype_id' => $this->guardiantype_id,
        ]);

        $this->updateGuardianPerson();

        $this->updateGuardianEmails();

        $this->updateGuardianPhones();

        $this->guardian->refresh();

        $this->guardian->setSearchables();

        $this->student->refresh();

        $this->showmodalguardian = false;

        $this->emit('saved-guardian');
    }

    public function updateHomeaddress()
    {
        $this->validate([
            'address01' => ['string', 'nullable'],
            'address02' => ['string', 'nullable'],
            'city' => ['string', 'nullable'],
            'geostate_id' => ['integer', 'nullable','exists:geostates,id','min:1'],
            'postalcode' => ['string', 'nullable','min:5'],
        ]);

        Address::updateOrCreate(
            [
            'user_id' => $this->student->user_id
        ],
            [
                'address01' => $this->address01,
                'address02' => $this->address02,
                'city' => $this->city,
                'geostate_id' => $this->geostate_id,
                'postalcode' => $this->postalcode,
            ]
        );

        $this->student->refresh();

        $this->emit('saved-homeaddress');
    }

    /**
     * User is submitting the Profile form
     */
    public function updateProfile()
    {
        $this->validate([
            'birthday' => ['date', 'nullable'],
            'classof' => ['numeric', 'required','min:1960','max:'.(date('Y') + 12)],
            'first' => ['string', 'required', 'min:2','max:60',],
            'height' => ['integer', 'required', 'min:30','max:72'],
            'middle' => ['string', 'nullable', 'max:60',],
            'pronoun_id' => ['required', 'integer', 'min:1'],
            'last' => ['string', 'required', 'min:2', 'max:60',],
            'shirtsize_id' => ['required', 'integer', 'min:1'],
        ]);

        //if adding a new student, create the student records first
        if (! $this->student->user_id) {
            $this->storeStudent();
        }

        $person = $this->student->person;
        $person->first = $this->first;
        $person->middle = $this->middle;
        $person->last = $this->last;
        $person->pronoun_id = $this->pronoun_id;
        $person->save();

        $this->student->classof = $this->classof;
        $this->student->height = $this->height;
        $this->student->birthday = $this->birthday;
        $this->student->shirtsize_id = $this->shirtsize_id;
        $this->student->save();

        $this->student->refresh();

        $this->student->setSearchables();

        $this->emit('saved-personal');
    }

    public function updatedInstrumentationbranch($value)
    {
        $this->newinstrumentations = $this->newInstrumentations();
        $this->instrumentationbranch_id = $value;
    }

    public function updatedTab()
    {
        //persist user's selection
        Userconfig::setValue('studentform_tab', auth()->id(), $this->tab);

        $this->tabcontent = Userconfig::getValue('studentform_tab', auth()->id());
    }

    /** END OF PUBLIC FUNCTIONS **************************************************/

    /**
     * @todo test with primary or middle school teacher
     * @todo redefine algorithm with collegiate/adult grades
     *
     * Return an array [classof => grade||classof]
     * array key=>value pairs consist of
     * - all grades taught by auth()->id() at the current school
     * AND
     * - all classofs since auth()->id() has been teaching at the current school
     * ex.
     * [
     *  2024 => 9,
     *  2023 => 10,
     *  2022 => 11,
     *  2021 => 12,
     *  2020 => 2020,
     *  2019 => 2019,
     *  2018 => 2018,
     * ]
     * @return array
     */
    private function classofs() : array
    {
        //what is the current senior year
        $senioryear = $this->senioryear();

        //what school is being targeted
        $school = School::find(Userconfig::getValue('school', auth()->id()));

        //what grades are taught at the school for this teacher
        $grades = $school->currentUserGrades;

        $a = [];

        if(! count($grades)){ $this->displayclassofserror = true; }

        //register the current grades
        foreach ($grades as $grade) {
            $classof = ($senioryear + (12 - $grade));
            $a[$classof] = $grade;
        }

        //how long as this teacher been teaching at the targeted school
        $teacher = Teacher::find(auth()->id());
        $tenures = $teacher->tenures->where('school_id', $school->id);

        //register the alum grades
        foreach ($tenures as $tenure) {
            for ($i=$tenure->startyear; $i<=$tenure->endyear; $i++) {
                if (! array_key_exists($i, $a)) {
                    $a[$i] = $i;
                }
            }
        }
        //sort from high-to-low classofs keys (ex.2024,2023,2022,2021,etc)
        krsort($a);

        return $a;
    }

    private function geostates()
    {
        $a = [];

        foreach (Geostate::all() as $geostate) {
            $a[$geostate->id] = $geostate->abbr;
        }

        return $a;
    }

    private function guardiantypes()
    {
        $a = [];

        foreach (Guardiantype::all() as $guardiantype) {
            $a[$guardiantype->id] = $guardiantype->descr;
        }

        return $a;
    }
    private function heights()
    {
        $a = [];

        for ($i=30; $i < 94; $i++) {
            $a[$i] = $i.' ('.$this->footInches($i).')';
        }

        return $a;
    }

    private function honorifics()
    {
        $a = [];

        foreach (Honorific::orderBy('order_by')->get() as $honorific) {
            $a[$honorific->id] = $honorific->descr;
        }

        return $a;
    }

    private function instrumentationChoral()
    {
        //early exist
        if (! $this->student) {
            return collect();
        }

        return $this->student->person->user->instrumentations()
                ->where('instrumentationbranch_id', Instrumentationbranch::where('descr', 'choral')->first()->id)
                ->get()
                ->sortBy('descr')
            ?? collect();
    }

    private function instrumentationInstrumental()
    {
        //early exist
        if (! $this->student) {
            return collect();
        }

        return $this->student->person->user->instrumentations()
                ->where('instrumentationbranch_id', Instrumentationbranch::where('descr', 'instrumental')->first()->id)
                ->get()
                ->sortBy('descr')
            ?? collect();
    }

    private function pronouns()
    {
        $a = [];

        foreach (Pronoun::orderBy('order_by')->get() as $pronoun) {
            $a[$pronoun->id] = $pronoun->descr;
        }

        return $a;
    }

    private function schools()
    {
        $a = [];
        $user = User::find(auth()->id());

        foreach ($user->schools as $school) {
            $a[$school->id] = $school->name;
        }

        asort($a);

        return $a;
    }

    private function search()
    {
        $teacher = Teacher::find(auth()->id());
        return $teacher->students($this->searchstring);
    }

    private function shirtsizes()
    {
        $a = [];

        foreach (Shirtsize::orderBy('order_by')->get() as $shirtsize) {
            $a[$shirtsize->id] = $shirtsize->abbr.' ('.$shirtsize->descr.')';
        }

        return $a;
    }

    private function storeStudent()
    {
        $this->validate([
            'birthday' => ['date', 'nullable'],
            'classof' => ['numeric', 'required','min:1960','max:'.(date('Y') + 12)],
            'first' => ['string', 'required', 'min:2','max:60',],
            'height' => ['integer', 'required', 'min:30','max:72'],
            'middle' => ['string', 'nullable', 'max:60',],
            'pronoun_id' => ['required', 'integer', 'min:1'],
            'last' => ['string', 'required', 'min:2', 'max:60',],
            'shirtsize_id' => ['required', 'integer', 'min:1'],
        ]);

        $username = $this->username($this->first, $this->last);

        $user = User::create([
            'username' => $username,
            'password' => Hash::make($username),
        ]);

        Person::create([
            'user_id' => $user->id,
            'first' => $this->first,
            'middle' => $this->middle,
            'last' => $this->last,
            'pronoun_id' => $this->pronoun_id,
        ]);

        Student::create([
            'user_id' => $user->id,
            'classof' => $this->classof,
            'height'=> $this->height,
            'birthday' => $this->birthday,
            'shirtsize_id' => $this->shirtsize_id,
        ]);

        $this->student = Student::find($user->id);

        //attachments
        $this->student->person->user->schools()->attach(Userconfig::getValue('school', auth()->id()));
        $this->student->teachers()->attach(auth()->id(), ['studenttype_id' => Studenttype::where('descr', 'teacher_added')->first()->id]);

        //reset tab
        $this->tab = 'profile';

        $this->emit('saved-personal');
    }

    private function updateCommunicationEmails()
    {
        $emails = [
            'personal' => ['obj' => null, 'emailtype_descr' => 'email_student_personal', 'current' => $this->emailpersonal,],
            'school' => ['obj' => null, 'emailtype_descr' => 'email_student_school', 'current' => $this->emailschool,],
        ];

        foreach ($emails as $email) {
            $email['obj'] = Nonsubscriberemail::firstOrCreate(
                [
                    'user_id' => $this->student->user_id,
                    'emailtype_id' => Emailtype::where('descr', $email['emailtype_descr'])->first()->id,
                ],
                [
                    'email' => $email['current'],
                ]
            );

            //update object if user's input differs from current record
            if ($email['current'] !== $email['obj']->email) {
                $email['obj']->email = $email['current'];
                $email['obj']->save();
            }
        }
    }

    private function updateCommunicationPhones()
    {
        $phones = [
            'home' => ['obj' => null, 'phonetype_descr' => 'phone_student_home', 'current' => $this->phonehome,],
            'mobile' => ['obj' => null, 'phonetype_descr' => 'phone_student_mobile', 'current' => $this->phonemobile,],
        ];

        foreach ($phones as $phone) {
            $phone['obj'] = Phone::firstOrCreate(
                [
                    'user_id' => $this->student->user_id,
                    'phonetype_id' => Phonetype::where('descr', $phone['phonetype_descr'])->first()->id,
                ],
                [
                    'phone' => $phone['current'],
                ]
            );

            //update object if user's input differs from current record
            if ($phone['current'] !== $phone['obj']->phone) {
                $phone['obj']->phone = $phone['current'];
                $phone['obj']->save();
            }
        }
    }

    public function updatedDisplayhide()
    {
        Userconfig::setValue('pagedef_students', auth()->id(), $this->displayhide);
    }

    public function updatedSearchstring()
    {
        $this->search();
    }

    public function updatedFilter()
    {
        $filters = ['all','current','alum'];

        if (in_array($this->filter, $filters)) {
            Userconfig::setValue('filter_studentroster', auth()->id(), $this->filter);
        } elseif ($this->filter === 'new') {
            $this->createStudent();
        } elseif ($this->filter === 'csv') {
            return $this->export($this->filter);
        } else {
            $this->toolsMenu();
        }
    }

    private function updateGuardianEmails()
    {
        Nonsubscriberemail::updateOrCreate(
            [
                'user_id' => $this->guardian->user_id,
                'emailtype_id' => Emailtype::where('descr', 'email_guardian_primary')->first()->id,
            ],
            [
                'email' => $this->emailguardianprimary,
            ]
        );

        Nonsubscriberemail::updateOrCreate(
            [
                'user_id' => $this->guardian->user_id,
                'emailtype_id' => Emailtype::where('descr', 'email_guardian_alternate')->first()->id,
            ],
            [
                'email' => $this->emailguardianalternate,
            ]
        );
    }

    private function updateGuardianPerson()
    {
        Person::updateOrCreate(
            [
                'user_id' => $this->guardian->user_id
            ],
            [
                'first' => $this->guardianfirst,
                'middle' => $this->guardianmiddle,
                'last' => $this->guardianlast,
                'honorific_id' => $this->guardianhonorific_id,
                'pronoun_id' => $this->guardianpronoun_id,
            ]
        );
    }

    private function updateGuardianPhones()
    {
        Phone::updateOrCreate(
            [
                'user_id' => $this->guardian->user_id,
                'phonetype_id' => Phonetype::where('descr', 'phone_guardian_home')->first()->id,
            ],
            [
                'phone' => $this->formatPhone($this->phoneguardianhome),
            ]
        );

        Phone::updateOrCreate(
            [
                'user_id' => $this->guardian->user_id,
                'phonetype_id' => Phonetype::where('descr', 'phone_guardian_mobile')->first()->id,
            ],
            [
                'phone' => $this->formatPhone($this->phoneguardianmobile),
            ]
        );

        Phone::updateOrCreate(
            [
                'user_id' => $this->guardian->user_id,
                'phonetype_id' => Phonetype::where('descr', 'phone_guardian_work')->first()->id,
            ],
            [
                'phone' => $this->formatPhone($this->phoneguardianwork),
            ]
        );
    }
}
