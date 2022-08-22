<?php

namespace App\Http\Livewire\Students;

use App\Models\Email;
use App\Models\Emailtype;
use App\Models\Guardian;
use App\Models\Guardiantype;
use App\Models\Namecard;
use App\Models\Nonsubscriberemail;
use App\Models\Person;
use App\Models\Phone;
use App\Models\Phonetype;
use App\Models\Pronoun;
use App\Models\User;
use App\Traits\StoreCommunicationObject;
use App\Traits\UsernameTrait;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Component;

class Guardiancomponent extends Component
{
    use StoreCommunicationObject, UsernameTrait;

    public $addguardian = false;
    public $confirmingdelete = false;
    public $editguardian = null;
    public $editguardianemailalternate = '';
    public $editguardianemailprimary = '';
    public $editguardianfirst = '';
    public $editguardianlast = '';
    public $editguardianmiddle = '';
    public $editguardianphonehome = '';
    public $editguardianphonemobile = '';
    public $editguardianphonework = '';
    public $editguardianpronounid = 1;
    public $editguardiantype = null;
    public $editguardiantypeid = 1;
    public $guardians = null;
    public $searchname = '';
    public $selecteduserid = 0;
    public $similarnames = '';
    public $student = null;

    protected $rules = [
        'editguardianfirst' => ['required', 'string'],
        'editguardianlast' => ['required', 'string'],
        'editguardianmiddle' => ['nullable', 'string'],
        'editguardianpronounid' => ['required', 'integer'],
        'editguardiantypeid' => ['required', 'integer'],
    ];

    protected $validationAttributes = [
        'editguardianfirst' => 'first name',
        'editguardianlast' => 'last name',
        'editguardianmiddle' => 'middle name',
        'editguardianpronounid' => 'preferred pronoun',
        'editguardiantypeid' => 'parent/guardian type',
    ];

    public function mount()
    {
        $this->guardians = $this->student->guardians;
    }

    public function render()
    {
        return view('livewire.students.guardiancomponent',
        [
            'pronouns' => Pronoun::all(),
            'guardiantypes' => Guardiantype::all(),
            'guardians' => $this->student->guardians,
        ]);
    }

    public function closeForm()
    {
        $this->editguardian = null;
    }

    public function delete($user_id)
    {
        if($this->confirmingdelete) {
            $this->student->guardians()->detach($user_id);
            $this->student->refresh();
            $this->editguardian = null;
            $this->guardians = $this->student->guardians;
            $this->confirmingdelete = false;
        }else{

            $this->confirmingdelete = $user_id;
        }
    }

    public function edit($user_id)
    {
        $this->guardians = $this->student->guardians;

        $this->editguardian = $this->guardians->where('user_id', $user_id)->first();

        $this->editguardianemailalternate = $this->editguardian->emailAlternate->id ? $this->editguardian->emailAlternate->email : '';
        $this->editguardianemailprimary = $this->editguardian->emailPrimary->id ? $this->editguardian->emailPrimary->email : '';
        $this->editguardianfirst = $this->editguardian->person->first;
        $this->editguardianlast = $this->editguardian->person->last;
        $this->editguardianmiddle = $this->editguardian->person->middle ;
        $this->editguardianphonehome = $this->editguardian->phoneHome->id ? $this->editguardian->phoneHome->phone : '';
        $this->editguardianphonemobile = $this->editguardian->phoneMobile->id ? $this->editguardian->phoneMobile->phone : '';
        $this->editguardianphonework = $this->editguardian->phoneWork->id ? $this->editguardian->phoneWork->phone : '';
        $this->editguardianpronounid = $this->editguardian->person->pronoun_id;
        $this->editguardiantypeid = $this->editguardian->guardiantype($this->student->user_id)->id ?? 1;
        $this->editguardiantype = Guardiantype::find($this->editguardiantypeid);
    }

