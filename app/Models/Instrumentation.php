<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrumentation extends Model
{
    use HasFactory;

    public function eventensembletypes()
    {
        return $this->belongsToMany(Eventensembletype::class);
    }

    public function formattedDescr()
    {
        return $this->formatStringWithRomanNumerals($this->descr);
    }

    public function instrumentationbranch()
    {
        return $this->belongsTo(Instrumentationbranch::class);
    }

    public function registrants()
    {
        return $this->belongsToMany(Registrant::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Capitalize all words and uppercase all roman numerals
     * @param $str
     */
    private function formatStringWithRomanNumerals($str)
    {
        $fstr = '';

        foreach(explode(' ', $str) AS $item){

            $fstr .= ($this->isRomanNumeral($item))
                ? strtoupper($item).' '
                : ucwords($item).' ';
        }

        return trim($fstr);
    }

    private function isRomanNumeral($str) : bool
    {
        $rns = ['i', 'ii', 'iii', 'iv', 'v', 'vi', 'vii', 'viii', 'ix', 'x'];

        return in_array(strtolower($str), $rns);
    }
}
