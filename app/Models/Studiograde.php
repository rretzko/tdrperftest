<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studiograde extends Model
{
    use HasFactory;

    protected $fillable = ['studio_id','gradetype_id'];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
