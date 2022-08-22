<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Namecard extends Model
{
    private $emails = [];
    private $emailtypes;
    private $fullnamealpha;
    private $namecard;
    private $phones = [];
    private $phonetypes;
    private $status;
    private $user;

    public function __construct(User $user)
    {
        $this->emailtypes = Emailtype::all();
        $this->namecard = '';
        $this->phonetypes = Phonetype::all();
        $this->user = $user;

        $this->init();
    }

    public function namecard()
    {
        return $this->namecard;
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private function buildNameCard()
    {
        $this->namecard = $this->fullnamealpha.': '.$this->status;
        $this->namecard .= '&#10;';
        $this->namecard .= $this->phones;
        $this->namecard .= '&#10;';
        $this->namecard .= $this->emails;
    }

    private function emails()
    {
        $email = new Email;
        $emails = [];

        foreach($this->emailtypes AS $emailtype) {
            $emails[] = $email->hasEmailType($this->user->id, $emailtype)
                ? $email->getEmail($this->user->id, $emailtype)
                : false;
        }

        $this->emails = implode(' | ', array_filter($emails));
    }

    private function fullNameAlpha()
    {
        $this->fullnamealpha = $this->user->person->fullNameAlpha;
    }

    private function init()
    {
        $this->fullNameAlpha();
        $this->status();
        $this->phones();
        $this->emails();

        $this->buildNamecard();
    }

    private function phones()
    {
        $phone = new Phone;
        $phones = [];

        foreach($this->phonetypes AS $phonetype) {
            $phones[] = $phone->hasPhoneType($this->user->id, $phonetype->id)
                ? $phone->getPhoneWithLabel($this->user->id, $phonetype->id)
                : false;
        }

        $this->phones = implode(' | ', array_filter($phones));
    }

    private function status()
    {
        $status = [];

        if($this->user->isTeacher()){$status[] = 'Teacher';}
        if($this->user->isStudent()){$status[] = 'Student';}
        if($this->user->isGuardian()){$status[] = 'Parent/Guardian';}
        if($this->user->isNonstudent()){$status[] = 'Nonstudent';}

        $this->status = implode(' | ', $status);
    }
}
