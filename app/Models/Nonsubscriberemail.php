<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nonsubscriberemail extends Model
{
    use Encryptable,HasFactory;

    protected $encryptable = ['email'];

    protected $fillable = ['user_id', 'emailtype_id', 'email'];

    public function emailtype()
    {
        return $this->belongsTo(Emailtype::class);
    }
}
