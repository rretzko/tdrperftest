<?php

namespace App\Traits;

use App\Models\Geostate;

trait MailingAddressTrait
{
    /**
     * @since 2021.03.16
     *
     * Trait for returning a formatted mailing address:
     *  address01
     *  [address02]
     *  city, st zipcode
     *
     * @return array
     */
    public function mailingAddress($obj) : string
    {
        $str = '';
        $str .= $obj->address01;
        $str .= ($obj->address02) ? '<br />'.$obj->address02 : '';
        $str .= ($this->cityStatePostalcode($obj, $str)) ?: '';

        return $str;
    }

    private function cityStatePostalcode($obj, $str) : string
    {
        $city = ($obj->city) ? $obj->city.', ' : '';
        $state = Geostate::where('id', $obj->geostate_id)->first()->abbr;
        $postalcode = ($obj->postalcode) ? '  '.$obj->postalcode : '';

        return ($str) ? '<br />'.$city.$state.$postalcode : $city.$state.$postalcode;
    }
}
