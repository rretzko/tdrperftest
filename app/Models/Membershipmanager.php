<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membershipmanager extends Model
{
    use HasFactory;

    public $organization_id;
    public $roletype_id;

    public function users()
    {
        //memberships->organization_id = ###
        //membership_roletype.membership_id = memberships.id
        //membership_roletype.roletype_id = roletype.descr = 'membership manager'
        return Membership::where('organization_id', $this->organization_id)
            ->where('roletype_id', $this->roletype_id)
            ->get();
    }
}
