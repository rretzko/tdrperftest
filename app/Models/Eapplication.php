<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eapplication extends Model
{
    use HasFactory;

    protected $fillable = ['absences', 'courtesy', 'dressrehearsal', 'eligibility', 'eventversion_id', 'imageuse',
        'lates', 'parentread', 'registrant_id', 'rulesandregs', 'signatureguardian','signaturestudent','videouser'];

    protected $primaryKey = 'registrant_id';

    public function registrant()
    {
        return $this->belongsTo(Registrant::class);
    }

    public function countSignatures(Registrant $registrant)
    {
        $count = 0;

        $eapplication = $this::where('registrant_id', $registrant->id)
            ->first();

        $count += $eapplication->signatureguardian;
        $count += $eapplication->signaturestudent;

        return $count;
    }
}
