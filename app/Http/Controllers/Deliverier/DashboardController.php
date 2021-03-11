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

    public function upProtocolo(Request $request){

      $now = new \DateTime();
        // echo ;
        //  $now= Carbon::now()->toTimeString();
        // return $now->format('d-m-Y H:i:s');



              $protocolo = new Protocolo;
// session('deliverier')->name
              $protocolo->deliverier_id =  session('user')->id;
              $protocolo->quest1 = $request->quest1;
              $protocolo->quest2 = $request->quest2;
              $protocolo->quest3 = $request->quest3;
              $protocolo->quest4 = $request->quest4;
              $protocolo->quest5 = $request->quest5;
              $protocolo->quest6 = $request->quest6;
              $protocolo->quest7 = $request->quest7;
              $protocolo->quest8 = $request->quest8;
              $protocolo->quest9 = $request->quest9;
              $protocolo->quest10 = $request->quest10;
              $protocolo->quest11 = $request->quest11;
              $protocolo->quest12 = $request->quest12;
              $protocolo->quest13 = $request->quest13;
              $protocolo->quest14 = $request->quest14;
              $protocolo->quest15 = $request->quest15;
              $protocolo->quest16 = $request->quest16;
              $protocolo->quest17 = $request->quest17;
              $protocolo->quest18 = $request->quest18;
              $protocolo->date_reception = $now  ;

              $protocolo->save();

              return redirect('/admin/recepciones/proceso');
    }


}
