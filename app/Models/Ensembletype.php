<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ensembletype extends Model
{
    protected $fillable = ['descr'];

    public function instrumentations()
    {
        return $this->belongsToMany(Instrumentation::class)
            ->orderByPivot('order_by');
    }
}
