<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Classification;
use App\Restaurant;
use App\Costumer;
use App\Product;
use App\User;

use App\ValidatorCustom;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

class DeliveryController extends Controller
{

    public function __construct() {
        $this->oValidator = new ValidatorCustom();
    }
    public function index(Request $request) {
        return view('index' );

    } 
    public function logout(Request $request) {
        $request->session()->forget('costumer');
        $request->session()->flush();
        return redirect('/');
    }
    public function redirectTo(Request $request) {
        $slug = User::where('id', $request->company_id)->first();
        return $slug;
    }

}
