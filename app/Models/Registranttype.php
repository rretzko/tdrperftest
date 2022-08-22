<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registranttype extends Model
{

    protected $fillable = ['id','descr'];

    const APPLIED = 15;
    const ELIGIBLE = 14;
    const HIDDEN = 17;
    const NOAPP = 24;
    const PROHIBITED = 18;
    const REGISTERED = 16;

    public function registrants()
    {
        return $this->hasMany(Registrant::class);
    }
}
