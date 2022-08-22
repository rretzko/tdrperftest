<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\fs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    /**
     * Show the user profile screen.
     *
     * @param Request $request
     * @return View
     */
    public function show(Request $request)
    {
        return view('students.show', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

}
