<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['expiration', 'grade_levels', 'membership_card_path','membership_id', 'membershiptype_id',
        'organization_id', 'requestedtype_id','subjects', 'user_id',];

    protected $with = ['person','roletypes'];

    public function admin()
    {
        /*
         * 5 => 'event_administrator',
         * 6 => 'registration_manager',
         * 16 => 'domainowner',
         * 19 => 'officer'
         */
        $roletypes_ids = [5,6,16,19];

        foreach($this->roletypes AS $roletype){

            if(in_array($roletype->id, $roletypes_ids)){

                return true;
            }
        }

        return false;
    }
    public function expirationMdy()
    {
        return Carbon::parse($this->expiration)->format('M d, Y');
    }

    public function expired(): bool
    {
        //early exit if $this->expiration === blank || null
        if(! $this->expiration){ return false;}

        return $this->expiration < Carbon::now();
    }

    public function getRoletypeIsAdminAttribute()
    {
        /**
         * 5 => 'event_administrator',
         * 6 => 'registration_manager',
         * 16 => 'domainowner',
         * 19 => 'officer'
         */
        $roletypeids = [5,6,16,19];

        foreach($this->roletypes AS $roletype){

            if(in_array($roletype->id, $roletypeids)){

                return true;
            }
        }

        return false;
    }

    public function getRequesttypedescrAttribute()
    {
        $membershiptype = Membershiptype::find($this->requestedtype_id);

        return $membershiptype->descr ?? 'none';
    }

    public function membershiptype()
    {
        return $this->belongsTo(Membershiptype::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'user_id', 'id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class,'user_id', 'user_id');
    }

    public function roletypes()
    {
        return $this->belongsToMany(Roletype::class);
    }


}
