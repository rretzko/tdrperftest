<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Organization;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MembershipmanagerController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id //membership id
     * @return Response
     */
    public function approval(Request $request, $id)
    {
        $membership = Membership::find($id);

        $organization = Organization::find($membership->organization_id);
        $person = Person::find($membership->user_id);

        foreach($organization->ancestors([], true) AS $org) {
            $m = Membership::where('user_id', $membership->user_id)
                ->where('organization_id', $org->id)
                ->first();
            $m->membershiptype_id = $membership->requestedtype_id;
            $m->save();
        }

        return '<div style="text-align: center;"><h2>Thank you!<br />Your '
            .$organization->name
            .' membership updates for '
            .$person->fullName
            .' have been saved.</h2></div>';
    }

 }
