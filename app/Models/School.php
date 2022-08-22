<?php

namespace App\Models;

use App\Traits\MailingAddressTrait;
use App\Traits\SenioryearTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class School extends Model
{
    use HasFactory,MailingAddressTrait,SenioryearTrait, SoftDeletes;

    protected $fillable = ['name', 'address01', 'address02', 'city', 'county_id', 'geostate_id', 'postalcode'];

    public function ensembles()
    {
        return $this->hasMany(Ensemble::class)
            ->with('ensembletype', 'ensembletype.instrumentations');
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function getCurrentStudentsAttribute()
    {
        $students = collect();

        $users =  $this->students()->filter(function($user){
            return $user->person->student->classof >= $this->senioryear();
        });

        foreach($users AS $user){
            $students->push(Student::find($user->id));
        }

        return $students->sortBy('person.last');

    }

    public function getCurrentUserGradesAttribute()
    {
        $grades = DB::table('gradetype_school_user')
            ->where('school_id', '=', $this->id)
            ->where('user_id', '=', auth()->id())
            ->pluck('gradetype_id')
            ->toArray();

        return $grades;
    }

    public function getCurrentGradesAllUsersAttribute()
    {
        $grades = DB::table('gradetype_school_user')
            ->where('school_id', '=', $this->id)
            ->pluck('gradetype_id')
            ->toArray();

        return $grades;
    }

    public function getGeostateAbbrAttribute()
    {
        return ($this->geostate_id) ? Geostate::where('id', $this->geostate_id)->first()->abbr : 'ZZ';
    }

    public function getMailingAddressAttribute()
    {
        return $this->mailingAddress($this);
    }

    /**
     * @since 2020.05.28
     *
     * abbreviate common terms
     *
     * @return string
     */
    public function getShortNameAttribute() : string
    {
        $abbrs = [
            'High School' => 'HS',
            'Regional High School' => 'RHS',
            'International' => 'Int\'l',
            'University' => 'U',
        ];

        //early exit
        if(is_null($this->name) || (! strlen($this->name))){ return 'No school name found';}

        $haystack = $this->name; //avoid repeated downstream calls

        $str = $haystack;   //initialize $str value

        foreach($abbrs AS $descr => $abbr){

            if(strstr($haystack, $descr)){

                $str = str_replace($descr, $abbr, $haystack);
            }
        }

        return $str;
    }

    public function students()
    {
        return $this->users->filter(function($user){
           return $user->isStudent();
        });
    }

    /**
     * @todo See if this is used anywhere; it shouldn't work...
     * @return BelongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'user_id', 'user_id');
    }

    /**
     * Designed for use in Http/Livewire/Siteadministration/Siteadministrator
     */
    public function teachersForTransfer()
    {
        $teachers = collect();

        foreach($this->users AS $user){

            if($user->isTeacher()){

                $teachers->push(Teacher::find($user->id));
            }
        }

        return $teachers->sortBy('person.last');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
