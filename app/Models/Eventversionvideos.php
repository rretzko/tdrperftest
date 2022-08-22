<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventversionvideos extends Model
{
    use HasFactory;

    protected $fillable = ['eventversion_id', 'videotype_ids'];
}
