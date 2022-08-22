<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    public function compositions()
    {
        return $this->belongsToMany(Composition::class)
            ->with('publisher');
    }
}
