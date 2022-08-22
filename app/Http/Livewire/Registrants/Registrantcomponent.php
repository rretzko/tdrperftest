<?php

namespace App\Http\Livewire\Registrants;

use App\Helpers\CollectionHelper;
use App\Models\Eventversion;
use App\Models\Registrant;
use App\Models\Userconfig;
use App\Models\Utility\Registrants;
use App\Models\Utility\Schoolregistrationstatus;
use Carbon\Carbon;
use Livewire\WithPagination;
use Livewire\Component;

class Registrantcomponent extends Component
{
    use WithPagination;

    //common contract properties for pages
    public $xadjudicator=false;
    public $allowimports = true; //allow user to import ensemble members
    public $confirmingdelete = 0;
    public $exception = false;
    public $membershipmanagers = [];
    public $perpage = 0; //pagination
    public $population = ''; //ALL members count
    public $schoolcurrent=0;
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

    //registrants-specific properties
    public $event = null; //shorthand for eventversion
    public $events = [];
    public $signatures = [];
    public $registrantstatus = "Click the student's status (Eligible, Applied, Registered) to display their
        status details here...";

    private $populations = ['eligible','applied','registered',];

    public function mount()
    {
        $this->schoolcurrent = Userconfig::getValue('school',auth()->id());
        $this->event = Eventversion::find(Userconfig::getValue('eventversion', auth()->id()));
        $this->perpage = Userconfig::getValue('pagination', auth()->id());
        $this->population = Userconfig::getValue('registrantpopulation', auth()->id());
    }

    public function render()
    {
        return view('livewire.registrants.registrantcomponent',[
            'adjudicator' => $this->setAdjudicatorState(),
            'registrants' => $this->registrants(),
            'schoolregistrationstatus' => Schoolregistrationstatus::horizontalBarChart(),
            'schools' => $this->schools(),
        ]);
    }

    public function changeSchool($value)
    {
        Userconfig::setValue('school', auth()->id(), $value);
        $this->schoolcurrent = $value;
    }

    public function registrantstatus(Registrant $registrant)
    {
            $str = '<div class="bg-white text-blue-800 p-2 rounded shadow">';

            $str .= '<div class="uppercase font-bold text-red-700">'.$registrant->student->person->fullName.'</div>';

            $str .= '<div class="flex">
                        <div class="w-5/12">Status:</div>
                        <div class="w-7/12 font-bold">'.ucwords($registrant->registranttypeDescr).'</div>
                    </div>';

            $str .= '<div class="flex">
                        <div class="w-5/12">Application: </div>
                        <div class="w-7/12 font-bold">'.(($registrant->hasApplication) ? 'Downloaded' : 'None').'</div>
                        </div>';

            $str .= '<div class="flex">
                        <div class="w-5/12">Signatures: </div>
                        <div class="w-7/12 font-bold">'.(($registrant->hasSignatures) ? 'Signed' : 'Pending').'</div>
                        </div>';

            $fileuploadscount = $registrant->fileuploads()->count();
            $str .= '<div class="flex">
                        <div class="w-5/12">Files Uploaded: </div>
                        <div class="w-7/12">
                            <span class="font-bold">'.$fileuploadscount.'</span> ';
                if($fileuploadscount){
                    $str.= '('.$registrant->filesUploadedDescrCSV.')';
                }
            $str .= '</div>
            </div>';

            $filesapprovedcount = ($registrant->filesApprovedCount);
            $str .= '<div class="flex">
                        <div class="w-5/12">Files Approved: </div>
                        <div class="w-7/12"><span class="font-bold">'.$filesapprovedcount.'</span> ';
                if($filesapprovedcount) {
                    $str .= '(' . $registrant->filesApprovedDescrCSV . ')';
                }
            $str .= '</div>
            </div>';

            $str .= '<div class="flex">
                        <div class="w-5/12">Registrantion Fee: </div>
                        <div class="w-7/12 font-bold">$'.$this->event->eventversionconfigs->registrationfee.'</div>
                        </div>';
            $str .= '<div class="flex">
                        <div class="w-5/12">Paid: </div>
                        <div class="w-7/12 font-bold">$'.$registrant->paid().'</div>
                        </div>';
            $str .= '<div class="flex">
                        <div class="w-5/12">Due: </div>
                        <div class="w-7/12 font-bold">$'.$registrant->due().'</div>
                        </div>';

            $str .= '</div>';

            $this->registrantstatus = $str;
    }

    public function status()
    {
        $populations = [
            'eligible' => 'applied',
            'applied' => 'registered',
            'registered' => 'eligible',
            //'hidden' => 'eligible',
        ];

        $this->population = $populations[$this->population];

        Userconfig::setValue('registrantpopulation', auth()->id(), $this->population);
    }

    public function updatedPerpage()
    {
        Userconfig::setValue('pagination', auth()->id(), $this->perpage);
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private function registrants()
    {
        if($this->population === 'applied') {

            $this->populationregistrants = Registrants::applied($this->search);

        }elseif($this->population === 'registered'){

            $this->populationregistrants = Registrants::registered($this->search);

        }else{

            $this->populationregistrants = Registrants::eligible($this->search);
        }

        //paginate identified students
        return CollectionHelper::paginate($this->populationregistrants, Userconfig::getValue('pagination', auth()->id()));

    }

    private function setAdjudicatorState()
    {
        $eventversion = Eventversion::find(Userconfig::getValue('eventversion', auth()->id()));

        $dt_open = $eventversion->eventversiondates->where('datetype_id', \App\Models\Datetype::SCORE_OPEN)->first()->dt;
        $dt_close = $eventversion->eventversiondates->where('datetype_id', \App\Models\Datetype::SCORE_CLOSE)->first()->dt;

        if((Carbon::now() > $dt_open) && (Carbon::now() < $dt_close)) {

            return \App\Models\Adjudicator::where('user_id', auth()->id())
                ->where('eventversion_id', Userconfig::getValue('eventversion', auth()->id()))
                ->first();
        }elseif(auth()->id() === 368){//domain owner

            return \App\Models\Adjudicator::where('user_id', auth()->id())
                ->where('eventversion_id', Userconfig::getValue('eventversion', auth()->id()))
                ->first();
        }else{

            return false;
        }
    }

    private function schools()
    {
        return (auth()->user()->schools) ?: collect();
    }

}
