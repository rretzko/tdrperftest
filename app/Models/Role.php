<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['roletype_id', 'user_id'];

    public function add($user_id, $descr)
    {
        $this->create([
            'user_id' => $user_id,
            'roletype_id' => Roletype::where('descr', $descr)->first()->id,
        ]);
    }
}
