<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roletype extends Model
{
    use HasFactory;

    public function memberships()
    {
        return $this->belongsToMany(Membership::class);
    }
}
