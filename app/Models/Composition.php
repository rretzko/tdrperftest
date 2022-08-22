<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Composition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['compositiontype_id', 'compositioncollectiontype_id', 'from', 'subtitle', 'title', ];

    public function publishers()
    {
        return $this->belongsToMany(Publisher::class);
    }
}
