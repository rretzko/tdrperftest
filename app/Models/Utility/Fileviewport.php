<?php

namespace App\Models\Utility;

use App\Models\Filecontenttype;
use App\Models\Fileserver;
use App\Models\Fileupload;
use App\Models\Registrant;
use App\Models\Videoserver;
use Illuminate\Database\Eloquent\Model;

class Fileviewport extends Model
{
    protected $filecontenttype;
    protected $registrant;
    protected $viewport;

    public function __construct(Registrant $registrant, Filecontenttype $filecontenttype)
    {
        $this->filecontenttype = $filecontenttype;
        $this->registrant = $registrant;
        $this->viewport = '';

        $this->init();
    }

    public function viewport()
    {
        return $this->viewport;
    }
/** END OF PUBLIC FUNCTIONS **************************************************/

    /**
     * Return $embedcode with height and width properties removed
     *
     * @param $embedcode
     * @return string
     */
    private function embedCodeEdits($embedcode)
    {
        $parsedcode = '';
        $parts = explode(' ', $embedcode);

        foreach ($parts as $part) {
            if (! (strstr($part, 'width') || strstr($part, 'height'))) {
                $parsedcode .= $part . ' ';
            }
        }

        return $parsedcode;
    }
    private function init()
    {
        //early exit for backwards compatibility
        if($this->registrant->id > 709999){ //2022 NJ All-State

            $fileviewport = new \App\Models\Utility\FileviewportInternal($this->registrant, $this->filecontenttype);

            $this->viewport = $fileviewport->viewport;
        }else {

            $server_id = Fileupload::where('registrant_id', $this->registrant->id)
                ->where('filecontenttype_id', $this->filecontenttype->id)
                ->value('server_id');

            $assets = $this->getSproutvideoAssets($server_id);

            $this->viewport = $this->embedCodeEdits($assets['embed_code']);
        }
    }

    private function getSproutvideoAssets($server_id)
    {
        $fileserver = new Fileserver($this->registrant);

        $assets = [];

        //in case of server delay, keep pinging $vs until response is received
        while (! array_key_exists('id', $assets)) {

            $assets = $fileserver->assets($server_id);
        }

        return $assets;
    }
}
