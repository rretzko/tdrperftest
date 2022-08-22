<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Username extends Model
{
    private $currentusername;
    private $fullname;
    private $newusername;

    protected $fillable = ['currentusername', 'fullname', 'newusername', ];

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->fullname = $attributes['fullname'];
        $this->currentusername = $this->currentUsername();
        $this->newusername = $this->defaultUsername();

    }

    public function newUsername()
    {
        return $this->newusername;
    }

    public function username()
    {
        return $this->defaultusername;
    }

    private function currentUsername()
    {
        //early exit
        if(! auth()->id()){ return '';}

        $user = User::find(auth()->id());

        return $user->username;
    }

    /**
     * Remove any extraneous parts from the last value in $parts
     *
     * @param array $parts
     * @return string
     */
    private function cleanUsername(array $parts) : string
    {
       $dirty = array_pop($parts);
       $dirty1 = str_replace(' ', '', $dirty);
       $dirty2 = str_replace('_', '', $dirty1);
       $dirty3 = str_replace("'", '', $dirty2);
       $dirty4 = str_replace("&#39;", '', $dirty3);
       return str_replace("&#039;", '', $dirty4);
    }

    private function defaultUsername()
    {
        $parts = explode(' ', $this->fullname);
        $str = '';

        if(count($parts) && (count($parts) > 1)){

            $str .= strtolower(substr($parts[0], 0, 1));

            $str .= strtolower($this->cleanUsername($parts));
        }

        return $this->validateUniqueUsername($str);
    }

    private function validateUniqueUsername($str) : string
    {
        $test = User::where('username', $str)->first();
        $suffix = '';

        while($test) {

            $suffix = $str . random_int(100, 999);

            $test = User::where('username', $str.$suffix)->first();
        }

        return $str.$suffix;
    }
}
