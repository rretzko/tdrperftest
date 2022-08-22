<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{

    protected $fillable = ['confirmed', 'confirmed_by', 'registrant_id', 'signaturetype_id',];

    public function countForRegistrant(Registrant $registrant)
    {
        return $this->where('registrant_id', $registrant->id)
            ->whereNotNull('confirmed')
            ->count();
    }

    public function registrant()
    {
        return $this->belongsTo(Registrant::class);
    }


}
