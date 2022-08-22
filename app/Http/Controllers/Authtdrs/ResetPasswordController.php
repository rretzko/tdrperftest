<?php

namespace App\Http\Controllers\Authtdrs;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\Subscriberemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/* FROM App/Actions/Fortify/UpdateUserPassword.php */
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class ResetPasswordController extends Controller
{
    use PasswordValidationRules;

    public function show(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $parts = explode('/', $request->path());

        $user_id = (array_pop($parts));


        //Auth::loginUsingId($user_id);

        return view('auth.reset-password-tdr',['email' => '', 'token' => $user_id]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'token' => ['required', 'numeric'],
            'email' => ['required','email'],
            'password' => ['required', 'string']
        ]);

        $input = [
            'password' => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
            ];

        $found = false;

        foreach(Subscriberemail::all() AS $email){

            if($email->email === $data['email']){

                $found = true;
            }

            if($found){break;}
        }

        if($email && ($email->user_id == $data['token'])){

            $user = User::find($request['token']);

            Validator::make($input, [
         //       'current_password' => ['required', 'string'],
                'password' => $this->passwordRules(),
            ])->after(function ($validator) use ($user, $input) {
         //       if (! isset($input['current_password']) || ! Hash::check($input['current_password'], $user->password)) {
          //          $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
         //       }
            })->validateWithBag('updatePassword');

            $user->forceFill([
                'password' => Hash::make($input['password']),
            ])->save();

            auth()->logout();

            Session::flash('status', 'Password reset. Please use the "Log in" link to log into TheDirectorsRoom.com');

            return view('auth.reset-password-success-tdr');

        }else{

            return back()->withErrors('Invalid email entered.  Please try again...');
        }

    }

}
