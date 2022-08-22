<?php

namespace App\Traits;

use App\Models\Registranttype;

trait RegistranttypeBackgroundColorsTrait
{
    /**
     * Return the current senior year
     * if the current month is Jan-June, return the current year, else
     * return the next year
     *
     * @return int
     */
    public static function colors($registranttype_id) : string
    {
        switch($registranttype_id){
            case Registranttype::APPLIED:
                return 'bg-yellow-100';
            case Registranttype::HIDDEN:
                return 'bg-indigo-100';
            case Registranttype::PROHIBITED:
                return 'bg-red-100';
            case Registranttype::REGISTERED:
                return 'bg-green-100';
            default: //Registranttype::ELIGIBLE
                return 'bg-white';
        }
    }
}


