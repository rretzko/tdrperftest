<?php

namespace App\Http\Controllers\Studios;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudioController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @param Request $request
     * @return View
     */
    public function show(Request $request, Studio $studio)
    {
        return view('studios.show', [
            'request' => $request,
            'studio' => $studio,
            'user' => $request->user(),
        ]);
    }
}
