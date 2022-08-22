<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Person extends Model
{
    use Encryptable,HasFactory;

    protected $encryptable = [ //encryptable fields
      //  'first',
      //  'middle',
      //  'last'
    ];

    protected $fillable = [
        'first', 'middle', 'last', 'honorific_id', 'pronoun_id','user_id',
    ];

    protected $primaryKey = 'user_id';

    protected $with = ['subscriberemails'];

    /**
     * Resulting sql:
     * select `ensembles`.*, `ensemblemembers`.`user_id` as `laravel_through_key`
     * from `ensembles`
     * inner join `ensemblemembers`
     *      on `ensemblemembers`.`ensemble_id` = `ensembles`.`id`
     *      where `ensemblemembers`.`user_id` in
     *              (439, 460, 461, 517, 518, 519, 571, 614, 631, 633, 634, 666, 667, 668, 669, 670, 676, 678, 679, 680, 688, 695, 753, 754, 755, 762, 801, 802, 809, 955, 1121, 1193, 1207, 1241, 1253, 1262, 1376, 1433, 1463, 1477, 1480, 1532, 1561, 1572, 1599, 1602, 1750, 1812, 1870, 1876, 1878)
     *          and `ensembles`.`deleted_at` is null
     *          and `ensemblemembers`.`deleted_at` is null
     *
     * @return HasManyThrough
     */
    public function ensembles()
    {
        return $this->hasManyThrough(Ensemble::class, Ensemblemember::class,
            'user_id', //good: Ensemblemember.user_id related to Person
            'id', //good: Ensemble.id related to Ensemblemember
            'user_id', //good: Person.user_id related to $this
            'ensemble_id'); //good Ensemblemember.ensemble_id related to Ensemble
    }

    public function getFullNameAttribute()
    {
        $str = $this->first;
        $str .= (strlen($this->middle)) ? ' '.$this->middle : '';
        $str .= ' '.$this->last;

        return $str;
    }

    public function getFullNameAlphaAttribute()
    {
        $str = $this->last;
        $str .= ', '.$this->first;
        $str .= (strlen($this->middle)) ? ' '.$this->middle : '';

        return $str;
    }

    public function getHonorificDescrAttribute()
    {
        return Honorific::find($this->honorific_id)->abbr;
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class,'user_id', 'user_id');
    }

    public function honorific()
    {
        return $this->belongsTo(Honorific::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class, 'user_id');
    }

    public function pronoun()
    {
        return $this->belongsTo(Pronoun::class);
    }

    public function scopeWithAll($query)
    {
        $query->with('user');
    }

    public function setSearchable()
    {
        $s = new Searchable;

        $s->add($this->user, 'name', $this->first.$this->middle.$this->last);
    }

    /**
     * Synonym
     * @return string
     */
    public function getEmailOtherAttribute()
    {
        return $this->getSubscriberemailotherAttribute();
    }

    /**
     * Synonym
     * @return string
     */
    public function getEmailPersonalAttribute()
    {
        return $this->getSubscriberemailpersonalAttribute();
    }

    /**
     * Synonym
     * @return string
     */
    public function getEmailWorkAttribute()
    {
        return $this->getSubscriberemailworkAttribute();
    }

    public function getSubscriberemailotherAttribute()
    {
        return $this->subscriberemails->where('emailtype_id', Emailtype::OTHER)->first()->email ?? '';
    }

    public function getSubscriberemailpersonalAttribute()
    {
        return $this->subscriberemails->where('emailtype_id', Emailtype::PERSONAL)->first()->email ?? '';
    }

    public function subscriberemails()
    {
        return $this->hasMany(Subscriberemail::class, 'user_id');
    }

    public function getSubscriberemailsStackedAttribute()
    {
        $str = '<ul>';

        foreach($this->subscriberemails()->get() AS $email){

            $str .= '<li>'.$email->email.'</li>';
        }

        $str .= '</ul>';

        return $str;
    }

    public function getSubscriberemailworkAttribute()
    {
        return $this->subscriberemails->where('emailtype_id', Emailtype::WORK)->first()->email ?? '';
    }

    /**
     * @todo refactor this to: return implode(', ', $this->getSubscriberPhoneArrayAttribute());
     * @return string
     */
    public function getSubscriberPhoneCsvAttribute()
    {
        $phones = [];

        $home = Phone::where('user_id', $this->user_id)
            ->where('phonetype_id', Phonetype::HOME)
            ->first();

        $mobile = Phone::where('user_id', $this->user_id)
            ->where('phonetype_id', Phonetype::MOBILE)
            ->first();

        $work = Phone::where('user_id', $this->user_id)
            ->where('phonetype_id', Phonetype::WORK)
            ->first();

        if($mobile){$phones[] = $mobile->phone.' (c)';}
        if($home){$phones[] = $home->phone.' (h)';}
        if($work){$phones[] = $work->phone.' (w)';}

        return implode(', ', $phones);
    }

    public function getSubscriberPhoneArrayAttribute()
    {
        $phones = [];

        $home = Phone::where('user_id', $this->user_id)
            ->where('phonetype_id', Phonetype::HOME)
            ->first();

        $mobile = Phone::where('user_id', $this->user_id)
            ->where('phonetype_id', Phonetype::MOBILE)
            ->first();

        $work = Phone::where('user_id', $this->user_id)
            ->where('phonetype_id', Phonetype::WORK)
            ->first();

        if($mobile){$phones[] = $mobile->phone.' (c)';}
        if($home){$phones[] = $home->phone.' (h)';}
        if($work){$phones[] = $work->phone.' (w)';}

        return $phones;
    }

    public function phoneHome()
    {
        $phone = Phone::where('user_id', $this->user_id)
            ->where('phonetype_id', Phonetype::HOME)
            ->first();

        if($phone){ return $phone->phone.' (h)'; }

        return '';
    }

    public function phoneMobile()
    {
        $phone = Phone::where('user_id', $this->user_id)
            ->where('phonetype_id', Phonetype::MOBILE)
            ->first();

        if($phone){ return $phone->phone.' (c)'; }

        return '';
    }

    public function phoneWork()
    {
        $phone = Phone::where('user_id', $this->user_id)
            ->where('phonetype_id', Phonetype::WORK)
            ->first();

        if($phone){ return $phone->phone.' (w)'; }

        return '';
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class,'user_id', 'user_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
