<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        abort(403);
        return view('home');
    }
    public function users(Request $request)
    {
        
        return view('users.index');
    }
    public function edit(Request $request, $id)
    {
        
        return view('users.edit');
    }
}
