<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventensembletype extends Model
{
    use HasFactory;

    public function instrumentations()
    {
        return $this->belongsToMany(Instrumentation::class)
            ->orderBy('order_by');
    }
}
