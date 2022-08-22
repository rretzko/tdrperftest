<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileviewportInternal extends Model
{
    protected $filecontenttype;
    protected $registrant;

    public function __construct(\App\Models\Registrant $registrant, \App\Models\Filecontenttype $filecontenttype)
    {
        $this->filecontenttype = $filecontenttype;
        $this->registrant = $registrant;
        $this->viewport = 'No file found';

        $this->init();
    }

    public function viewport()
    {
        return $this->viewport;
    }

    /** END OF PUBLIC FUNCTIONS **************************************************/

    private function init()
    {
        //file exists
        if(\App\Models\Fileupload::where('registrant_id', $this->registrant->id)
            ->where('filecontenttype_id', $this->filecontenttype->id)
            ->exists()){

            $fileupload = \App\Models\Fileupload::where('registrant_id', $this->registrant->id)
                ->where('filecontenttype_id', $this->filecontenttype->id)
                ->first();

            $ext = substr($fileupload->folder_id,-3);

            if($ext === 'mp3'){

                $this->viewport = $this->mp3player($fileupload);
            }
        }
    }

    private function mp3player(\App\Models\Fileupload $fileupload)
    {
        $src = Storage::disk('spaces')->url($fileupload->server_id.$fileupload->folder_id.'/'.$fileupload->folder_id);

        $str = '<audio controls>';
            $str .= '<source src="'.$src.'" type="audio/mpeg">';
            $str .= 'Your browser does not support the audio element';
        $str .= '</audio>';

        return $str;
    }
}
