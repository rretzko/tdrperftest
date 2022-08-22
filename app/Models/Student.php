<?php

namespace App\Models;

use App\Traits\SenioryearTrait;
use App\Traits\UpdateSearchablesTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SenioryearTrait, UpdateSearchablesTrait,SoftDeletes;

    protected $fillable = ['birthday', 'classof','height', 'shirtsize_id', 'user_id'];

    protected $primaryKey = 'user_id';

    protected $with = ['person', 'teachers'];

    public $school_id;
    public $student_user_id;
    public $teacher_user_id;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function getCurrentSchoolAttribute()
    {
        foreach($this->person->user->schools AS $school){

            if($school->currentUserGrades &&
                in_array($this->getGradeAttribute(), $school->currentUserGrades)){

                return $school;
            }
        }

        return new School;
    }

    /**
     * Use this function when calling for NOT auth()->id()
     * @return School|mixed
     */
    public function getCurrentSchoolAllUsersAttribute()
    {
        foreach($this->person->user->schools AS $school){

            if($school->currentGradesAllUsers &&
                in_array($this->getGradeAttribute(), $school->currentGradesAllUsers)){

                return $school;
            }
        }
        //$teacherschools = $this->teachers->first()->person->user->schools;
        //$schools = $this->person->user->schools;

        //foreach($schools AS $school){

        //    if($teacherschools->contains($school)){

        //        return $school;
        //    }
        //}

        return new School;
    }

    public function getCurrentSchoolnameAttribute()
    {
        return $this->getCurrentSchoolAttribute()->name;
    }

    public function getCurrentTeachernameAttribute()
    {
        $school = $this->getCurrentSchoolAttribute();

        foreach($this->teachers AS $teacher){

            if($teacher->person->user->schools->contains($school)){

                return $teacher->person->fullName;
            }
        }

        return 'No teacher found';
    }

    public function getEmailPersonalAttribute()
    {
        return Nonsubscriberemail::where('user_id',$this->user_id)
            ->where('emailtype_id', Emailtype::where('descr', 'email_student_personal')->first()->id)
            ->first()
            ?? new Nonsubscriberemail;
    }

    public function getEmailSchoolAttribute()
    {
        return Nonsubscriberemail::where('user_id',$this->user_id)
                ->where('emailtype_id', Emailtype::where('descr', 'email_student_school')->first()->id)
                ->first()
                ?? new Nonsubscriberemail;
    }

    public function getEmailsCsvAttribute()
    {
        $emails = [];

        if($this->getEmailPersonalAttribute()->id){
            $emails[] = $this->getEmailPersonalAttribute()->email;
        }

        if($this->getEmailSchoolAttribute()->id){
            $emails[] = $this->getEmailSchoolAttribute()->email;
        }

        return implode(', ',$emails);
    }

    public function getEmergencyContactStatusAttribute() : bool
    {
        $name = false;
        $email = false;
        $cellphone = false;

        foreach($this->guardians AS $guardian){

            $name = strlen($guardian->person->fullName);
            $email = (strlen($guardian->emailCsv));
            $cellphone = strlen($guardian->phoneCsv);

            if($name && $email && $cellphone){

                break;
            }
        }

        return ($name && $email && $cellphone);
    }

    /**
     * Return formatted birthdate
     * ex. January 4, 2021
     */
    public function getFbirthdayAttribute()
    {
        return Carbon::parse($this->birthday)->format('M d, Y');
    }

    public function getGradeAttribute()
    {
        $sr_year = $this->senioryear();

        //early exit
        if($this->classof < $sr_year){ return 'alum';}

        return (12 - ($this->classof - $sr_year));
    }

    public function getGradeClassofAttribute() : string
    {
        return $this->getGradeAttribute().' ('.$this->classof.')';
    }

    public function getHeightFootInchAttribute()
    {
        return floor($this->height / 12)."' ".($this->height % 12).'" ('.$this->height.'")';
    }

    public function getPhoneHomeAttribute()
    {
        return Phone::where('user_id',$this->user_id)
                ->where('phonetype_id', Phonetype::where('descr', 'phone_student_home')->first()->id)
                ->first() ?? new Phone;
    }

    public function getPhoneMobileAttribute()
    {
        return Phone::where('user_id',$this->user_id)
                ->where('phonetype_id', Phonetype::where('descr', 'phone_student_mobile')->first()->id)
                ->first() ?? new Phone;
    }

    public function getStatusAttribute()
    {
        if($this->senioryear() > $this->classof){
            return 'alum';
        }

        return 'current';
    }

    public function getSysAdminCurrentTeachernameAttribute()
    {
        $school = $this->getCurrentSchoolAllUsersAttribute();

        foreach($this->teachers AS $teacher){

            if($teacher->person->user->schools->contains($school)){

                return $teacher->person->fullName;
            }
        }

        return 'No teacher found';
    }

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'guardian_student', 'student_user_id', 'guardian_user_id')
            ->withPivot('guardiantype_id');
    }

    public function nonsubscriberemails()
    {
        return $this->hasMany(Nonsubscriberemail::class, 'user_id', 'user_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'user_id', 'user_id');
    }

    public function registrants()
    {
        return $this->hasMany(Registrant::class, 'user_id', 'user_id');
    }

    public function scopeWithAll($query)
    {
        $query->with('person', 'person.user');
    }

    public function phones()
    {
        return $this->hasMany(Phone::class, 'user_id', 'user_id');
    }

    public function searchName($str="bla")
    {
        /*$items = Person::all()->filter(function($record) use($str) {
            if(($record->first) == $searchValue) {
                return $record;
            }
        });*/
    }

    public function setSearchables()
    {
        $user = $this->person->user;

        $this->updateSearchables($user, 'name', $this->person->first.$this->person->middle.$this->person->last);

        $this->updateSearchables($user, 'email_student_personal', ($this->emailPersonal->id ? $this->emailPersonal->email : ''));
        $this->updateSearchables($user, 'email_student_school', ($this->emailSchool->id ? $this->emailSchool->email : ''));
        $this->updateSearchables($user, 'phone_student_home', ($this->phoneHome->id ? $this->phoneHome->phone : ''));
        $this->updateSearchables($user, 'phone_student_mobile', ($this->phoneMobile->id ? $this->phoneHome->phone : ''));

    }

    public function shirtsize()
    {
        return $this->belongsTo(Shirtsize::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'student_teacher','student_user_id', 'teacher_user_id')
            ->withPivot('studenttype_id')
            ->withTimestamps()
            ->orderBy('updated_at','desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

/** END OF PUBLIC FUNCTIONS **************************************************/


}
