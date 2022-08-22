<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventversiondate extends Model
{
    use HasFactory;

    protected $fillable = ['datetype_id','dt','eventversion_id'];

    public function eventversion()
    {
        return $this->belongsTo(Eventversion::class);
    }

    public function getDatetypeDescrAttribute()
    {
        return Datetype::find($this->datetype_id)->first()->descr;
    }
}
