<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Auth\RequestGuard;
use Illuminate\Http\Response;

//maintaining for troubleshooting documentation

class ImpersonationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'numeric','exists:users,id'],
        ]);

        session()->put('superuser', auth()->id());

        //auth()->loginUsingId($request['user_id']);

        return view('dashboard', [
            'teachers' => Teacher::with('person')->get()->sortBy('person.last'),
        ]);
    }

}
