<?php

namespace App\Traits;

trait SenioryearTrait
{
    /**
     * Return the current senior year
     * if the current month is Jan-June, return the current year, else
     * return the next year
     *
     * @return int
     */
    public function senioryear() : int
    {
        $now = strtotime('NOW');

        return (date('n', $now) < 7)
            ? (date('Y', $now)) //Jan - Jun = current year
            : (date('Y', $now) + 1); //Jul - Dec = current year + 1
    }

    public function classOf($grade)
    {
        //early exit
        if($grade > 12){ return $grade;}

        return ($this->senioryear() + (12 - $grade));
    }
}