    /**
     * Load form with selected user data WITHOUT saving user as a Guardian and WITHOUT attaching Guardian to
     * $this->student
     *
     * @param $user_id
     */
    public function loadUser($user_id)
    {
        $this->selecteduserid = $user_id;

        $user = User::find($user_id);
        $email = new Email;
        $phone = new Phone;

        // load 'email_guardian_alternate' or if not found, try 'work', else ''
        $this->editguardianemailalternate =
            ($email->hasEmailType($user_id, Emailtype::where('descr', 'email_guardian_alternate')->first()))
            ? $email->getEmail($user_id, Emailtype::where('descr', 'email_guardian_alternate')->first())
            : (($email->hasEmailType($user_id, Emailtype::where('descr', 'work')->first()))
                ? $email->getEmail($user_id, Emailtype::where('descr', 'work')->first())
                : '');
        // load 'email_guardian_primary' or if not found, try 'personal', else ''
        $this->editguardianemailprimary =
            ($email->hasEmailType($user_id, Emailtype::where('descr', 'email_guardian_primary')->first()))
            ? $email->getEmail($user_id, Emailtype::where('descr', 'email_guardian_primary')->first())
            : (($email->hasEmailType($user_id, Emailtype::where('descr', 'personal')->first()))
                ? $email->getEmail($user_id, Emailtype::where('descr', 'personal')->first())
                : '');
        $this->editguardianfirst = $user->person->first;
        $this->editguardianlast = $user->person->last;
        $this->editguardianmiddle = $user->person->middle ;
        // load 'phone_guardian_home' or if not found, try 'home', else ''
        $this->editguardianphonehome =
            ($phone->hasPhoneType($user_id, Phonetype::where('descr', 'phone_guardian_home')->first()->id))
                ? $phone->getPhoneWithoutLabel($user_id, Phonetype::where('descr', 'phone_guardian_home')->first()->id)
                : (($phone->hasPhoneType($user_id, Phonetype::where('descr', 'home')->first()->id))
                    ? $phone->getPhoneWithoutLabel($user_id, Phonetype::where('descr', 'home')->first()->id)
                    : '');
        // load 'phone_guardian_mobile' or if not found, try 'mobile', else ''
        $this->editguardianphonemobile =
            ($phone->hasPhoneType($user_id, Phonetype::where('descr', 'phone_guardian_mobile')->first()->id))
                ? $phone->getPhoneWithoutLabel($user_id, Phonetype::where('descr', 'phone_guardian_mobile')->first()->id)
                : (($phone->hasPhoneType($user_id, Phonetype::where('descr', 'mobile')->first()->id))
                    ? $phone->getPhoneWithoutLabel($user_id, Phonetype::where('descr', 'mobile')->first()->id)
                    : '');
        $this->editguardianphonework =
            ($phone->hasPhoneType($user_id, Phonetype::where('descr', 'phone_guardian_work')->first()->id))
                ? $phone->getPhoneWithoutLabel($user_id, Phonetype::where('descr', 'phone_guardian_work')->first()->id)
                : (($phone->hasPhoneType($user_id, Phonetype::where('descr', 'work')->first()->id))
                ? $phone->getPhoneWithoutLabel($user_id, Phonetype::where('descr', 'work')->first()->id)
                : '');
        $this->editguardianpronounid = $user->person->pronoun_id;
        $this->editguardiantypeid = $this->editguardian->guardiantype($this->student->user_id)->id ?? 1;
        $this->editguardiantype = Guardiantype::find($this->editguardiantypeid);

        $this->similarnames = '';
    }

    public function save()
    {
        $this->validate();

        //update existing guardian
        if($this->editguardian && $this->editguardian->user_id) { //update existing Guardian object

            $this->update();

        }else{ //or create a new guardian

            $this->store();
        }

        //what to do if failure to create a new guardian
        if(! $this->editguardian) { //may be false if $this->store() fails

            $this->editguardian = null;

            $this->emit('guardian-failed');

        }else{ //continue updating or inserting guardian components

            //emails and phones
            $this->updateOrCreateCommunicationObjects();

            //refresh objects
            $this->editguardian->refresh();
            $this->student->refresh();
            $this->guardians = $this->student->guardians;

            //refresh individual editguardian* properties
            $this->edit($this->editguardian->user_id);

            $this->emit('guardian-saved');
        }
    }

    public function updatedAddguardian()
    {
        $this->editguardian = new Guardian;

        $this->editguardianemailalternate = '';
        $this->editguardianemailprimary = '';
        $this->editguardianfirst = '';
        $this->editguardianlast = '';
        $this->editguardianmiddle = '';
        $this->editguardianphonehome = '';
        $this->editguardianphonemobile = '';
        $this->editguardianphonework = '';
        $this->editguardianpronounid = 1;
        $this->editguardiantypeid = 1;
    }

    public function updatedEditguardianfirst()
    {
        $this->searchForDuplicate();
    }

