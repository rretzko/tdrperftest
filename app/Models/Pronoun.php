<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pronoun extends Model
{
    use HasFactory;

    protected $fillable = ['descr', 'intensive', 'personal', 'possessive', 'object', 'order_by'];

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
