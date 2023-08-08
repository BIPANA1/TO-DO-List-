<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class TaskController extends Controller
{
    public function logout(Request $request)
    {
        FacadesSession::flush();
        Auth::logout();
        return redirect('/');

    }
}
