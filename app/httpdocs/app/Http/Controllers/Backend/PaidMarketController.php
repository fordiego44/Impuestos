<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
class PaidMarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::where('id', session('user')->id)->first();
        $id_MP = $usuario->id_MP;
        // dd($id_MP);

        if ($id_MP != null) { //Si tiene el id de mercado pago
          $idMP = 1;
        } else {
          $idMP = 0;
        }

        return view('backend.mercado.index')->with(compact('idMP'));
    }

    public function permission()
    {
        return view('backend.mercado.permiso');
    }


    public function updateCredential()
    {
      $usuario = User::where('id', session('user')->id)->first();
      $refresh_token = $usuario->refresh_token;



        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, "https://api.mercadopago.com/oauth/token");
          $headers = array(
             'Content-Type:  application/x-www-form-urlencoded',
             'accept: application/json',
          );
        curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($tuCurl, CURLOPT_POST, true);
        $parametros =
             array(
                     "client_secret" => "APP_USR-6444359659263359-081916-1309b389c51f08d43b12ab2d1d279845-626339400",
                     "grant_type"    => "refresh_token",
                     "refresh_token"  => $refresh_token,
             );
        curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
        $curl_response = curl_exec($tuCurl);
        curl_close($tuCurl);

        //return $parametros;
        if($curl_response === false)
        {
            // echo 'Curl error: ' . curl_error($tuCurl);
            $idMP = 4;
        }else {
           // echo 'salio';
           // return $curl_response;
            $respuesta =  json_decode($curl_response);


           if (isset($respuesta->message)) { // si hay mensaje negativo
              // $resultado = $respuesta->message;
              $idMP = 5;
           } else { 
             $idMP = 3; // Inidica que se hizo la actualización
             $usuario  = User::where('id', session('user')->id)->first();

             $usuario->access_token = $respuesta->access_token;
             $usuario->token_type = $respuesta->token_type;
             $usuario->expires_in = $respuesta->expires_in;
             $usuario->scope = $respuesta->scope;
             $usuario->id_MP = $respuesta->user_id;
             $usuario->refresh_token = $respuesta->refresh_token;
             $usuario->public_key = $respuesta->public_key;
             $usuario->live_mode = $respuesta->live_mode;
             $usuario->save();
           }

        }

        return view('backend.mercado.index')->with(compact('idMP'));
    }

    public function credential(Request $request)
    {
          // dd($request);
          $CODE = $request->code;

          $tuCurl = curl_init();
          curl_setopt($tuCurl, CURLOPT_URL, "https://api.mercadopago.com/oauth/token");
            $headers = array(
               'Content-Type:  application/x-www-form-urlencoded',
               'accept: application/json',
            );
          curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($tuCurl, CURLOPT_POST, true);
          $parametros =
               array(
                       "client_secret" => "APP_USR-6444359659263359-081916-1309b389c51f08d43b12ab2d1d279845-626339400",
                       "grant_type"    => "authorization_code",
                       "code"          => $CODE,
                       "redirect_uri"  => "https://globalmarketplaza.com/admin/validacion-mercado-pago/permitido",
               );
          curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
          curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
          curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
          $curl_response = curl_exec($tuCurl);
          curl_close($tuCurl);

          //return $parametros;
          if($curl_response === false)
          {
              // echo 'Curl error: ' . curl_error($tuCurl);
              $resultado = '0';
          }else {
             // echo 'salio';
             // return $curl_response;
              $respuesta =  json_decode($curl_response);
              // $resultado = $respuesta->message;
             if (isset($respuesta->message)) { // si hay mensaje negativo
                $resultado = $respuesta->message;
             } else {
               $resultado = $respuesta;

               $usuario  = User::where('id', session('user')->id)->first();

               $usuario->code = $CODE;
               $usuario->access_token = $respuesta->access_token;
               $usuario->token_type = $respuesta->token_type;
               $usuario->expires_in = $respuesta->expires_in;
               $usuario->scope = $respuesta->scope;
               $usuario->id_MP = $respuesta->user_id;
               $usuario->refresh_token = $respuesta->refresh_token;
               $usuario->public_key = $respuesta->public_key;
               $usuario->live_mode = $respuesta->live_mode;
               $usuario->save();
             }

          }

        // return redirect('/admin/validacion-mercado-pago');

        // $resultado = $request->code;
        return response()->json([
          'resultado'=>$resultado
              ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
