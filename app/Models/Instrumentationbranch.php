<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrumentationbranch extends Model
{
    use HasFactory;

    public const CHORAL = '1';
    public const INSTRUMENTAL = '2';
    public const MIXED = '3';
    public const NONE = '4';
}
