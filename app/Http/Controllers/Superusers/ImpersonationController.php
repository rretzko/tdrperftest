<?php

namespace App\Http\Controllers\Superusers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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

        auth()->login($request['user_id']);

        return view('dashboard', [
            'teachers' => Teacher::with('person')->get()->sortBy('person.last'),
        ]);
    }

}
