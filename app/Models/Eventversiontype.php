<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventversiontype extends Model
{
    use HasFactory;

    const ADMIN = 25;
    const OPEN = 21;

    protected $fillable = ['id','descr'];
}
