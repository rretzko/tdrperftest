<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventversionconfig extends Model
{
    use HasFactory;

    protected $fillable = ['bestscore','eapplication','epaymentsurcharge','eventversion_id','grades','judge_count',
        'membershipcard','missing_judge_average','paypalstudent','paypalteacher','registrationfee',
        ];

    protected $primaryKey = 'eventversion_id';

    public function eventversion()
    {
        return $this->belongsTo(Eventversion::class);
    }
}