    public function updatedEditguardianlast()
    {
        $this->searchForDuplicate();
    }
/** END OF PUBLIC FUNCTIONS  *************************************************/

    /**
     * @todo build failsafes for avoiding duplicate entries on guardians
     *  - ex. compare/validate last name, email, phone numbers before saving
     */
    private function searchForDuplicate()
    {
        //search when a complete name is available
        if (strlen($this->editguardianfirst) && strlen($this->editguardianlast)){

            $persons = Person::where('first', 'LIKE', '%' . substr($this->editguardianfirst, 0, 1) . '%')
                ->where('last', 'LIKE', '%' . $this->editguardianlast . '%')
                ->orderBy('last')
                ->orderBy('first')
                ->get();

            if ($persons->count()) {
                $this->similarnames = '<h4>' . $persons->count() . ' similar Guardian/Parents found</h4>';
                $this->similarnames .= '<ul>';
                foreach ($persons as $person) {

                    $namecard = new Namecard($person->user);

                    $this->similarnames .= '<li>'
                        . '<span wire:click="loadUser('.$person->user_id.')"
                                class="text-blue-500 cursor-pointer"
                                title="' . $namecard->namecard() . '">'
                        . $person->fullNameAlpha
                        . '</span>'
                        . '</li>';
                }
                $this->similarnames .= '</ul>';
            }
        }
    }

    private function store()
    {
        if($this->selecteduserid){ //user exists in database but not as an existing guardian

            $this->storeNewGuardian();

        }else {

            $user = User::create([
                'username' => $this->username($this->editguardianfirst, $this->editguardianlast),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),]);

            Person::create([
                'user_id' => $user->id,
                'first' => $this->editguardianfirst,
                'middle' => $this->editguardianmiddle,
                'last' => $this->editguardianlast,
                'pronoun_id' => $this->editguardianpronounid,
            ]);

            Guardian::create([
                'user_id' => $user->id,
            ]);

            /** Workaround because $guardian always returns model with user_id === 0 */
            $this->editguardian = Guardian::find($user->id);

            $this->updateOrCreateCommunicationObjects();

            $this->editguardian->students()->attach($this->student->user_id,
                ['guardiantype_id' => $this->editguardiantypeid]);

            $this->editguardian->refresh();
        }
    }

    /**
     *
     */
    private function storeNewGuardian()
    {
        Person::where('user_id', $this->selecteduserid)
            ->update(
                [
                    'first' => $this->editguardianfirst,
                    'middle' => $this->editguardianmiddle,
                    'last' => $this->editguardianlast,
                    'pronoun_id' => $this->editguardianpronounid,
                ]
            );

        Guardian::create([
            'user_id' => $this->selecteduserid,
        ]);

        /** Workaround because $guardian always returns model with user_id === 0 */
        $this->editguardian = Guardian::find($this->selecteduserid);

        $this->updateOrCreateCommunicationObjects();

        //add or edit student attachments
        if($this->editguardian->students->contains($this->student)) {

            $this->editguardian->students()->updateExistingPivot($this->student->user_id,
                ['guardiantype_id' => $this->editguardiantypeid]);

        }else{

            $this->editguardian->students()->attach($this->student->user_id,
                ['guardiantype_id' => $this->editguardiantypeid]);
        }

        $this->editguardian->refresh();

        //resets
        $this->selecteduserid = 0;
    }

    private function updateOrCreateCommunicationObjects()
    {
        //emails
        $this->saveEmails('email_guardian_alternate', $this->editguardianemailalternate, $this->editguardian->user_id);
        $this->saveEmails('email_guardian_primary', $this->editguardianemailprimary, $this->editguardian->user_id);

        //phones
        $this->savePhones('phone_guardian_home', $this->editguardianphonehome, $this->editguardian->user_id);
        $this->savePhones('phone_guardian_mobile', $this->editguardianphonemobile, $this->editguardian->user_id);
        $this->savePhones('phone_guardian_work', $this->editguardianphonework, $this->editguardian->user_id);
    }

    private function update()
    {
        //update person data
        $person = $this->editguardian->person;
        $person->first = $this->editguardianfirst;
        $person->middle = $this->editguardianmiddle;
        $person->last = $this->editguardianlast;
        $person->pronoun_id = $this->editguardianpronounid;
        $person->save();

        //update guardiantype_id pivot
        $this->editguardian->students()->updateExistingPivot($this->student->user_id,
            ['guardiantype_id' => $this->editguardiantypeid]);
    }
}
