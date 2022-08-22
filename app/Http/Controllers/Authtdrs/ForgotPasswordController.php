<?php

namespace App\Http\Controllers\Authtdrs;

use App\Events\SubscriberPasswordResetEvent;
use App\Http\Controllers\Controller;
use App\Models\Subscriberemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate(['email' => 'required|email']);
        $found = false;
        foreach(Subscriberemail::all() AS $email){

            if(strtolower($email->email) === strtolower($data['email'])){

                $found = true;
                event(new SubscriberPasswordResetEvent($email));
            }

            if($found){break;}
        }

        return ($found)
            ? back()->with(['status' => __('Please check your in-box at '.$email->email.' for your Password Reset link.')])
            : back()->withErrors(__('The email address: '.$request['email'].' was not found.'));
    }
}
