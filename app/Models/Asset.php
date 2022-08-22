<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['created_by','descr'];

    public function canEdit()
    {
        return auth()->id() == $this->created_by;
    }

    public function ensembles()
    {
        return $this->belongsToMany(Ensemble::class)
            ->withTimestamps();
    }

    public function ensemblemembers()
    {
        return $this->belongsToMany(Ensemblemember::class)
            ->withPivot(['tag', 'date_issued','date_returned'])
            ->withTimestamps();
    }
}
