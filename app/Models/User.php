<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $with = ['person'];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function ensembles()
    {
        return $this->hasMany(Ensemble::class);
    }

    public function instrumentations()
    {
        return $this->belongsToMany(Instrumentation::class);
    }

    public function isGuardian() : bool
    {
        return (bool)Guardian::find($this->id);
    }

    /**
     * Future expansion for members of the public who may participate in a teacher's program but
     * not be a student, teacher or parent/guardian.
     * ex. Uncle participating in a 'Guys Nite Out' chorus
     *
     * @return bool
     */
    public function isNonstudent() : bool
    {
        return false;
    }

    public function isStudent() : bool
    {
        return (bool)Student::find($this->id);
    }

    public function isTeacher() : bool
    {
        return (bool)Teacher::find($this->id);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class);
    }

    public function tenures()
    {
        return $this->hasMany(Tenure::class);
    }

    public function searchables()
    {
        return $this->belongsToMany(Searchable::class)
            ->withTimestamps()
            ->withPivot('searchtype_id');
    }
}
