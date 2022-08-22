<?php

namespace App\Http\Controllers\Registrants;

use App\Http\Controllers\Controller;
use App\Models\Userconfig;
use Illuminate\Http\Request;
use function PHPUnit\Framework\directoryExists;

class MediauploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registrant $registrant
     * @param  \App\Models\Filecontenttype $filecontenttype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\Registrant $registrant, \App\Models\Filecontenttype $filecontenttype)
    {
        if($request->hasFile($filecontenttype->descr)) {

            if($request->{$filecontenttype->descr}->guessExtension() === 'mp3'){

                $file = $request->file($filecontenttype->descr);
                $hashname = $file->hashName();
                $directory = 'auditions/'
                    . Userconfig::getValue('event', auth()->id()).'/'
                    . Userconfig::getValue('eventversion', auth()->id()).'/'
                    . $registrant->instrumentations->first()->abbr.'/'
                    . $filecontenttype->descr.'/';
                $path = $directory.$hashname;

                $file->storePublicly($path, 'spaces');

                \App\Models\Fileupload::updateOrCreate(
                    [
                        'registrant_id' => $registrant->id,
                        'filecontenttype_id' => $filecontenttype->id,
                    ],
                    [
                        'server_id' => $directory,
                        'folder_id' => $hashname, //remove 'public/'
                        'uploaded_by' => auth()->id(),
                    ]
                );
            }

            return back();
        }else{

            echo 'Error: File type: "'.$filecontenttype->descr.'" not found, OR <br />';
            echo 'If your file size is greater than 2MB, please send the file with the student name to rick@mfrholdings.com for upload.<br />';
        }

        echo '*** ERROR ***';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function makeDirectories(\App\Models\Registrant $registrant, \App\Models\Filecontenttype $filecontenttype)
    {
        $event = Userconfig::getValue('event', auth()->id());
        $eventversion = Userconfig::getValue('eventversion', auth()->id());
        $instrumentation_id = $registrant->instrumentations->first()->id;

        if(is_dir('../public')){

            if(is_dir('../public/assets')){

                if(is_dir('../public/assets/mp3s')){

                    if(is_dir('../public/assets/mp3s/'.Userconfig::getValue('event', auth()->id()))){

                        if(is_dir('../public/assets/mp3s/'.Userconfig::getValue('event', auth()->id()).'/'.Userconfig::getValue('eventversion', auth()->id()))){

                            if(is_dir('../public/assets/'.Userconfig::getValue('event', auth()->id()).'/'.Userconfig::getValue('eventversion', auth()->id()).'/'.$registrant->instrumentations->first()->id)){

                                return '../public/assets/'.$event;

                            }else {
                                mkdir('../public/assets/mp3s/' . Userconfig::getValue('event', auth()->id()) . '/' . Userconfig::getValue('eventversion', auth()->id()).'/'.$registrant->instrumentations->first()->id);

                                $this->makeDirectories($registrant, $filecontenttype);
                            }
                        }else{

                            mkdir('../public/assets/mp3s/'.Userconfig::getValue('event', auth()->id()).'/'.Userconfig::getValue('eventversion', auth()->id()));

                            $this->makeDirectories($registrant, $filecontenttype);
                        }

                    }else{

                        mkdir('../public/assets/mp3s/'.Userconfig::getValue('event', auth()->id()));

                        $this->makeDirectories($registrant, $filecontenttype);
                    }

                }else{

                        mkdir('../public/assets/mp3s');

                        $this->makeDirectories($registrant, $filecontenttype);
                }
            }else{

                mkdir('../public/assets');

                $this->makeDirectories($registrant, $filecontenttype);
            }

        }else{

            mkdir('../public');

            $this->makeDirectories($registrant, $filecontenttype);
        }

        /*
         * 'public/assets/mp3s/'
                    . Userconfig::getValue('event', auth()->id()).'/'
                    . Userconfig::getValue('eventversion', auth()->id()).'/'
                    . $registrant->instrumentations->first()->id.'/'
                    . $filecontenttype->id;
         */

        return false;
    }
}
