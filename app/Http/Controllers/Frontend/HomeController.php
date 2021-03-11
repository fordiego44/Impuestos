<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//use App\Http\Controllers\FrontEnd\DB;

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

        $business = DB::table('bussines')->get();

        $users = User::with(['categories'])->get(); 
        return view('backend.dashboard')->with(compact('business', 'users'));

    }

}
