<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signaturetype extends Model
{
    protected $fillable = ['descr'];

    const TEACHER = 4;
}
