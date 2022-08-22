<?php

namespace App\Http\Livewire\Organizations;

use App\Events\MembershipRequestEvent;
use App\Models\Membership;
use App\Models\Membershiptype;
use App\Models\Organization;
use App\Models\Person;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Organizationcomponent extends Component
{
    //common contract properties for pages
    public $allowimports = true; //allow user to import ensemble members
    public $confirmingdelete = 0;
    public $membershipmanagers = [];
    public $perpage = 0; //pagination
    public $population = 0; //ALL members count
    public $search = '';
    public $selectall = false;
    public $selected = [];
    public $selectpage = 0;
    public $showaddmodal = false;
    public $showDeleteModal = false;
    public $showeditmodal = false;
    public $showfileuploadmodal = false;
    public $showfilters = false;
    public $sortdirection = 'asc';
    public $sortfield = '';

    //organization-specific properties
    public $editorganization = null;
    public $editorganizationexpiration = '';
    public $editorganizationgradelevels = '';
    public $editorganizationsubjects = '';
    public $editorganizationmembershipid = '';
    public $editorganizationmembershiptype_id = 1;
    public $emailsent = '';
    public $membershiptypes = [];
    public $organizations = [];

    public function mount()
    {
        $organization = new Organization;
        $this->organizations = $organization->parents();
        $this->membershipmanagers = $this->membershipManagers();
        $this->membershiptypes = Membershiptype::orderBy('descr')->get();
    }

    public function render()
    {
        return view('livewire.organizations.organizationcomponent');
    }

    public function requestMembership($organization_id)
    {
        $this->showeditmodal = true;
        $this->editorganization = Organization::find($organization_id);

        /*$this->emailsent = '';
        $organization = Organization::find($organization_id);
        $membershipmanagers = $organization->membershipmanagers(); //person objects
        $person = Person::find(auth()->id());
        $pending = Membershiptype::PENDING;

        //add pending status to memberships
        foreach($organization->ancestors([],true) AS $ancestor){
/* *** UNCOMMENT THIS AFTER TESTING EMAIL FUNCTIONALITIES
            Membership::updateOrcreate([
               'user_id' => auth()->id(),
               'organization_id' => $ancestor->id,
               'membershiptype_id' => $pending,
            ]);

        }

        event(new MembershipRequestEvent($organization, Person::find(auth()->id())));

        $this->emailsent = 'Your request for membership to '.$organization->name.' has been sent to '
            .$organization->membershipmanagers()->first()->fullName.' for approval.';
*/
    }

    public function saveMembership()
    {
        foreach($this->editorganization->ancestors([],true) AS $organization) {

            $m = Membership::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'organization_id' => $organization->id,
                ],
                [
                    'membership_id' => $this->editorganizationmembershipid,
                    'membershiptype_id' => 11, //pending until approved by membership manager
                    'requestedtype_id' => $this->editorganizationmembershiptype_id,
                    'expiration' => $this->editorganizationexpiration,
                    'grade_levels' => $this->editorganizationgradelevels,
                    'subjects' => $this->editorganizationsubjects,
                ],
            );

        }

        $this->emit('membership-saved');
    }

    public function sendMembershipRequest()
    {
        event(new MembershipRequestEvent($this->editorganization, Person::find(auth()->id())));

        $this->emailsent = 'Your request for membership to '.$this->editorganization->name.' has been sent to '
            .$this->editorganization->membershipmanagers()->first()->fullName.' for approval.';

        $this->showeditmodal = false;
    }

    private function membershipmanagers()
    {
        $a = [];
        $emails = [];

        foreach($this->organizations AS $organization){

            //includes the parent branch
            foreach($organization->decendentsTree() AS $branch) {

                if ($branch->hasMembershipmanagers) {

                    $str = '';

                    foreach($organization->membershipmanagers() AS $person){

                        foreach($person->subscriberEmails AS $email){

                            $emails[] = $email->email;
                        }

                        $str .= $person->fullName.' ('.implode(',',$emails).')';

                    }

                    $a[$branch->id] = $str;


                } else {

                    $a[$branch->id] = 'No membership manager found.';
                }
            }
        }

        return $a;
    }
}
