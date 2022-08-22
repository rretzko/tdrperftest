<?php

namespace App\Http\Controllers\Registrants;

use App\Events\FileuploadRejectionEvent;
use App\Http\Controllers\Controller;
use App\Models\Eventversion;
use App\Models\Filecontenttype;
use App\Models\Fileupload;
use App\Models\Registrant;
use App\Models\Userconfig;
use App\Traits\UpdateRegistrantStatusTrait;
use Carbon\Carbon;

class FileapprovalController extends Controller
{
    use UpdateRegistrantStatusTrait;

    public function approve(Registrant $registrant, Filecontenttype $filecontenttype)
    {
        Fileupload::where('registrant_id', $registrant->id)
            ->where('filecontenttype_id', $filecontenttype->id)
            ->update([
                'approved' => Carbon::now(),
                'approved_by' => auth()->id()
            ]);

        $this->updateRegistrantStatus($registrant);

        return back();
    }

    public function reject(Registrant $registrant, Filecontenttype $filecontenttype)
    {
        $fileupload = Fileupload::where('registrant_id', $registrant->id)
            ->where('filecontenttype_id', $filecontenttype->id)
            ->first();

        $fileupload->delete();
  
        $this->updateRegistrantStatus($registrant);

        event(new FileuploadRejectionEvent(
            Eventversion::find(Userconfig::getValue('eventversion', auth()->id())),
            $filecontenttype,
            $registrant ));

        return back();
    }
}
