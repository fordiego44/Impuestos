<?php

namespace App\Http\Controllers;

use App\Deliv;
use App\User;
use App\Protocolo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Deliverier;
use App\Gallery;



class AdministratorsController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $guard = 'deliv';
    //protected $table = 'users';

    function __construct(){
            $this->middleware('auth:deliv',['only' => ['secret']]);
    }

   public function authenticated(Request $request){

        $credentials = $request->only('email', 'password');

        $email = $request->email;
        $password = $request->password;

        if (Auth::guard('deliv')->middleware('auth')->attempt(['user_name' => $email, 'password' => $password])) {
            return redirect('/admin/area');
            // return redirect('/admin/recepciones/proceso');
        }
        else{
            //return 'Fallido';
            $message1 = 'El usuario o contraseña son incorrectos';
            return redirect('/login')->with(compact('message1'));
        }



    }
    public function secret(){

        //return 'Hola' . auth('deliv')->user()->user_name;
        //return redirect('/admin/recepciones/proceso');
        /*$deliv=auth('deliv')->user()->id;
        // -----------------------------------------
        $delivery =  DB::SELECT("SELECT  * FROM deliveriers
                                WHERE id_user = $id_user");

        // ---------------------------------
        $nproceso = count(DB::SELECT("SELECT  pending  FROM receptions
                                WHERE state = 1 and id_user = $id_user"));
        $nrealizado = count(DB::SELECT("SELECT  pending  FROM receptions
                                WHERE state = 2 and id_user = $id_user"));
        $nanulado = count(DB::SELECT("SELECT  pending  FROM receptions
                                WHERE state = 3 and id_user = $id_user"));*/
        $id=auth()->user()->state;
        return view('backend.admin-deliv.index')->with(compact('id'));


    }

    public function logout(){


        Auth::guard('deliv')->logout();
        return redirect('/login');

    }

    public function reporte($id,$date){
                                                  // return $date;
                                                    // $date = '2020-05-21 20:04:01';
                                                    // $date= $date->format('Y-m-d');

                                                   // return   $date->format('Y');
                                                 // return   $date->format('m');
                                                   // return   $date->format('d');
        $date = \Carbon\Carbon::parse($date);

        $data['data'] = Protocolo::whereYear('date_reception', $date->format('Y'))->whereMonth('date_reception', $date->format('m'))->whereDay('date_reception', $date->format('d'))->where('deliverier_id',$id)->first();
        $data['names'] =  Deliverier::select('id_user','name','last_name')->where('id','=',$id)->get();
        $data['fecha'] = $date;
        $data['empresa'] = DB::table('users')
                            ->join('deliveriers','users.id','=','deliveriers.id_user')
                            ->select('users.company','users.ruc')
                            ->where('deliveriers.id','=',$id)
                            ->get();
        $mpdf = new \Mpdf\Mpdf([
        // $mpdf = new \Mpdf([
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 48,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 10
          ]);

                $mpdf->SetProtection(array('print'));
                $mpdf->SetTitle("Declaracion de Protocolo de Salubridad");
                $mpdf->SetAuthor("Delivery.com");
                //$mpdf->SetWatermarkText("LAS BRASAS");
                $mpdf->showWatermarkText = true;
                $mpdf->watermark_font = 'DejaVuSansCondensed';
                $mpdf->watermarkTextAlpha = 0.1;
                $mpdf->SetDisplayMode('fullpage');
                $html = view ('backend.reports.report',$data)->render();
                //$html = view ('backend.reports.report')->render();
                $mpdf->WriteHTML($html);
                $mpdf->Output();
    }

    public function reporteCompra($id,$bussiness){

          $id_user = session('costumer')->id;

            $data['reception'] = DB::SELECT("SELECT c.direction,c.name as cname,c.last_name as clast_name,u.company,u.address,u.phone,u.ruc,u.email,rd.total,r.pending,d.name, rd.quantity, r.coupon, r.date_reception,r.deliverier_id, r.id_user,
              at.name as at_name,  va.name as va_name
              FROM receptions r
              INNER JOIN reception_details rd on rd.order_detail = r.pending
              INNER JOIN products d on d.id = rd.dish_id
              LEFT JOIN attributes at on at.id = rd.id_attribute
              LEFT JOIN variations va on va.id = rd.id_variation
              INNER JOIN costumers c on c.id=r.customer_id
              -- // INNER JOIN deliveriers de on de.id=r.deliverier_id
              INNER JOIN users u on u.id=r.id_user
              WHERE r.customer_id = $id_user and r.id_user = $bussiness and r.pending=$id and rd.id_user_detail=$bussiness");
              // return $data;

// require_once __DIR__ . '/vendor/autoload.php';
// $mpdf = new \Mpdf\Mpdf();
// $mpdf->WriteHTML('<h1>Hello world!</h1>');
// $mpdf->Output();
        // return $data;
        $mpdf = new \Mpdf\Mpdf([
          'margin_left' => 20,
          'margin_right' => 15,
          'margin_top' => 48,
          'margin_bottom' => 25,
          'margin_header' => 10,
          'margin_footer' => 10
        ]);

        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Facturación Electronica");
        $mpdf->SetAuthor("Delivery.com");
        //$mpdf->SetWatermarkText("LAS BRASAS");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $html = view ('backend.reports.ticket',$data)->render();
        //$html = view ('backend.reports.report')->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function ticket(){
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 48,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 10
          ]);

                $mpdf->SetProtection(array('print'));
                $mpdf->SetTitle("Facturación Electronica");
                $mpdf->SetAuthor("Delivery.com");
                //$mpdf->SetWatermarkText("LAS BRASAS");
                $mpdf->showWatermarkText = true;
                $mpdf->watermark_font = 'DejaVuSansCondensed';
                $mpdf->watermarkTextAlpha = 0.1;
                $mpdf->SetDisplayMode('fullpage');
                $html = view ('backend.reports.ticket')->render();
                //$html = view ('backend.reports.report')->render();
                $mpdf->WriteHTML($html);
                $mpdf->Output();

    }

}
