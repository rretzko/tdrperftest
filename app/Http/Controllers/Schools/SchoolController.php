<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Models\fs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SchoolController extends Controller
{
    /**
     * Display all Schools for auth()->user()
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        return view('schools.index', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

}
