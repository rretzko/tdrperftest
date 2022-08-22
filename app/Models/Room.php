<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $with = ['adjudicators'];

    public function adjudicators()
    {
        return $this->hasMany(\App\Models\Adjudicator::class);
    }

    public function filecontenttypes()
    {
        return $this->belongsToMany(Filecontenttype::class);
    }

    public function getAdjudicatedCountAttribute()
    {
        return __LINE__;
    }

    public function instrumentations()
    {
        return $this->belongsToMany(Instrumentation::class);
    }
}
