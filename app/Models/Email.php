<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['emailtype_id', 'user_id'];

    public function getEmail(int $user_id, Emailtype $emailtype) : string
    {
        $email = ($emailtype->subscriber)
            ? Subscriberemail::where('user_id', $user_id)
                ->where('emailtype_id', $emailtype->id)
                ->first()
            : Nonsubscriberemail::where('user_id', $user_id)
                ->where('emailtype_id', $emailtype->id)
                ->first();

        return $email->email;
    }

    public function hasEmailType(int $user_id, Emailtype $emailtype) : bool
    {
        return ($emailtype->subscriber)
            ? (bool)Subscriberemail::where('user_id', $user_id)
            ->where('emailtype_id', $emailtype->id)
            ->first()
            : (bool)Nonsubscriberemail::where('user_id', $user_id)
                ->where('emailtype_id', $emailtype->id)
                ->first();
    }


}
