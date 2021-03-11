<?php

namespace App\Http\Controllers\Deliverier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class MyReceptionController extends Controller
{
  public function index($recepcion)
  {
      $id_user=session('deliverier')->id;
      // -----------------------------------------
      // $delivery =  DB::SELECT("SELECT  * FROM deliveriers
      //                         WHERE id_user = $id_user and state_delete = 0 ");

      // ---------------------------------
      $nproceso = count(DB::SELECT("SELECT  pending  FROM receptions
                              WHERE state = 1 and 	deliverier_id = $id_user"));
      $nrealizado = count(DB::SELECT("SELECT  pending  FROM receptions
                              WHERE state = 2 and 	deliverier_id = $id_user"));
      $nanulado = count(DB::SELECT("SELECT  pending  FROM receptions
                              WHERE state = 3 and 	deliverier_id = $id_user"));

// \Session::forget('valor2');
          if (! \Session::get('valor2')) {
            $task2 = (object)array(
              'proceso'=>$nproceso,
              'realizado'=>$nrealizado,
              'anulado'=>$nanulado
            );
            \Session::push('valor2',$task2);
          }else {
            $task3 = \Session::get('valor2');
            // dd($task3);
            $task3[0]->proceso = $nproceso;
            $task3[0]->realizado = $nrealizado;
            $task3[0]->anulado = $nanulado;
            \Session::put('valor2',$task3);
          }

            if ($recepcion == 'proceso') {
            // ----------------------------------------------

                  $recepciones = DB::SELECT("SELECT  id_user,pending  FROM receptions
                                             WHERE state = 1 and 	deliverier_id = $id_user");
                 $i=1;
                 if ($recepciones == null) {
                   $reception=[];
                 }
                 foreach ($recepciones as $recepcion) {
                   $reception[$i] = DB::SELECT("SELECT c.name as nombre  ,rd.total,c.email,r.pending, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name
                                          FROM receptions r
                                           INNER JOIN reception_details rd on rd.order_detail = r.pending
                                           INNER JOIN products d on d.id = rd.dish_id
                                           INNER JOIN costumers c on c.id=r.customer_id
                                           LEFT JOIN attributes at on at.id = rd.id_attribute
                                           LEFT JOIN variations va on va.id = rd.id_variation
                                           WHERE r.pending = $recepcion->pending and r.id_user = $recepcion->id_user and rd.id_user_detail=$recepcion->id_user");
                    $i = $i + 1 ;
                 }
                  // return $reception;
                 // ->with(compact('valor2'))
                 return view('backend.reception.indexProcess')->with(compact('reception'));
            // --------------------------------------------------------
      } else {
        if ($recepcion == 'realizado') {
          // ----------------------------------------------
              $recepciones = DB::SELECT("SELECT  id_user,pending  FROM receptions
                                         WHERE state = 2 and 	deliverier_id = $id_user");
             $i=1;
             if ($recepciones == null) {
               $reception=[];
             }
             foreach ($recepciones as $recepcion) {
               $reception[$i] = DB::SELECT("SELECT c.name as nombre, r.pending,rd.total, c.email, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name
                                      FROM receptions r
                                       INNER JOIN reception_details rd on rd.order_detail = r.pending
                                       INNER JOIN products d on d.id = rd.dish_id
                                       INNER JOIN costumers c on c.id=r.customer_id
                                       LEFT JOIN attributes at on at.id = rd.id_attribute
                                       LEFT JOIN variations va on va.id = rd.id_variation
                                       WHERE r.pending = $recepcion->pending and r.id_user = $recepcion->id_user and rd.id_user_detail=$recepcion->id_user");
                $i = $i + 1 ;
             }
               return view('backend.reception.indexAccomplished')->with(compact('reception'));
          // --------------------------------------------------------
        } else {
           if ($recepcion == 'anulado') {
             // ----------------------------------------------
                   $recepciones = DB::SELECT("SELECT  id_user, pending  FROM receptions
                                              WHERE state = 3 and deliverier_id = $id_user");
                  $i=1;
                  if ($recepciones == null) {
                    $reception=[];
                  }
                  foreach ($recepciones as $recepcion) {
                    $reception[$i] = DB::SELECT("SELECT c.name as nombre,r.pending,rd.total, c.email, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name
                                           FROM receptions r
                                            INNER JOIN reception_details rd on rd.order_detail = r.pending
                                            INNER JOIN products d on d.id = rd.dish_id
                                            INNER JOIN costumers c on c.id=r.customer_id
                                            LEFT JOIN attributes at on at.id = rd.id_attribute
                                            LEFT JOIN variations va on va.id = rd.id_variation
                                            WHERE r.pending = $recepcion->pending and r.id_user = $recepcion->id_user and rd.id_user_detail=$recepcion->id_user");
                     $i = $i + 1 ;
                  }
                  return view('backend.reception.indexCanceled')->with(compact('reception'));
             // --------------------------------------------------------
           }
        }

      }
  }

  public function showMap($id){
    $id_user=session('deliverier')->id;
           // -----------------------------------------
           $recepcion = DB::SELECT("SELECT  latitude, longitude, image, address  FROM receptions
                                    WHERE pending = $id and deliverier_id = $id_user");
           
           return view('backend.reception.mapa')->with(compact('recepcion'));
  }


  public function changeAccomplished($pedido,$id){
    $id_user=session('deliverier')->id;
    $recep = DB::table('receptions')
            ->where('pending', $pedido)
            ->where('deliverier_id', $id_user)
            ->update(['state' => 2]);

           // -----------------------------------------
                   $recepciones = DB::SELECT("SELECT  id_user, pending  FROM receptions
                                              WHERE state = $id and deliverier_id = $id_user");
                  $i=1;
                  if ($recepciones == null) {
                    $reception=[];
                  }
                  foreach ($recepciones as $recepcion) {
                    $reception[$i] = DB::SELECT("SELECT c.name as nombre,r.pending,rd.total,c.email, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name
                                           FROM receptions r
                                            INNER JOIN reception_details rd on rd.order_detail = r.pending
                                            INNER JOIN products d on d.id = rd.dish_id
                                            INNER JOIN costumers c on c.id=r.customer_id
                                            LEFT JOIN attributes at on at.id = rd.id_attribute
                                            LEFT JOIN variations va on va.id = rd.id_variation
                                            WHERE r.pending = $recepcion->pending and r.id_user = $recepcion->id_user and rd.id_user_detail=$recepcion->id_user");
                     $i = $i + 1 ;
                  }
           // --------------------------------------------

           if ($id == 1) {
               return redirect('/admin/repartidor/recepciones/proceso');
           } else {
              if ($id == 2) {
                return redirect('/admin/repartidor/recepciones/realizado');
              } else {
                if ($id == 3) {
                  return redirect('/admin/repartidor/recepciones/anulado');
                }
              }

           }
  }

  public function changeProcess($pedido,$id){
    $id_user=session('deliverier')->id;
    $recep = DB::table('receptions')
            ->where('pending', $pedido)
            ->update(['state' => 1]);
           // -----------------------------------------
                   $recepciones = DB::SELECT("SELECT  id_user, pending  FROM receptions
                                              WHERE state = $id and deliverier_id = $id_user ");
                  $i=1;
                  if ($recepciones == null) {
                    $reception=[];
                  }
                  foreach ($recepciones as $recepcion) {
                    $reception[$i] = DB::SELECT("SELECT c.name as nombre,r.pending,rd.total,c.email, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name
                                           FROM receptions r
                                            INNER JOIN reception_details rd on rd.order_detail = r.pending
                                            INNER JOIN products d on d.id = rd.dish_id
                                            INNER JOIN costumers c on c.id=r.customer_id
                                            LEFT JOIN attributes at on at.id = rd.id_attribute
                                            LEFT JOIN variations va on va.id = rd.id_variation
                                            WHERE r.pending = $recepcion->pending and r.id_user = $recepcion->id_user and rd.id_user_detail=$recepcion->id_user");
                     $i = $i + 1 ;
                  }
           // --------------------------------------------

           if ($id == 1) {
               return redirect('/admin/repartidor/recepciones/proceso');
           } else {
              if ($id == 2) {
                return redirect('/admin/repartidor/recepciones/realizado');
              } else {
                if ($id == 3) {
                  return redirect('/admin/repartidor/recepciones/anulado');
                }
              }

           }
  }

  public function changeCanceled($pedido,$id){
    $id_user=session('deliverier')->id;
    $recep = DB::table('receptions')
            ->where('pending', $pedido)
            ->update(['state' => 3]);
           // -----------------------------------------
                 $recepciones = DB::SELECT("SELECT  id_user, pending  FROM receptions
                                            WHERE state = $id and deliverier_id = $id_user ");
                $i=1;
                if ($recepciones == null) {
                  $reception=[];
                }
                foreach ($recepciones as $recepcion) {
                  $reception[$i] = DB::SELECT("SELECT c.name as nombre, r.pending,rd.total, c.email, c.phone, c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name
                                         FROM receptions r
                                          INNER JOIN reception_details rd on rd.order_detail = r.pending
                                          INNER JOIN products d on d.id = rd.dish_id
                                          INNER JOIN costumers c on c.id=r.customer_id
                                          LEFT JOIN attributes at on at.id = rd.id_attribute
                                          LEFT JOIN variations va on va.id = rd.id_variation
                                          WHERE r.pending = $recepcion->pending and r.id_user = $recepcion->id_user and rd.id_user_detail=$recepcion->id_user");
                   $i = $i + 1 ;
                }
           // --------------------------------------------

           if ($id == 1) {
               return redirect('/admin/repartidor/recepciones/proceso');
           } else {
              if ($id == 2) {
                return redirect('/admin/repartidor/recepciones/realizado');
              } else {
                if ($id == 3) {
                  return redirect('/admin/repartidor/recepciones/anulado');
                }
              }

           }
  }

}
