<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = ['address0', 'address1', 'city', 'geostate_id', 'name', 'postalcode'];

    public function compositions()
    {
        return $this->belongsToMany(Composition::class);
    }
}
