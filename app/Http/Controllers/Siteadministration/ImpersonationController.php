<?php

namespace App\Http\Controllers\Siteadministration;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    public function index($user_id)
    {
        Auth::loginUsingId($user_id);

        return redirect()->intended('dashboard');
    }

    public function destroy()
    {
        session()->forget('impersonate');

        return redirect('dashboard');
    }
}
