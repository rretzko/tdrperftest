<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Honorific extends Model
{
    use HasFactory;

    protected $fillable = ['descr', 'abbr','order_by'];

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
