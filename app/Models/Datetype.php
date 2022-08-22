<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datetype extends Model
{
    use HasFactory;

    const MEMBERSHIP_OPEN=3;
    const MEMBERSHIP_CLOSE=4;
    const SCORE_OPEN=11;
    const SCORE_CLOSE=12;
    const VIDEOS_CLOSE_MEMBERSHIP=18;

    protected $fillable = ['id','descr'];
}
