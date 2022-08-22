<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventversionteacherconfig extends Model
{
    use HasFactory;

    protected $fillable = ['eventversion_id', 'paypalstudent', 'school_id', 'user_id'];

    public function eventversion()
    {
        return $this->belongsTo(Eventversion::class);
    }
}
