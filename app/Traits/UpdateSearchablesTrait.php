<?php

namespace App\Traits;

use App\Models\Searchable;

trait UpdateSearchablesTrait
{
    /**
     * @since 2021.03.02
     *
     * Trait for creating/updating Searchables row

     * @return array
     */
    public function updateSearchables($user_id, $descr, $raw) : void
    {
        $searchable = new Searchable();

        if(strlen($raw)) {
            $searchable->add($user_id, $descr, $raw);
        }else{
            $searchable->remove($user_id, $descr);
        }
    }
}
