<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Restaurant;
use App\User;
use App\Reception;
use App\Costumer;
use App\Comment;
use App\Message;
use Session;

use App\ValidatorCustom;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use App\Classification;

class CostumerController extends Controller
{
    public function __construct() {
        $this->oValidator = new ValidatorCustom();
    }
    public function talk($id) {
      $bussines = DB::table('bussines')->get();
      $users = User::with(['categories'])->get();

      return view('frontend.user.chat')->with(compact('bussines','users'));
    }
    public function porcentaje(){
      $id_user_porcentaje = session('costumer')->id;
      $recepciones_porcentaje = DB::table('receptions')->where('customer_id', $id_user_porcentaje)->where('state','!=','3')->orderBy('date_reception','desc')->get();
      $i_porcentaje = 1;
      $totalVentasCliente_porcentaje = 0;
      if ($recepciones_porcentaje == null) {
        $reception_porcentaje=[];
      }
                //dd($recepciones_porcentaje);
      foreach ($recepciones_porcentaje as $recepcion_porcentaje) {
        $reception_porcentaje[$i_porcentaje] = DB::table('receptions')
                                ->join('reception_details','reception_details.order_detail','receptions.pending')
                                ->join('products','products.id','reception_details.dish_id')
                                ->join('costumers','costumers.id','receptions.customer_id')
                                ->where('receptions.pending', $recepcion_porcentaje->pending)
                                ->where('receptions.id_user', $recepcion_porcentaje->id_user)
                                ->where('reception_details.id_user_detail',$recepcion_porcentaje->id_user)
                                ->where('receptions.departament','!=', "23")
                                ->where('receptions.state_delivery','=', 1)
                                ->get();
        foreach($reception_porcentaje[$i_porcentaje] as $item){
            $totalVentasCliente_porcentaje += $item->total;
        }
        $i_porcentaje = $i_porcentaje + 1 ;

      }
                //dd($reception_porcentaje);
      $curl = curl_init();
      curl_setopt_array($curl, array(
          CURLOPT_URL => "https://free.currconv.com/api/v7/convert?q=USD_PEN&compact=ultra&apiKey=76717b08f772283d7792",
          CURLOPT_RETURNTRANSFER => 1
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      $response = json_decode($response, true);
      //$conversion = $response["USD_PEN"];
      $limiteCompraTacna_porcentaje = 3000 * 3.64;
      $limiteVenta_porcentaje = $totalVentasCliente_porcentaje;
      $porcentaje = ($totalVentasCliente_porcentaje * 100)/$limiteCompraTacna_porcentaje;
      $restoPorcentaje = $limiteCompraTacna_porcentaje - $totalVentasCliente_porcentaje;

      return response()->json([
        'restoPorcentaje'=>$restoPorcentaje,
        'porcentaje'=>$porcentaje,
        'limiteCompraTacna_porcentaje' => $limiteCompraTacna_porcentaje,
        'totalVentasCliente_porcentaje' => $totalVentasCliente_porcentaje
            ]);
    }
    public function profile(){

      if (! Session::has('costumer')) {
        return redirect('/');
      }

        $id_user = session('costumer')->id;
        //dd($messages);
        $costumer = Costumer::where('id', $id_user)->first();

        $departamento = DB::SELECT("SELECT * FROM departamentos");
        $provincia = DB::SELECT("SELECT * FROM provincias");
        $distrito = DB::SELECT("SELECT * FROM distritos");

        return view('frontend.user.profile')->with(
          compact(
          'costumer',
          'departamento',
          'provincia',
          'distrito')
        );
    }



    public function listBussiness(Request $request){
        if ($request->ajax()) {
                  // session('costumer')->id;
                $id_user = session('costumer')->id;

                $negocio = DB::SELECT("SELECT *
                                        FROM mybusinesses m
                                        INNER JOIN users u on u.id=m.id_user
                                        WHERE m.id_customer = $id_user and m.state_delete = 0");
                  $resultado='2';
                  return response()->json([
                    'recenGenerate'=>$negocio,
                    'resultado'=>$resultado
                  ]);

        }
    }
    public function evaluation(Request $request){
      //dd($request);
      $reception = Reception::where('id_user','=',$request->id_user)->where('pending','=',$request->pending)->first();
      $reception->state_answer = 1;
      if($request->answer1 == 'true'){
          $reception->answer1 = 1;
      }
      else{
          $reception->answer1 = 0;
      }
      if($request->answer2 == 'true'){
        $reception->answer2 = 1;
      }else{
        $reception->answer2 = 0;
      }

      $reception->save();
      return response()->json([
        'reception'=>$reception
      ]);
    }
    public function listPending(Request $request){

        if ($request->ajax()) {
                  // session('costumer')->id;
                $id_user = session('costumer')->id;

                $negocio = DB::SELECT("SELECT  DISTINCT r.id_user,  u.company, u.address, u.image
                                        FROM costumers c
                                        INNER JOIN receptions r on r.customer_id=c.id
                                        INNER JOIN users u on u.id=r.id_user
                                        WHERE r.customer_id = $id_user");

            $resultado='1';
              return response()->json([
                'recenGenerate'=>$negocio,
                'resultado'=>$resultado
                    ]);
        }
    }

public function ProcesarDevolucion(Request $request)
{
    $pedido = $request->pedido;
    $empresa = $request->empresa;
    $access_token = 'APP_USR-6444359659263359-081916-1309b389c51f08d43b12ab2d1d279845-626339400';

    $vendedor = User::where('id', $empresa)->first(); //creo una consulta para obtener el collector_id de la tabla USER
    $collector_id = $vendedor->id_MP;

    $recepcion  = Reception::where('pending', $pedido)
                        ->where('id_user', $empresa)->first();// Obtener id_advance_payment
    $payments_id  =  $recepcion->advanced_payments_id ;

    if ($recepcion->state != 2) { //El estado esta en proceso
      $tuCurl = curl_init(); //solicitud del pago id_advance_payment GET
      curl_setopt($tuCurl, CURLOPT_URL, "https://api.mercadopago.com/v1/advanced_payments/$payments_id?access_token=$access_token");
      curl_setopt($tuCurl, CURLOPT_POST, false);
      curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
      curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
      $curl_response = curl_exec($tuCurl);
      curl_close($tuCurl);

      //return $parametros;
      if($curl_response === false)
      {
          // echo 'Curl error: ' . curl_error($tuCurl);
          $resultado = '0'; // El cURL no se ejecuto exitosamente
      }else {

          $respuesta =  json_decode($curl_response);

          if (isset($respuesta->disbursements)) {
            $listaVendedores = $respuesta->disbursements; //obtengo la lista de  vendedores

            $resultado = '1'; // Se encontro detalle del pago con exito
          }else {
             $resultado = '2'; //Error, no existe el pago
          }

      }
      if ($resultado == '1') {
        if ($respuesta->status == 'approved') {  // Si el pago esta aprovado, realizamos la operacion de buscar el $disbursement_id
          foreach ($listaVendedores as $vendedor) {   // recoorro la lista de vendedores verificado cual tiene el collector id
             if ($vendedor->collector_id == $collector_id) {
                 $disbursement_id = $vendedor->id;
                 $resultado = '4'; // Tenemos el $disbursement_id del vendedor
             }
          }
        }else {
          $resultado = '3'; // El pago no esta aprovado, ya fue develto el dinero
        }
      }

      if ($resultado == '4') {     // si lo encuentra Hago peticion POST para realizar la devolucion

          $tuCurl = curl_init();
          curl_setopt($tuCurl, CURLOPT_URL, "https://api.mercadopago.com/v1/advanced_payments/$payments_id/disbursements/$disbursement_id/refunds?access_token=$access_token");
            $headers = array(
               'Content-Type:  application/x-www-form-urlencoded',
               'accept: application/json',
            );
          curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($tuCurl, CURLOPT_POST, true);
          curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
          curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
          $curl_response = curl_exec($tuCurl);
          curl_close($tuCurl);

          if($curl_response === false)
          {
              // echo 'Curl error: ' . curl_error($tuCurl);
              $resultado = '0-1';     // caso contrario mensaje Solicitud en mantenimiento, Comuniquese directamente con la tienda para que le devuelva el dinero
          }else {

              $respuesta =  json_decode($curl_response);
              // $resultado = $respuesta;

              if (isset($respuesta->status)) {
                $resultado = '1-1'; // Se encontro detalle de la devolucion
              }else {
                 $resultado = '2-1'; //Error, el pago ya fue  devuelto
              }
          }

          if ($resultado == '1-1') {
              if ($respuesta->status == "approved") { // si es aprovado
                  // $resultado = $respuesta;
                    $resultado ='1-2';

                  $pedidoVendedor  = Reception::where('pending', $pedido)
                                      ->where('id_user', $empresa)->first();
                  $pedidoVendedor->state = 3;
                  $pedidoVendedor->save();
                  //Si el post es aprroved mensaje: Devolucion exitosa, su pago esta en camino.
                  //caso contrario, mensaje: el dinero ya fue devuelto, es posible que la transferencia a su tarjeta demore.
              }else {
                   $resultado = '2-2';
              }
          }

      }
    } else {
       $resultado ='0-2'; // La compra ya fue aprobada, comuniquese con la tienda.
    }



 return response()->json([
   'resultado'=>$resultado
       ]);

}

public function myPedidos($id){

    // return $id;
    // session('costumer')->id;
    $id_user = session('costumer')->id;

    $negocio = DB::SELECT("SELECT  * FROM users
                            WHERE id  = $id ");

    $delivery =  DB::SELECT("SELECT  * FROM deliveriers
                            WHERE id_user = $id and state_delete = 0 ");

    $costumer = Costumer::where('id', $id_user)->first();
    $recepciones = DB::SELECT("SELECT  id_user,pending  FROM receptions
                               WHERE  customer_id = $id_user and id_user = $id");
                                // state = 1 and

    $i=1;
    if ($recepciones == null) {
      $reception=[];
    }
    foreach ($recepciones as $recepcion) {
        // de.name as nombre  , de.last_name,
      $reception[$i] = DB::SELECT("SELECT rd.total,r.pending,d.name, rd.quantity, r.coupon, r.date_reception,r.deliverier_id, r.id_user
        FROM receptions r
        INNER JOIN reception_details rd on rd.order_detail = r.pending
        INNER JOIN products d on d.id = rd.dish_id
        INNER JOIN costumers c on c.id=r.customer_id
        -- INNER JOIN deliveriers de on de.id=r.deliverier_id
        WHERE r.pending = $recepcion->pending and r.id_user = $recepcion->id_user and rd.id_user_detail=$recepcion->id_user");
        $i = $i + 1 ;
      }
      $bussines = DB::table('bussines')->get();

    // return  $reception;
        $users = User::with(['categories'])->get();
        $subcategory  = Classification::groupby('name')->distinct()->get();
        return view('frontend.user.pedidos')->with(compact('subcategory','reception','costumer','bussines','delivery','id','negocio','users'));

}





      public function updateProfile(Request $request)
      {
        if ($request->ajax()) {


            $id_user = session('costumer')->id;

            $costumer = Costumer::where('id', $id_user)->first();
            $costumers = DB::table('costumers')->where('id', '!=', $id_user)->get();
            //dd($request, $costumer);
            //dd($costumers);
            foreach($costumers as $item){

              if($item->email == $request->email){
                $status = 300;
                return response()->json(['status' => $status]);
              }
            }
            if($request->hasFile('file')) {
              $file = $request->file('file');
              $name = time().$file->getClientOriginalName();
              $file->move(public_path().'/images/',$name);
              $costumer->image = $name;
            }
            $costumer->name = $request->nombre;
            $costumer->last_name = $request->apellido;
            $costumer->phone = $request->celular;
            //CAMBIOS
            if($costumer->change_dni != 2){
              //$costumer->dni = $request->dni;
              if($request->dni != $costumer->dni){
                $costumer->change_dni ++;
              }
              $costumer->dni = $request->dni;

            } 
            $costumer->telephone = $request->telefono;
            $costumer->direction = $request->direccion;
            $status = 200;
            $costumer->save();
            return response()->json([ 'costumer' => $costumer, 'status' => $status]);
            //return redirect('/mi-perfil');

        }

      }


      public function searchBusiness(Request $request) {

          if ($request->id_departamento == null and $request->categoria_id == null) {
            $negocios = DB::SELECT("SELECT  u.id as id , u.company
              FROM users u ");
            } else {
                if ($request->id_departamento == null and $request->categoria_id != null) {
                  $negocios = DB::SELECT("SELECT  u.id as id , u.company
                    FROM users u
                    WHERE u.business = $request->categoria_id");
                } else {
                   if ($request->id_departamento != null and $request->categoria_id == null) {
                     $negocios = DB::SELECT("SELECT  u.id as id , u.company
                       FROM users u
                       WHERE u.department = $request->id_departamento  ");
                   } else {
                     $negocios = DB::SELECT("SELECT  u.id as id , u.company
                       FROM users u
                       WHERE u.department = $request->id_departamento and u.business = $request->categoria_id");
                   }

                }
           }
          return response()->json([ 'negocios' => $negocios]);

      }

      public function searchCategories(Request $request) {

        if ($request->id_departamento == null) {
          $business = DB::SELECT("SELECT  u.business as id , b.name
            FROM users u
            INNER JOIN bussines b on b.id=u.business");
        } else {
          $business = DB::SELECT("SELECT  u.business as id , b.name
            FROM users u
            INNER JOIN bussines b on b.id=u.business
            WHERE u.department = $request->id_departamento");
        }
          return response()->json([ 'bussines' => $business]);
      }


    public function signIn(Request $request) {
        $validator = $this->oValidator->validateLoginCostumer($request);
        if (isset($validator->email) || isset($validator->password) || isset($validator->email_register))  {
          return response()->json(['status' => 500, 'errors'=> $validator]);
        } else {
            $user = Costumer::where('email', $request->email)->first();
            if (Hash::check($request->password, $user->password)) {
                session(['costumer' => $user]);
                return response()->json(['status'=> 200 ]);

            }
        }
    }

    public function signUp(Request $request) {

        $validator = $this->oValidator->validateRegisterCostumer($request);

        if (isset($validator->email_register) || isset($validator->dni) || isset($validator->names) || isset($validator->lastnames) || isset($validator->email) || isset($validator->password) || isset($validator->password_confirmation) ||  isset($validator->password_equal)) {

            return response()->json(['status' => 500, 'errors'=> $validator]);
        } else {

            if (isset($validator->phone)) {
                if (isset($validator->cellphone)) {
                  return response()->json(['status' => 500, 'errors'=> $validator]);
                } else {
                  $costumer = Costumer::create([
                    'name' => $request->names,
                    'email' => $request->email,
                    'phone' => $request->cellphone,
                    'dni' => $request->dni,
                    'last_name' => $request->lastnames,
                    'password' => bcrypt($request->password),
                ]);
                return response()->json(['status'=> 200, 'costumer' => $costumer]);
                }
            } else {
              if (isset($validator->cellphone)) {
                $costumer = Costumer::create([
                    'name' => $request->names,
                    'email' => $request->email,
                    'telephone' => $request->phone,
                    'dni' => $request->dni,
                    'last_name' => $request->lastnames,
                    'password' => bcrypt($request->password),
                ]);
              } else {
                $costumer = Costumer::create([
                  'name' => $request->names,
                  'email' => $request->email,
                  'telephone' => $request->phone,
                  'phone' => $request->cellphone,
                  'dni' => $request->dni,
                  'last_name' => $request->lastnames,
                  'password' => bcrypt($request->password),
              ]);
              return response()->json(['status'=> 200, 'costumer' => $costumer]);
              }

            }
        }

    }
    public function logout(Request $request) {
        $request->session()->forget('costumer');
        $request->session()->flush();
        return redirect('/');
    }

    public function upComment(Request $request)
    {
        $id_customer = session('costumer')->id;
        $existe = DB::SELECT("SELECT * FROM comments WHERE id_user=$request->id_user  and id_customer= $id_customer");
        if (!isset($request->rating)) {
           $raiting= 1;
        } else {
          $raiting= $request->rating;
        }

        if ($request->ajax()) {
            $now = new \DateTime();
            if ($existe) {
              $comentario = Comment::where('id_user', $request->id_user)->where('id_customer', $id_customer)->first();
              $comentario->comment = $request->opinion;
              $comentario->date  = $now ;
              $comentario->qualification  = $raiting ;
            } else {
              $comentario = new Comment;
              $comentario->id_customer = $id_customer;
              $comentario->id_user = $request->id_user;
              $comentario->comment = $request->opinion;
              $comentario->state_delete  = 0 ;
              $comentario->date  = $now ;
              $comentario->qualification  = $raiting ;
            }
            $comentario->save();

              $resultado='up';
                return response()->json([
                  // 'recenGenerate'=>$recenGenerate,
                  'resultado'=>$resultado,
                      'nombre'=>session('costumer')->name,
                      'apellido'=>session('costumer')->last_name,
                      'comentario'=>$request->opinion,
                      'fecha'=>$now,
                      'id_usuario'=>$request->id_user,
                      'raiting'=> $raiting

              ]);
          }
    }

    public function deleteComment(Request $request)
    {
        if ($request->ajax()) {
              $id_customer = session('costumer')->id;
              $comentario = Comment::where('id_user', $request->id_user)->where('id_customer', $id_customer)->first();
              $comentario->delete();

              $resultado='eliminado';
                return response()->json([
                  // 'recenGenerate'=>$recenGenerate,
                  'resultado'=>$resultado
                      ]);
          }
    }

    public function   validationOpinion(Request $request)
    {
        if ($request->ajax()) {
              if (\Session::get('costumer')) {
                $resultado='existe';
              } else {
                $resultado='no existe';
              }

                return response()->json([
                  // 'recenGenerate'=>$recenGenerate,
                  'resultado'=>$resultado
                      ]);
          }
    }



}
