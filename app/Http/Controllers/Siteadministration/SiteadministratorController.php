<?php

namespace App\Http\Controllers\Siteadministration;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SiteadministratorController extends Controller
{
    public function index()
    {
        return view('siteadministrator.index');
    }
}
