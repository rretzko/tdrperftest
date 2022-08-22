<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SproutVideo;
use SproutVideo\UploadToken;

/**
 * Generic but original design is for SproutVideo
 */
class Fileserver extends Model
{
    public $registrant;
    public $videotype;

    public function __construct(Registrant $registrant){

        parent::__construct();

        SproutVideo::$api_key = config('app.sprout');
        $this->registrant = $registrant;
        $this->filecontenttype = new Filecontenttype;
    }

    public function api_Key()
    {
        return config('app.sprout');
    }

    public function assets($server_id)
    {
        $assets = SproutVideo\Video::get_video($server_id);

        return $assets;
    }

    public function buildFilename(Registrant $registrant): string
    {
        $filename = $registrant->student->person->last;
        $filename .= substr($registrant->student->person->first,0,5).'_';
        $filename .= str_replace(',','_',$registrant->InstrumentationsCSV.'_');

        return $filename;
    }

    public function set_Registrant(Registrant $registrant)
    {
        $this->registrant = $registrant;
    }

    public function set_Filecontenttype(Filecontenttype $filecontenttype)
    {
        $this->filecontenttype = $filecontenttype;
    }

    /**
     * create video token or log error message
     *
     * @return string
     */
    public function token(Filecontenttype $filecontenttype) : string
    {
        $folder_id = Fileuploadfolder::where('eventversion_id', Userconfig::getValue('eventversion', auth()->id()))
            ->where('filecontenttype_id', $filecontenttype->id)
            ->where('instrumentation_id', $this->registrant->instrumentations->first()->id)
            ->first()
            ->folder_id;

        //https://thedirectorsroom.com/fileserver/confirmation/651234/99/98/97
        $token = UploadToken::create_upload_token([
            'return_url' => 'https://thedirectorsroom.com/fileserver/confirmation/'
                . $this->registrant->id.'/'.$filecontenttype->id.'/'.auth()->id().'/'.$folder_id
        ]);

        if(array_key_exists('token', $token)){

            return $token['token'];

        }else{

            error_log('FJR:'.date('Y-m-d G:i:s').': SproutVideo token error: '.serialize($token));

            return '***00000***';
        }

    }

    /** END OF PUBLIC FUNCTIONS ***************************************************/


}
