<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Deliverier;
use App\Reception;
use App\ReceptionDetail;
use Illuminate\Support\Facades\DB;
use Auth;
class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($recepcion)
    {
      // -------------------------
        $id_user=session('user')->id;
        // -----------------------------------------
        $delivery =  DB::SELECT("SELECT  * FROM deliveriers
                                WHERE id_user = $id_user and state_delete = 0 ");

        // ---------------------------------
        $nproceso = count(DB::SELECT("SELECT  pending  FROM receptions
                                WHERE state = 1 and id_user = $id_user"));
        $nrealizado = count(DB::SELECT("SELECT  pending  FROM receptions
                                WHERE state = 2 and id_user = $id_user"));
        $nanulado = count(DB::SELECT("SELECT  pending  FROM receptions
                                WHERE state = 3 and id_user = $id_user"));

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

                    $recepciones = DB::SELECT("SELECT  pending  FROM receptions
                                               WHERE state = 1 and id_user = $id_user");
                                               // return $recepciones;

                   $i=1;
                   if ($recepciones == null) {
                     $reception=[];
                   }
                   foreach ($recepciones as $recepcion) {
                     $reception[$i] = DB::SELECT("SELECT r.id as id, rd.orders_id, c.name as nombre,rd.total,c.email,r.pending, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name, r.state_delivery
                                            FROM receptions r
                                             INNER JOIN reception_details rd on rd.order_detail = r.pending
                                             INNER JOIN costumers c on c.id=r.customer_id
                                             INNER JOIN products d on d.id = rd.dish_id
                                             LEFT JOIN attributes at on at.id = rd.id_attribute
                                             LEFT JOIN variations va on va.id = rd.id_variation
                                             WHERE r.pending = $recepcion->pending and r.id_user = $id_user and rd.id_user_detail=$id_user");
                      $i = $i + 1 ;
                   } 
                   // dd($reception);
                   return view('backend.reception.indexProcess')->with(compact('reception', 'id_user'))->with(compact('delivery'));
              // --------------------------------------------------------
        } else {
          if ($recepcion == 'realizado') {
            // ----------------------------------------------
                $recepciones = DB::SELECT("SELECT  pending  FROM receptions
                                           WHERE state = 2 and id_user = $id_user ORDER BY date_reception DESC");
               $i=1;
               if ($recepciones == null) {
                 $reception=[];
               }
               foreach ($recepciones as $recepcion) {
                 $reception[$i] = DB::SELECT("SELECT c.name as nombre, r.pending,rd.total, c.email, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name, r.state_delivery
                                        FROM receptions r
                                         INNER JOIN reception_details rd on rd.order_detail = r.pending
                                         INNER JOIN costumers c on c.id=r.customer_id
                                         INNER JOIN products d on d.id = rd.dish_id
                                         LEFT JOIN attributes at on at.id = rd.id_attribute
                                         LEFT JOIN variations va on va.id = rd.id_variation
                                         WHERE r.pending = $recepcion->pending and r.id_user = $id_user and rd.id_user_detail=$id_user");
                  $i = $i + 1 ;
               }
               // dd($reception);
                 return view('backend.reception.indexAccomplished')->with(compact('reception', 'id_user'))->with(compact('delivery'));
            // --------------------------------------------------------
          } else {
             if ($recepcion == 'anulado') {
               // ----------------------------------------------
                     $recepciones = DB::SELECT("SELECT  pending  FROM receptions
                                                WHERE state = 3 and id_user = $id_user ORDER BY date_reception DESC");
                    $i=1;
                    if ($recepciones == null) {
                      $reception=[];
                    }
                    foreach ($recepciones as $recepcion) {
                      $reception[$i] = DB::SELECT("SELECT c.name as nombre,r.pending,rd.total, c.email, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name, r.state_delivery
                                             FROM receptions r
                                              INNER JOIN reception_details rd on rd.order_detail = r.pending
                                              INNER JOIN costumers c on c.id=r.customer_id
                                              INNER JOIN products d on d.id = rd.dish_id
                                              LEFT JOIN attributes at on at.id = rd.id_attribute
                                              LEFT JOIN variations va on va.id = rd.id_variation
                                              WHERE r.pending = $recepcion->pending and r.id_user = $id_user and rd.id_user_detail=$id_user");
                       $i = $i + 1 ;
                    }
                    return view('backend.reception.indexCanceled')->with(compact('reception', 'id_user'))->with(compact('delivery'));
               // --------------------------------------------------------
             }
          }

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function showMap($id){
       $id_user=session('user')->id;
              // -----------------------------------------
              $recepcion = DB::SELECT("SELECT  latitude, longitude, image, address  FROM receptions
                                         WHERE pending = $id and id_user = $id_user");
              return view('backend.reception.mapa')->with(compact('recepcion'));
     }

    public function prueba()
    {

      return view('backend.reception.prueba');
    }
    public function prueba2()
    {
      $input= '00000010';
      $int = (int)$input;
      // $hola= str_pad($input, 10, "0", STR_PAD_LEFT);
      // return $hola;
      return $int;
      // return view('backend.reception.prueba');
    }

    public function changeAccomplished($pedido,$id){
      $id_user=session('user')->id;
      $recep = DB::table('receptions')
              ->where('pending', $pedido)
              ->where('id_user', $id_user)
              ->update(['state' => 2]);


             if ($id == 1) {
                 return redirect('/admin/recepciones/proceso');
             } else {
                if ($id == 2) {
                  return redirect('/admin/recepciones/realizado');
                } else {
                  if ($id == 3) {
                    return redirect('/admin/recepciones/anulado');
                  }
                }

             }
    }

    public function changeProcess($pedido,$id){
      $id_user=session('user')->id;
      $recep = DB::table('receptions')
              ->where('pending', $pedido)
              ->update(['state' => 1]);

             if ($id == 1) {
                 return redirect('/admin/recepciones/proceso');
             } else {
                if ($id == 2) {
                  return redirect('/admin/recepciones/realizado');
                } else {
                  if ($id == 3) {
                    return redirect('/admin/recepciones/anulado');
                  }
                }

             }
    }

    public function changeCanceled($pedido,$id){
      $id_user=session('user')->id;
      $recep = DB::table('receptions')
              ->where('pending', $pedido)
              ->update(['state' => 3]);

             if ($id == 1) {
                 return redirect('/admin/recepciones/proceso');
             } else {
                if ($id == 2) {
                  return redirect('/admin/recepciones/realizado');
                } else {
                  if ($id == 3) {
                    return redirect('/admin/recepciones/anulado');
                  }
                }

             }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chooseDeliverier(Request $request)
    {
          if ($request->ajax()) {

            DB::table('receptions')
                    // ->where('cliente_id', $cliente)
                    ->where('pending', $request->id_pending)->where('id_user', session('user')->id)
                    ->update(['deliverier_id' => $request->id_repartidor]);

              return response()->json([
                  'exito'        => '1'
              ]);
          }
    }


    public function indexDeliverier($recepcion)
    {
        $id_user=session('users')->id;
        // -----------------------------------------
        $delivery =  DB::SELECT("SELECT  * FROM deliveriers
                                WHERE id_user = $id_user and state_delete = 0 ");

        // ---------------------------------
        $nproceso = count(DB::SELECT("SELECT  pending  FROM receptions
                                WHERE state = 1 and id_user = $id_user"));
        $nrealizado = count(DB::SELECT("SELECT  pending  FROM receptions
                                WHERE state = 2 and id_user = $id_user"));
        $nanulado = count(DB::SELECT("SELECT  pending  FROM receptions
                                WHERE state = 3 and id_user = $id_user"));

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

                    $recepciones = DB::SELECT("SELECT  pending  FROM receptions
                                               WHERE state = 1 and id_user = $id_user");
                   $i=1;
                   if ($recepciones == null) {
                     $reception=[];
                   }
                   foreach ($recepciones as $recepcion) {
                     $reception[$i] = DB::SELECT("SELECT c.name as nombre  ,rd.total,c.email,r.pending, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name, r.state_delivery
                                            FROM receptions r
                                             INNER JOIN reception_details rd on rd.order_detail = r.pending
                                             INNER JOIN costumers c on c.id=r.customer_id
                                             INNER JOIN products d on d.id = rd.dish_id
                                             LEFT JOIN attributes at on at.id = rd.id_attribute
                                             LEFT JOIN variations va on va.id = rd.id_variation
                                             WHERE r.pending = $recepcion->pending and r.id_user = $id_user and rd.id_user_detail=$id_user");
                      $i = $i + 1 ;
                   }
                   // ->with(compact('valor2'))
                   return view('backend.deliverierReception.indexProcess')->with(compact('reception'))->with(compact('delivery'));
              // --------------------------------------------------------
        } else {
          if ($recepcion == 'realizado') {
            // ----------------------------------------------
                $recepciones = DB::SELECT("SELECT  pending  FROM receptions
                                           WHERE state = 2 and id_user = $id_user ORDER BY date_reception DESC");
               $i=1;
               if ($recepciones == null) {
                 $reception=[];
               }
               foreach ($recepciones as $recepcion) {
                 $reception[$i] = DB::SELECT("SELECT c.name as nombre, r.pending,rd.total, c.email, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name, r.state_delivery
                                        FROM receptions r
                                         INNER JOIN reception_details rd on rd.order_detail = r.pending
                                         INNER JOIN costumers c on c.id=r.customer_id
                                         INNER JOIN products d on d.id = rd.dish_id
                                         LEFT JOIN attributes at on at.id = rd.id_attribute
                                         LEFT JOIN variations va on va.id = rd.id_variation
                                         WHERE r.pending = $recepcion->pending and r.id_user = $id_user and rd.id_user_detail=$id_user");
                  $i = $i + 1 ;
               }
                 return view('backend.deliverierReception.indexAccomplished')->with(compact('reception'))->with(compact('delivery'));
            // --------------------------------------------------------
          } else {
             if ($recepcion == 'anulado') {
               // ----------------------------------------------
                     $recepciones = DB::SELECT("SELECT  pending  FROM receptions
                                                WHERE state = 3 and id_user = $id_user ORDER BY date_reception DESC");
                    $i=1;
                    if ($recepciones == null) {
                      $reception=[];
                    }
                    foreach ($recepciones as $recepcion) {
                      $reception[$i] = DB::SELECT("SELECT c.name as nombre,r.pending,rd.total, c.email, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name, r.state_delivery
                                             FROM receptions r
                                              INNER JOIN reception_details rd on rd.order_detail = r.pending
                                              INNER JOIN costumers c on c.id=r.customer_id
                                              INNER JOIN products d on d.id = rd.dish_id
                                              LEFT JOIN attributes at on at.id = rd.id_attribute
                                              LEFT JOIN variations va on va.id = rd.id_variation
                                              WHERE r.pending = $recepcion->pending and r.id_user = $id_user and rd.id_user_detail=$id_user");
                       $i = $i + 1 ;
                    }
                    return view('backend.deliverierReception.indexCanceled')->with(compact('reception'))->with(compact('delivery'));
               // --------------------------------------------------------
             }
          }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function guide()
     {
         return view('backend.reception.guia');
     }
}
