<?php

namespace App\Traits;

use App\Models\Searchable;
use App\Models\User;

trait UsernameTrait
{
    /**
     * @since 2021.04.27
     *
     * Trait for creating unique username

     * @return string
     */
    public function username($first,$last) : string
    {
        $root = strtolower(substr($first,0,1).$last);
        $username = $root;

        while(User::where('username', $username)->first()){

            $username = $root.rand(100,999);
        }

        return $username;
    }
}
