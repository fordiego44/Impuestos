<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Protocolo;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index(){

      // \Session::forget('rol');
        if (isset ( session('deliverier')->id)) { //exite
              if (! \Session::get('rol')) {
                \Session::push('rol','repartidor');
              }

           // return session('deliverier')->name;
        }else { //no existe
          if (! \Session::get('rol')) {
            \Session::push('rol','administrador');
          }
          // return session('user')->name;
        }

        // return view('backend.dashboard');
        return redirect('/admin/platos');
    }


}
