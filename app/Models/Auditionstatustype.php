<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditionstatustype extends Model
{
    use HasFactory;

    const UNAUDITIONED=1;
    const TOLERANCE=2;
    const PARTIAL=3;
    const EXCESS=4;
    const COMPLETED=5;
    const ERROR=6;

    protected $fillable = ['background', 'color', 'descr'];
}
