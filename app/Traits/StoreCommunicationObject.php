<?php

namespace App\Traits;

use App\Models\Emailtype;
use App\Models\Nonsubscriberemail;
use App\Models\Phone;
use App\Models\Phonetype;
use App\Models\Subscriberemail;

trait StoreCommunicationObject
{
    public function saveEmails($type, $cleanemail, $user_id)
    {
        if(strpos($type, 'guardian') || strpos($type, 'student')){
            //nonsubscriber email
            $email = Nonsubscriberemail::firstOrCreate(
                [
                    'user_id' => $user_id,
                    'emailtype_id' => Emailtype::where('descr', $type)->first()->id,
                ],
                [
                    'email' => $cleanemail,
                ]
            );
        }else{ //subscriber
            $email = Subscriberemail::firstOrCreate(
                [
                    'user_id' => $user_id,
                    'emailtype_id' => Emailtype::where('descr', $type)->first()->id,
                ],
                [
                    'email' => $cleanemail,
                ]
            );
        }

        //update object if user's input differs from current record
        if ($email->email !== $cleanemail) {
            $email->email = $cleanemail;
            $email->save();
        }

    }

    public function savePhones($type, $cleanphone, $user_id)
    {
        $fphone = $this->formatPhone($cleanphone);

        $phone = Phone::firstOrCreate(
            [
                'user_id' => $user_id,
                'phonetype_id' => Phonetype::where('descr', $type)->first()->id,
            ],
            [
                'phone' => $fphone,
            ]
        );

        //update object if user's input differs from current record
        if ($phone->phone !== $fphone) {
            $phone->phone = $fphone;
            $phone->save();
        }
    }

    private function formatPhone($str)
    {
        //early exit
        if(! strlen($str)){ return $str; }

        $sphone = $this->stripPhone($str);

        //phones are always >= 10 digits
        //(###) ###-
        $fphone = '('.substr($sphone,0,3).') '.substr($sphone, 3, 3, ).'-';

        //(###) ###-#### or (###) ###-#### x###
        $fphone .= (strlen($sphone) === 10)
            ? substr($sphone, 6)
            : substr($sphone, 6, 4).' x'.substr($sphone, 10);

        return $fphone;
    }

    private function stripPhone($str)
    {
        $chars = str_split($str);

        $ints = array_filter($chars, function($char){
            return is_numeric($char);
        });

        return implode($ints);
    }
}
