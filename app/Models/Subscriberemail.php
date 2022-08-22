<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriberemail extends Model
{
    use Encryptable,HasFactory;

    protected $encryptable = ['email'];

    protected $fillable = ['emailtype_id', 'user_id', 'email'];

    public function person()
    {
        return $this->hasOne(User::class);
    }
}
