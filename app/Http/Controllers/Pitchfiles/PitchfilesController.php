<?php

namespace App\Http\Controllers\Pitchfiles;

use App\Http\Controllers\Controller;
use App\Models\Eventversion;
use App\Models\Userconfig;
use Illuminate\Http\Request;

class PitchfilesController extends Controller
{
    public function index()
    {
        return view('pitchfiles.index');
    }
}
