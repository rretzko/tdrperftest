<?php

namespace App\Traits;

use App\Models\Membership;
use Illuminate\Support\Facades\Storage;

trait MembershipcardUrlTrait
{
    /**
     * Return the membership card url from digitalocean spaces disk
     *
     * @return string
     */
    public function membershipcardurl(Membership $membership) : string
    {
        if($membership && strlen($membership->membership_card_path)){

            $membershipcard = explode('/',$membership->membership_card_path);

            return array_key_exists('1',$membershipcard)
                ? Storage::disk('spaces')->url($membership->membership_card_path.'/'.$membershipcard[1])
                : '';
        }

        return '';
    }

}
