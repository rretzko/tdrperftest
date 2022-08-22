<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Membershiptype;
use App\Models\Organization;
use App\Models\Userconfig;
use App\Traits\MembershipcardUrlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembershipcardController extends Controller
{
    use MembershipcardUrlTrait;

    public function create(Request $request)
    {
        $data = $this->validateRequest($request);

        Membership::create([
            'user_id' => auth()->id(),
            'organization_id' => Userconfig::getValue('organization',auth()->id()),
            'membershiptype_id' => $data['membershiptype_id'],
            'membership_id' => $data['membership_id'],
            'expiration' => $data['expiration'],
            'grade_levels' => $data['grade_levels'],
            'subjects' => $data['subjects'],
            'membership_card_path' => '',//$path,
            'membership_card_url' => '',
        ]);

        return back();

    }

    public function show(Organization $organization)
    {
        Userconfig::setValue('organization', auth()->id(), $organization->id);

        $membership_card_url = '';

        $membership = Membership::where('user_id', auth()->id())
            ->where('organization_id', $organization->id)
            ->first() ?? new Membership;

        $membership_card_url = $this->membershipcardurl($membership);

        return view('organizations.membershipcard.show',
        [
            'ancestors' => $this->buildAncestors($organization->ancestors()),
            'membership' => $membership,
            'membershiptypes' => Membershiptype::all(),
            'membership_card_url' => $membership_card_url,
            'organization' => $organization,
        ]);
    }

    public function update(Request $request, Membership $membership)
    {
        $data = $this->validateRequest($request);

        $path = '';

        $membership_card_path = '';
        if($request->hasFile('membershipcard')) {

            if(in_array($request->membershipcard->guessExtension(), ['jpg','jpeg','png'])) {

                $file = $request->file('membershipcard');
                $hashname = $file->hashName();
                $directory = 'membershipcards/';
                $path = $directory.$hashname;

                $file->storePublicly($path,'spaces');

                foreach(Organization::find(Userconfig::getValue('organization',auth()->id()))
                            ->ancestors([],true) AS $organization) {

                    Membership::where('user_id', auth()->id())
                        ->where('organization_id', $organization->id)
                        ->update([
                            'membershiptype_id' => $data['membershiptype_id'],
                            'membership_id' => $data['membership_id'],
                            'expiration' => $data['expiration'],
                            'grade_levels' => $data['grade_levels'],
                            'subjects' => $data['subjects'],
                            'membership_card_path' => $path,
                        ]);
                }
            }
        }else{
            $membership->update([
                    'membershiptype_id' => $data['membershiptype_id'],
                    'membership_id' => $data['membership_id'],
                    'expiration' => $data['expiration'],
                    'grade_levels' => $data['grade_levels'],
                    'subjects' => $data['subjects'],
                    'membership_card_path' => $path,
                ]);
        }

        return back();
    }

    private function buildAncestors($ancestors)
    {
        //early exit
        if(! count($ancestors)){ return '';}

        $str = '<ul class="list-disc ml-8">';

        foreach($ancestors AS $ancestor){

            $str .= '<li>'.$ancestor->name.'</li>';
        }

        $str .= '</ul>';

        return $str;
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'membershiptype_id' => ['required','numeric'],
            'membership_id' => ['nullable','string'],
            'expiration' => ['nullable','date'],
            'grade_levels' => ['nullable','string'],
            'subjects' => ['nullable','string'],
        ]);
    }
}
