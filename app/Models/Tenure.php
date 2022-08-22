<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenure extends Model
{
    use HasFactory;

    protected $fillable = [
        'endyear', 'school_id', 'startyear', 'user_id',
    ];

    public function school()
    {
        return $this->hasOne(School::class, 'id', 'entity_id')
            ->where('school', 1);
    }

    public function studio()
    {
        return $this->hasOne(Studio::class, 'id', 'entity_id')
            ->where('school', 0);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
