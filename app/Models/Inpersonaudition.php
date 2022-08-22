<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inpersonaudition extends Model
{

    protected $fillable = ['eventversion_id', 'inperson', 'registrant_id', 'user_id'];

    public function registrant()
    {
        return $this->belongsTo(Registrant::class);
    }
}
