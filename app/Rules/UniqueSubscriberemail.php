<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueSubscriberemail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach(\App\Models\Subscriberemail::all() AS $email){
            if(strtolower($email->email) === strtolower($value)){

                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email provided is already in use. Please use the "Already registered?" link below.';
    }
}
