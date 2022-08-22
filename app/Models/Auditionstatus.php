<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditionstatus extends Model
{
    use HasFactory;

    protected $fillable = ['auditionstatustype_id', 'eventversion_id', 'registrant_id','room_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registrant()
    {
        return $this->belongsTo(Registrant::class, 'registrant_id','id');
    }

    public function auditionstatustype()
    {
        return $this->belongsTo(Auditionstatustype::class, 'auditionstatustype_id', 'id');
    }
}
