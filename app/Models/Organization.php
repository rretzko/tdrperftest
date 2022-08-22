<?php

namespace App\Models;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Organization extends Model
{
    use HasFactory;

    //protected $with = ['memberships',];

    /**
     * @since 2020.08.04
     *
     * RECURSIVE METHOD
     *
     * Return array of Organizations above $this with direct parent-child relationship
     */
    public function ancestors(array $organizations = [], $includethis=false)
    {
        //early exit
        if($this->parent_id === 0){return $organizations;}

        $parent = Organization::find($this->parent_id);

        array_unshift($organizations, $parent);

        if($includethis){
            $orgs = $parent->ancestors($organizations);
            $orgs[] = $this;
            return $orgs;
        }else {
            return $parent->ancestors($organizations);
        }
    }/**
     * Return organizations by:
     *  a) Parent_id === 0, alpha order
     *  b) child organization, alpha order
     *  c) grandchild organiztion, alpha order
     *  d) etc.
     */
    public function parents()
    {
        return Organization::where('parent_id', 0)
            ->orderBy('name')
            ->get();
    }

    public function children()
    {
        return Organization::where('parent_id', $this->id)
            ->orderBy('name')
            ->get();
    }

    /**
     * Returns flat, semi-ordered Collection of Organizations from $this->id through lowest branch of tree
     *
     * @return Collection
     */
    public function decendentsTree()
    {
        $orgs = collect();

        foreach(Organization::where('parent_id', $this->id)->get() AS $child){
            if($child->hasChildren){
                foreach(Organization::where('parent_id', $child->id)->get() AS $grandchild){
                    if($grandchild->hasChildren){
                        foreach(Organization::where('parent_id', $grandchild->id)->get() AS $greatgrandchild){
                            if($greatgrandchild->hasChildren){
                                foreach(Organization::where('parent_id', $greatgrandchild->id)->get() AS $great2grandchild){
                                    $orgs->prepend($great2grandchild);
                                }
                            }
                            $orgs->prepend($greatgrandchild);
                        }
                    }
                    $orgs->prepend($grandchild);
                }
            }

            $orgs->prepend($child);
        }

        $orgs->prepend($this);

        return $orgs;
    }

    public function getAuditionsuiteStatusAttribute() : string
    {
        return Auditionsuitestatus::status($this);
    }

    public function getHasChildrenAttribute() : bool
    {
        return (bool)DB::table('organizations')
            ->where('parent_id', '=', $this->id)
            ->get();
    }

    public function getHasMembershipmanagersAttribute()
    {
        return DB::table('memberships')
            ->join('membership_roletype', 'memberships.id','=','membership_roletype.membership_id')
            ->join('roletypes','membership_roletype.roletype_id','=','roletypes.id')
            ->where('memberships.organization_id','=',$this->id)
            ->where('roletypes.descr','=','membership manager')
            ->select('roletypes.descr')
            ->count();
    }

    /**
     * Iterate through memberships to determine if one belongs to $user_id
     * @param $user_id
     * @return mixed
     */
    public function isMember($user_id) : bool
    {
        static $pending = Membershiptype::PENDING;

        return (bool)Membership::where('user_id', $user_id)
            ->where('organization_id', $this->id)
            ->where('membershiptype_id', '<>', $pending)
            ->count();
    }

    public function isPending($user_id)
    {
        static $pending = Membershiptype::PENDING;

        return (bool)Membership::where('user_id', $user_id)
            ->where('organization_id', $this->id)
            ->where('membershiptype_id', '=', $pending)
            ->count();
    }


    public function membership($user_id)
    {
        return Membership::where('user_id', $user_id)
            ->where('organization_id', $this->id)
            ->first();
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function membershipmanagers()
    {
        $persons = collect();

        foreach(DB::table('memberships')
            ->join('membership_roletype', 'memberships.id','=','membership_roletype.membership_id')
            ->join('roletypes','membership_roletype.roletype_id','=','roletypes.id')
            ->where('memberships.organization_id','=',3) //$this->id)
            ->where('roletypes.descr','=','membership manager')
            ->select('memberships.user_id')
            ->get() AS $stdobj){

            $persons->push(Person::find($stdobj->user_id));
        }

        return $persons;
    }

    public function users()
    {
        //return $this->belongsToMany(User::class);
    }

}
