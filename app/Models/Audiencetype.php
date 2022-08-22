<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audiencetype extends Model
{
    use HasFactory;
    
    protected $fillable = ['descr'];
}
