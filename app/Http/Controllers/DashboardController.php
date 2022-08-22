<?php

namespace App\Http\Controllers;

use App\Models\Userconfig;
use App\Models\Utility\Dashboard;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request)
    {
        $teachers = collect();
        if(auth()->id() === 368) {
            $teachers = Teacher::with('person')->get()->sortBy('person.last');
        }

        $dashboard = new Dashboard;

        return view('dashboard',[
            'dashboard' => $dashboard,
            'teachers' => $teachers,
            'gettingstarted' => Userconfig::getValue('gettingstarted', auth()->id()),
        ]);
    }

    /**
     * This function is only used to update the Userconfig::gettingstarted property
     */
    public function update(Request $request)
    {
        Userconfig::setValue('gettingstarted', auth()->id(), 0);

        return $this->show($request);
    }
}
