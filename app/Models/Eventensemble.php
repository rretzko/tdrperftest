<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventensemble extends Model
{
    use HasFactory;

    public function eventensembletype()
    {
        return Eventensembletype::find($this->eventensembletype_id);
    }

    public function eventversions()
    {
        return $this->belongsToMany(Eventversion::class);
    }
}
