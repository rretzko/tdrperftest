<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\fs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentTabbedController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @param Request $request
     * @return View
     */
    public function show(Request $request)
    {
        return view('students.showtabbed', [
            'request' => $request,
        ]);
    }

}
