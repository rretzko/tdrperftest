<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use Encryptable,HasFactory;

    protected $encryptable = ['phone'];

    protected $fillable = ['phone','phonetype_id', 'user_id'];

    public function getPhoneWithLabel(int $user_id, int $phonetype_id) : string
    {
        $phone = Phone::where('user_id', $user_id)
            ->where('phonetype_id', $phonetype_id)
            ->first();

        return $phone->phone.' ('.$phone->phonetype->abbr.')';
    }

    public function getPhoneWithoutLabel(int $user_id, int $phonetype_id) : string
    {
        $phone = Phone::where('user_id', $user_id)
            ->where('phonetype_id', $phonetype_id)
            ->first();

        return $phone->phone;
    }

    public function hasPhoneType(int $user_id, int $phonetype_id) : bool
    {
        return (bool)Phone::where('user_id', $user_id)
            ->where('phonetype_id', $phonetype_id)
            ->first();
    }

    public function person()
    {
        return $this->hasOne(User::class);
    }

    public function phonetype()
    {
        return $this->belongsTo(Phonetype::class);
    }
}
