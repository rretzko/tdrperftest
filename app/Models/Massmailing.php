<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Massmailing extends Model
{
    use HasFactory;
    
    protected $fillable = ['audiencetype_id','eventversion_id','massmailingtype_id'];
}
