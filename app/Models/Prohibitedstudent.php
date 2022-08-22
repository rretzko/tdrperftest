<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prohibitedstudent extends Model
{
    use HasFactory;
    
    protected $fillable = ['eventversion_id', 'prohibitiontype_id', 'user_id', 'updated_by'];
}
