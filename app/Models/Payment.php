<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'eventversion_id', 'paymenttype_id', 'registrant_id', 'school_id', 'vendor_id',
        'updated_by','user_id',];

    public function paymenttype()
    {
        return $this->belongsTo(Paymenttype::class);
    }

}
