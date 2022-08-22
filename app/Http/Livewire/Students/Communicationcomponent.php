<?php

namespace App\Http\Livewire\Students;

use App\Models\Emailtype;
use App\Models\Nonsubscriberemail;
use App\Models\Phone;
use App\Models\Phonetype;
use App\Models\Student;
use App\Traits\FormatPhoneTrait;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Communicationcomponent extends Component
{
    use FormatPhoneTrait;

    public $emailpersonal = '';
    public $emailschool = '';
    public $phonehome = '';
    public $phonemobile = '';
    public $student = null;

    protected $rules = [
            'emailpersonal' => ['nullable', 'email:rfc,dns',],
            'emailschool' => ['nullable', 'email:rfc,dns',],
            'phonehome' => ['nullable', 'string','min:10'],
            'phonemobile' => ['nullable', 'string','min:10'],
        ];

    protected $validationAttributes = [
      'emailpersonal' => 'personal email',
      'emailschool' => 'school email',
      'phonehome' => 'home phone',
      'phonemobile' => 'cell phone',
    ];

    public function mount()
    {
        $this->emailpersonal = $this->student->emailPersonal->id ? $this->student->emailPersonal->email : '';
        $this->emailschool = $this->student->emailSchool->id ? $this->student->emailSchool->email : '';
        $this->phonehome = $this->student->phoneHome->id ? $this->student->phoneHome->phone : '';
        $this->phonemobile = $this->student->phoneMobile->id ? $this->student->phoneMobile->phone : '';
    }

    public function render()
    {
        return view('livewire.students.communicationcomponent');
    }

    public function save()
    {
        $this->validate();

        $this->removeDuplicates();

        $this->saveEmails();

        $this->formatPhones();

        $this->savePhones();

        $this->emit('communication-saved');
    }

    private function formatPhones()
    {
        $this->phonehome = $this->formatPhone($this->phonehome);
        $this->phonemobile = $this->formatPhone($this->phonemobile);
    }

    private function removeDuplicateEmails()
    {
        if(strtolower($this->emailpersonal) === strtolower($this->emailschool)){

            //remove the email school
            $this->emailschool = '';
        }
    }

    private function removeDuplicatePhones()
    {
        if($this->stripPhone($this->phonehome) === $this->stripPhone($this->phonemobile)){

            //remove the home phone
            $this->phonehome = '';
        }
    }

    private function removeDuplicates()
    {
        $this->removeDuplicateEmails();

        $this->removeDuplicatePhones();
    }

    private function saveEmails()
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

    private function savePhones()
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


    private function stripPhone($str)
    {
        $chars = str_split($str);

        $ints = array_filter($chars, function($char){
           return is_numeric($char);
        });

        return implode($ints);
    }
}
