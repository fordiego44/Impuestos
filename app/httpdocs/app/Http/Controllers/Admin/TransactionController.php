<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Configuration;
use App\Reception;

use Auth;
use App\Http\Controllers\Admin\HomeController;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function transaction() {

        $diaActual = date("d");

        $negocios = DB::SELECT("SELECT DISTINCT id_user, company
                                FROM receptions r
                                INNER JOIN users u on u.id = r.id_user
                                 WHERE r.state = 2 and transfer = 0 and DAY(date_reception) = $diaActual - 1");

                                 // dd($negocios);

          $i= 0;

         foreach ($negocios as $negocio) {
           $montoTotalNegocio[$negocio->company] = DB::SELECT("SELECT u.id as dueno_id,u.image as dueno_image,u.name as dueno_nombre, u.last_name as dueno_apellido,u.dni as dueno_dni, u.email as dueno_email, u.phone as dueno_phone ,
             c.name as nombre, r.pending,rd.total, c.email, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name
             FROM receptions r
             INNER JOIN reception_details rd on rd.order_detail = r.pending
             INNER JOIN costumers c on c.id=r.customer_id
             INNER JOIN products d on d.id = rd.dish_id
             INNER JOIN users u on u.id = r.id_user
             LEFT JOIN attributes at on at.id = rd.id_attribute
             LEFT JOIN variations va on va.id = rd.id_variation
             WHERE    r.id_user = $negocio->id_user and rd.id_user_detail = $negocio->id_user and r.state = 2 and transfer = 0 and DAY(r.date_reception) = $diaActual - 1");
              $i++ ;
           }
           // dd($montoTotalNegocio);
           if ($negocios != null) {
             foreach ($montoTotalNegocio as $key => $pedidos) {
                 $monto = 0;
                 foreach ($pedidos as $pedido) {
                       $monto = $monto +  $pedido->total;
                 }
                 $montoTotalNegocio[$key]['montoTotal'] = $monto;
                 $montoTotalNegocio[$key]['id'] = $pedido->dueno_id ;
                 $montoTotalNegocio[$key]['imagen'] = $pedido->dueno_image ;
                 $montoTotalNegocio[$key]['nombre'] = $pedido->dueno_nombre ;
                 $montoTotalNegocio[$key]['apellido'] = $pedido->dueno_apellido ;
                 $montoTotalNegocio[$key]['dni'] = $pedido->dueno_dni ;
                 $montoTotalNegocio[$key]['email'] = $pedido->dueno_email ;
                 $montoTotalNegocio[$key]['phone'] = $pedido->dueno_phone ;
             }
           } else {
                $montoTotalNegocio = [];
           }

        return view('admin.transaction.index')->with(compact('montoTotalNegocio'));
    }

    public function transactionDetails($id) {

      // ----------------------------------------------
        $id_user = $id;
        $diaActual = date("d");
            $recepciones = DB::SELECT("SELECT  pending  FROM receptions r
                                       WHERE r.state = 2 and transfer = 0 and id_user = $id_user and DAY(r.date_reception) = $diaActual - 1");
           $i=1;
           if ($recepciones == null) {
             $reception=[];
           }
           foreach ($recepciones as $recepcion) {
             $reception[$i] = DB::SELECT("SELECT c.name as nombre,rd.total,c.email,r.pending, c.phone,c.last_name,d.name,d.time_delay,d.price ,rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name
                                    FROM receptions r
                                     INNER JOIN reception_details rd on rd.order_detail = r.pending
                                     INNER JOIN costumers c on c.id=r.customer_id
                                     INNER JOIN products d on d.id = rd.dish_id
                                     LEFT JOIN attributes at on at.id = rd.id_attribute
                                     LEFT JOIN variations va on va.id = rd.id_variation
                                     WHERE r.pending = $recepcion->pending and r.id_user = $id_user and rd.id_user_detail=$id_user and DAY(r.date_reception) = $diaActual - 1");
              $i = $i + 1 ;
           }
           $montoTotal=0;
           foreach ($reception as $receptions) {
              foreach ($receptions as $receptions2){
                  $montoTotal +=   $receptions2->total;
              }
           }
      // --------------------------------------------------------
        return view('admin.transaction.transactionDetails')->with(compact('reception','montoTotal','id'));
    }

    public function createTransactionDetails($montoTotal,$idNegocio) {

          $diaActual = date("d");
          $anoActual = date("Y");
          $id = $idNegocio;
          $empresa = User::where('id', $id)->first();

          $comisionEmpresa = Configuration::where('id', 1)->first();
          $comision = $comisionEmpresa['companyPercentage'];

          $monto = $montoTotal;


          $montoPago =  $monto - ($monto * $comision);
          $resultadoReverse = 'Transaccion inversa sin ejecutar';
          $resultadoPull = 'Pull sin ejecutar';
          $resultadoPush = 'Push sin ejecutar';
          $tuCurl = curl_init();
          curl_setopt($tuCurl, CURLOPT_URL, "https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pullfundstransactions");
          curl_setopt($tuCurl, CURLOPT_USERPWD, "4UOF2IULUA4UQWI20R1321dLNNXtSicwNTRD9MQ-IylJtQqus:dpAKN3YIt3n5mrh6rg2jLG9FoGXsAKi0Bc1LE3");
          curl_setopt($tuCurl, CURLOPT_SSLCERT,public_path().'/cert.pem');
          curl_setopt($tuCurl, CURLOPT_SSLKEY,public_path().'/privateKey.pem');

                $headers = array(
                    'Content-Type:  application/json',
                    'Content-Type: application/octet-stream',
                );

          curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($tuCurl, CURLOPT_POST, true);

                $parametros = array(
                    "acquirerCountryCode"   => "840",
                    "acquiringBin"          => "408999",
                    "amount"                => $monto,
                    "businessApplicationId" => "AA",
                    "cardAcceptor" => array(
                         "address" => array(
                             "country" => "USA",
                             "county"  => "081",
                             "state"   => "CA",
                             "zipCode" => "94404"
                         ),
                         "idCode"     => "ABCD1234ABCD123",
                         "name"       => "Visa Inc. USA-Foster City",
                         "terminalId" => "ABCD1234"
                    ),
                    "foreignExchangeFeeTransaction" => "11.99",
                    "localTransactionDateTime"      => "2020-07-21T22:32:37",
                    "retrievalReferenceNumber"      => "330000550000",
                    "senderCardExpiryDate"          => "2015-10",
                    "senderCurrencyCode"            => "USD",
                    "senderPrimaryAccountNumber"    => "4895142232120006",
                    "systemsTraceAuditNumber"       => "451001",
                    "addressVerificationData"       => array(
                      "street"      => "XYZ St",
                      "postalCode"  => "12345"
                    )
                );


          curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
          curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
          curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
          $curl_response = curl_exec($tuCurl);
          curl_close($tuCurl);

          if($curl_response === false)
          {
              // echo 'Curl error: ' . curl_error($tuCurl);
              $resultadoPull = 'Pull cancelado';
          }
          else
          {
                $resultadoPull = "Pull ejecutado";

                 $tuCurl = curl_init();
                curl_setopt($tuCurl, CURLOPT_URL, "https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pushfundstransactions");
                curl_setopt($tuCurl, CURLOPT_USERPWD, "4UOF2IULUA4UQWI20R1321dLNNXtSicwNTRD9MQ-IylJtQqus:dpAKN3YIt3n5mrh6rg2jLG9FoGXsAKi0Bc1LE3");
                curl_setopt($tuCurl, CURLOPT_SSLCERT,public_path().'/cert.pem');
                curl_setopt($tuCurl, CURLOPT_SSLKEY,public_path().'/privateKey.pem');

                      $headers = array(
                          'Content-Type:  application/json',
                          'Content-Type: application/octet-stream',
                      );

                curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($tuCurl, CURLOPT_POST, true);

                      $parametros = array(
                          "acquirerCountryCode"   => "840",
                          "acquiringBin"          => "408999",
                          "amount"                => $monto,
                          "businessApplicationId" => "AA",
                          "cardAcceptor" => array(
                               "address" => array(
                                   "country" => "USA",
                                   "county"  => "San Mateo",
                                   "state"   => "CA",
                                   "zipCode" => "94404"
                               ),
                               "idCode"     => "CA-IDCode-77765",
                               "name"       => "Visa Inc. USA-Foster City",
                               "terminalId" => "TID-9999"
                          ),
                          "localTransactionDateTime"        => "2020-07-21T00:45:39",
                          "recipientName"                   => "rohan",
                          "recipientPrimaryAccountNumber"   => "4957030420210496",
                          "retrievalReferenceNumber"        => "412770451018",
                          "senderAccountNumber"             => "4653459515756154",
                          "sourceOfFundsCode"               => "05",
                          "systemsTraceAuditNumber"         => "451018",
                          "transactionCurrencyCode"         => "USD",
                          "transactionIdentifier"           => "115212031792704"
                      );


                curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
                curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
                curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
                $curl_response = curl_exec($tuCurl);
                curl_close($tuCurl);

                if($curl_response === false)
                {
                    // echo 'Curl error: ' . curl_error($tuCurl);
                    $resultadoPush = 'Push cancelado';

                    $tuCurl = curl_init();
                    curl_setopt($tuCurl, CURLOPT_URL, "https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pushfundstransactions");
                    curl_setopt($tuCurl, CURLOPT_USERPWD, "4UOF2IULUA4UQWI20R1321dLNNXtSicwNTRD9MQ-IylJtQqus:dpAKN3YIt3n5mrh6rg2jLG9FoGXsAKi0Bc1LE3");
                    curl_setopt($tuCurl, CURLOPT_SSLCERT,public_path().'/cert.pem');
                    curl_setopt($tuCurl, CURLOPT_SSLKEY,public_path().'/privateKey.pem');

                          $headers = array(
                              'Content-Type:  application/json',
                              'Content-Type: application/octet-stream',
                          );

                    curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($tuCurl, CURLOPT_POST, true);

                    $parametros = array(
                        "acquirerCountryCode"   => "608",
                        "acquiringBin"          => "408999",
                        "amount"                => "24.01",
                        "businessApplicationId" => "AA",
                        "cardAcceptor" => array(
                             "address" => array(
                                 "country" => "USA",
                                 "county"  => "San Mateo",
                                 "state"   => "CA",
                                 "zipCode" => "94404"
                             ),
                             "idCode"     => "VMT200911026070",
                             "name"       => "Visa Inc. USA-Foster City",
                             "terminalId" => "365539"
                        ),
                        "localTransactionDateTime"        => "2020-07-21T02:05:12",
                        "originalDataElements" => array(
                            "acquiringBin" => "408999",
                            "approvalCode"  => "20304B",
                            "systemsTraceAuditNumber"   => "897825",
                            "transmissionDateTime" => "2020-07-21T02:05:12"
                        ),
                        "retrievalReferenceNumber"        => "330000550000",
                        "senderCardExpiryDate"        => "2015-10",
                        "senderCurrencyCode"        => "USD",
                        "senderPrimaryAccountNumber"        => "4895100000055127",
                        "systemsTraceAuditNumber"        => "451050",
                        "transactionIdentifier"        => "381228649430011"

                    );

                    curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
                    curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
                    curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
                    $curl_response = curl_exec($tuCurl);
                    curl_close($tuCurl);

                    if($curl_response === false)
                    {
                        $resultadoReverse = 'Transaccion cancelado';
                    }
                    else
                    {
                        $resultadoReverse = 'Transaccion inversa ejecutado';
                    }
                }
                else
                {
                  $resultadoPush = 'Push ejecutado';
                  $recep = DB::table('receptions')
                          ->where('id_user', $id)
                          ->whereYear('date_reception', $anoActual)
                          ->whereDay('date_reception', $diaActual-1)
                          ->where('state', 2)
                          ->where('transfer', 0)
                          ->update(['transfer' => 1]);
                   return redirect('/superadmin/transacciones');
                }

          }
     }

    public function createTransaction(Request $request)
    {
          if ($request->ajax()) {
              $diaActual = date("d");
              $anoActual = date("Y");
              $id = $request->id_dueno;
              $empresa = User::where('id', $id)->first();

              $comisionEmpresa = Configuration::where('id', 1)->first();
              $comision = $comisionEmpresa['companyPercentage'];

              $monto = $request->monto;


              $montoPago =  $monto - ($monto * $comision);
              $resultadoReverse = 'Transaccion inversa sin ejecutar';
              $resultadoPull = 'Pull sin ejecutar';
              $resultadoPush = 'Push sin ejecutar';
              $tuCurl = curl_init();
              curl_setopt($tuCurl, CURLOPT_URL, "https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pullfundstransactions");
              curl_setopt($tuCurl, CURLOPT_USERPWD, "4UOF2IULUA4UQWI20R1321dLNNXtSicwNTRD9MQ-IylJtQqus:dpAKN3YIt3n5mrh6rg2jLG9FoGXsAKi0Bc1LE3");
              curl_setopt($tuCurl, CURLOPT_SSLCERT,public_path().'/cert.pem');
              curl_setopt($tuCurl, CURLOPT_SSLKEY,public_path().'/privateKey.pem');

                    $headers = array(
                        'Content-Type:  application/json',
                        'Content-Type: application/octet-stream',
                    );

              curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
              curl_setopt($tuCurl, CURLOPT_POST, true);

                    $parametros = array(
                        "acquirerCountryCode"   => "840",
                        "acquiringBin"          => "408999",
                        "amount"                => $monto,
                        "businessApplicationId" => "AA",
                        "cardAcceptor" => array(
                             "address" => array(
                                 "country" => "USA",
                                 "county"  => "081",
                                 "state"   => "CA",
                                 "zipCode" => "94404"
                             ),
                             "idCode"     => "ABCD1234ABCD123",
                             "name"       => "Visa Inc. USA-Foster City",
                             "terminalId" => "ABCD1234"
                        ),
                        "foreignExchangeFeeTransaction" => "11.99",
                        "localTransactionDateTime"      => "2020-07-21T22:32:37",
                        "retrievalReferenceNumber"      => "330000550000",
                        "senderCardExpiryDate"          => "2015-10",
                        "senderCurrencyCode"            => "USD",
                        "senderPrimaryAccountNumber"    => "4895142232120006",
                        "systemsTraceAuditNumber"       => "451001",
                        "addressVerificationData"       => array(
                          "street"      => "XYZ St",
                          "postalCode"  => "12345"
                        )
                    );


              curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
              curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
              curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
              $curl_response = curl_exec($tuCurl);
              curl_close($tuCurl);

              if($curl_response === false)
              {
                  // echo 'Curl error: ' . curl_error($tuCurl);
                  $resultadoPull = 'Pull cancelado';
              }
              else
              {
                    $resultadoPull = "Pull ejecutado";

                     $tuCurl = curl_init();
                    curl_setopt($tuCurl, CURLOPT_URL, "https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pushfundstransactions");
                    curl_setopt($tuCurl, CURLOPT_USERPWD, "4UOF2IULUA4UQWI20R1321dLNNXtSicwNTRD9MQ-IylJtQqus:dpAKN3YIt3n5mrh6rg2jLG9FoGXsAKi0Bc1LE3");
                    curl_setopt($tuCurl, CURLOPT_SSLCERT,public_path().'/cert.pem');
                    curl_setopt($tuCurl, CURLOPT_SSLKEY,public_path().'/privateKey.pem');

                          $headers = array(
                              'Content-Type:  application/json',
                              'Content-Type: application/octet-stream',
                          );

                    curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($tuCurl, CURLOPT_POST, true);

                          $parametros = array(
                              "acquirerCountryCode"   => "840",
                              "acquiringBin"          => "408999",
                              "amount"                => $monto,
                              "businessApplicationId" => "AA",
                              "cardAcceptor" => array(
                                   "address" => array(
                                       "country" => "USA",
                                       "county"  => "San Mateo",
                                       "state"   => "CA",
                                       "zipCode" => "94404"
                                   ),
                                   "idCode"     => "CA-IDCode-77765",
                                   "name"       => "Visa Inc. USA-Foster City",
                                   "terminalId" => "TID-9999"
                              ),
                              "localTransactionDateTime"        => "2020-07-21T00:45:39",
                              "recipientName"                   => "rohan",
                              "recipientPrimaryAccountNumber"   => "4957030420210496",
                              "retrievalReferenceNumber"        => "412770451018",
                              "senderAccountNumber"             => "4653459515756154",
                              "sourceOfFundsCode"               => "05",
                              "systemsTraceAuditNumber"         => "451018",
                              "transactionCurrencyCode"         => "USD",
                              "transactionIdentifier"           => "115212031792704"
                          );


                    curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
                    curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
                    curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
                    $curl_response = curl_exec($tuCurl);
                    curl_close($tuCurl);

                    if($curl_response === false)
                    {
                        // echo 'Curl error: ' . curl_error($tuCurl);
                        $resultadoPush = 'Push cancelado';

                        $tuCurl = curl_init();
                        curl_setopt($tuCurl, CURLOPT_URL, "https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pushfundstransactions");
                        curl_setopt($tuCurl, CURLOPT_USERPWD, "4UOF2IULUA4UQWI20R1321dLNNXtSicwNTRD9MQ-IylJtQqus:dpAKN3YIt3n5mrh6rg2jLG9FoGXsAKi0Bc1LE3");
                        curl_setopt($tuCurl, CURLOPT_SSLCERT,public_path().'/cert.pem');
                        curl_setopt($tuCurl, CURLOPT_SSLKEY,public_path().'/privateKey.pem');

                              $headers = array(
                                  'Content-Type:  application/json',
                                  'Content-Type: application/octet-stream',
                              );

                        curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($tuCurl, CURLOPT_POST, true);

                        $parametros = array(
                            "acquirerCountryCode"   => "608",
                            "acquiringBin"          => "408999",
                            "amount"                => "24.01",
                            "businessApplicationId" => "AA",
                            "cardAcceptor" => array(
                                 "address" => array(
                                     "country" => "USA",
                                     "county"  => "San Mateo",
                                     "state"   => "CA",
                                     "zipCode" => "94404"
                                 ),
                                 "idCode"     => "VMT200911026070",
                                 "name"       => "Visa Inc. USA-Foster City",
                                 "terminalId" => "365539"
                            ),
                            "localTransactionDateTime"        => "2020-07-21T02:05:12",
                            "originalDataElements" => array(
                                "acquiringBin" => "408999",
                                "approvalCode"  => "20304B",
                                "systemsTraceAuditNumber"   => "897825",
                                "transmissionDateTime" => "2020-07-21T02:05:12"
                            ),
                            "retrievalReferenceNumber"        => "330000550000",
                            "senderCardExpiryDate"        => "2015-10",
                            "senderCurrencyCode"        => "USD",
                            "senderPrimaryAccountNumber"        => "4895100000055127",
                            "systemsTraceAuditNumber"        => "451050",
                            "transactionIdentifier"        => "381228649430011"

                        );

                        curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
                        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
                        curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
                        $curl_response = curl_exec($tuCurl);
                        curl_close($tuCurl);

                        if($curl_response === false)
                        {
                            $resultadoReverse = 'Transaccion cancelado';
                        }
                        else
                        {
                            $resultadoReverse = 'Transaccion inversa ejecutado';
                        }
                    }
                    else
                    {
                      $resultadoPush = 'Push ejecutado';
                      $recep = DB::table('receptions')
                              ->where('id_user', $id)
                              ->whereYear('date_reception', $anoActual)
                              ->whereDay('date_reception', $diaActual-1)
                              ->where('state', 2)
                              ->where('transfer', 0)
                              ->update(['transfer' => 1]);
                    }

              }


                return response()->json([
                  'resultadoPull'        => $resultadoPull,
                  'resultadoPush'        => $resultadoPush,
                  'resultadoReverse'        => $resultadoReverse,

                  // 'transactionIdentifier' => $transactionIdentifier[1],
                  // 'actionCode' => $actionCode[1],
                  // 'approvalCode' => $approvalCode[1],
                  // 'responseCode' => $responseCode[1],
                  // 'transmissionDateTime' => $transmissionDateTime[1],
                  // 'cpsAuthorizationCharacteristicsIndicator' => $cpsAuthorizationCharacteristicsIndicator[1],
                  // 'comisionEmpresa' => $comisionEmpresa['companyPercentage']
                  'montoPago' => $montoPago,
                  'empresa' => $empresa


                ]);
          }
    }

    public function createTransactionAll(Request $request)
    {
          $diaActual = date("d");

          $negocios = DB::SELECT("SELECT DISTINCT id_user, company
                                  FROM receptions r
                                  INNER JOIN users u on u.id = r.id_user
                                   WHERE r.state = 2 and transfer = 0 and DAY(date_reception) = $diaActual - 1");

                                   // dd($negocios);

            $i= 0;

           foreach ($negocios as $negocio) {
             $montoTotalNegocio[$negocio->company] = DB::SELECT("SELECT u.id as dueno_id,u.image as dueno_image,u.name as dueno_nombre, u.last_name as dueno_apellido,u.dni as dueno_dni, u.email as dueno_email, u.phone as dueno_phone ,
               c.name as nombre, r.pending,rd.total, c.email, c.phone,c.last_name,d.name, rd.quantity, r.coupon, r.date_reception, r.customer_id,r.deliverier_id,at.name as at_name, va.name as va_name
               FROM receptions r
               INNER JOIN reception_details rd on rd.order_detail = r.pending
               INNER JOIN costumers c on c.id=r.customer_id
               INNER JOIN products d on d.id = rd.dish_id
               INNER JOIN users u on u.id = r.id_user
               LEFT JOIN attributes at on at.id = rd.id_attribute
               LEFT JOIN variations va on va.id = rd.id_variation
               WHERE    r.id_user = $negocio->id_user and rd.id_user_detail = $negocio->id_user and r.state = 2 and transfer = 0 and DAY(r.date_reception) = $diaActual - 1");
                $i++ ;
             }
             // dd($montoTotalNegocio);
             if ($negocios != null) {
               foreach ($montoTotalNegocio as $key => $pedidos) {
                   $monto = 0;
                   foreach ($pedidos as $pedido) {
                         $monto = $monto +  $pedido->total;
                   }
                   $montoTotalNegocio[$key]['montoTotal'] = $monto;
                   $montoTotalNegocio[$key]['id'] = $pedido->dueno_id ;
                   $montoTotalNegocio[$key]['imagen'] = $pedido->dueno_image ;
                   $montoTotalNegocio[$key]['nombre'] = $pedido->dueno_nombre ;
                   $montoTotalNegocio[$key]['apellido'] = $pedido->dueno_apellido ;
                   $montoTotalNegocio[$key]['dni'] = $pedido->dueno_dni ;
                   $montoTotalNegocio[$key]['email'] = $pedido->dueno_email ;
                   $montoTotalNegocio[$key]['phone'] = $pedido->dueno_phone ;

                   // -------------------------------------------------------------------
                   $diaActual = date("d");
                   $anoActual = date("Y");
                   $id = $montoTotalNegocio[$key]['id'];
                   $empresa = User::where('id', $id)->first();

                   $comisionEmpresa = Configuration::where('id', 1)->first();
                   $comision = $comisionEmpresa['companyPercentage'];

                   $monto = $montoTotalNegocio[$key]['montoTotal'];


                   $montoPago =  $monto - ($monto * $comision);
                   $resultadoReverse = 'Transaccion inversa sin ejecutar';
                   $resultadoPull = 'Pull sin ejecutar';
                   $resultadoPush = 'Push sin ejecutar';
                   $tuCurl = curl_init();
                   curl_setopt($tuCurl, CURLOPT_URL, "https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pullfundstransactions");
                   curl_setopt($tuCurl, CURLOPT_USERPWD, "4UOF2IULUA4UQWI20R1321dLNNXtSicwNTRD9MQ-IylJtQqus:dpAKN3YIt3n5mrh6rg2jLG9FoGXsAKi0Bc1LE3");
                   curl_setopt($tuCurl, CURLOPT_SSLCERT,public_path().'/cert.pem');
                   curl_setopt($tuCurl, CURLOPT_SSLKEY,public_path().'/privateKey.pem');

                         $headers = array(
                             'Content-Type:  application/json',
                             'Content-Type: application/octet-stream',
                         );

                   curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
                   curl_setopt($tuCurl, CURLOPT_POST, true);

                         $parametros = array(
                             "acquirerCountryCode"   => "840",
                             "acquiringBin"          => "408999",
                             "amount"                => $monto,
                             "businessApplicationId" => "AA",
                             "cardAcceptor" => array(
                                  "address" => array(
                                      "country" => "USA",
                                      "county"  => "081",
                                      "state"   => "CA",
                                      "zipCode" => "94404"
                                  ),
                                  "idCode"     => "ABCD1234ABCD123",
                                  "name"       => "Visa Inc. USA-Foster City",
                                  "terminalId" => "ABCD1234"
                             ),
                             "foreignExchangeFeeTransaction" => "11.99",
                             "localTransactionDateTime"      => "2020-07-21T22:32:37",
                             "retrievalReferenceNumber"      => "330000550000",
                             "senderCardExpiryDate"          => "2015-10",
                             "senderCurrencyCode"            => "USD",
                             "senderPrimaryAccountNumber"    => "4895142232120006",
                             "systemsTraceAuditNumber"       => "451001",
                             "addressVerificationData"       => array(
                               "street"      => "XYZ St",
                               "postalCode"  => "12345"
                             )
                         );


                   curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
                   curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
                   curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
                   curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
                   $curl_response = curl_exec($tuCurl);
                   curl_close($tuCurl);

                   if($curl_response === false)
                   {
                       // echo 'Curl error: ' . curl_error($tuCurl);
                       $resultadoPull = 'Pull cancelado';
                   }
                   else
                   {
                         $resultadoPull = "Pull ejecutado";

                          $tuCurl = curl_init();
                         curl_setopt($tuCurl, CURLOPT_URL, "https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pushfundstransactions");
                         curl_setopt($tuCurl, CURLOPT_USERPWD, "4UOF2IULUA4UQWI20R1321dLNNXtSicwNTRD9MQ-IylJtQqus:dpAKN3YIt3n5mrh6rg2jLG9FoGXsAKi0Bc1LE3");
                         curl_setopt($tuCurl, CURLOPT_SSLCERT,public_path().'/cert.pem');
                         curl_setopt($tuCurl, CURLOPT_SSLKEY,public_path().'/privateKey.pem');

                               $headers = array(
                                   'Content-Type:  application/json',
                                   'Content-Type: application/octet-stream',
                               );

                         curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
                         curl_setopt($tuCurl, CURLOPT_POST, true);

                               $parametros = array(
                                   "acquirerCountryCode"   => "840",
                                   "acquiringBin"          => "408999",
                                   "amount"                => $monto,
                                   "businessApplicationId" => "AA",
                                   "cardAcceptor" => array(
                                        "address" => array(
                                            "country" => "USA",
                                            "county"  => "San Mateo",
                                            "state"   => "CA",
                                            "zipCode" => "94404"
                                        ),
                                        "idCode"     => "CA-IDCode-77765",
                                        "name"       => "Visa Inc. USA-Foster City",
                                        "terminalId" => "TID-9999"
                                   ),
                                   "localTransactionDateTime"        => "2020-07-21T00:45:39",
                                   "recipientName"                   => "rohan",
                                   "recipientPrimaryAccountNumber"   => "4957030420210496",
                                   "retrievalReferenceNumber"        => "412770451018",
                                   "senderAccountNumber"             => "4653459515756154",
                                   "sourceOfFundsCode"               => "05",
                                   "systemsTraceAuditNumber"         => "451018",
                                   "transactionCurrencyCode"         => "USD",
                                   "transactionIdentifier"           => "115212031792704"
                               );


                         curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
                         curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
                         curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
                         curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
                         $curl_response = curl_exec($tuCurl);
                         curl_close($tuCurl);

                         if($curl_response === false)
                         {
                             // echo 'Curl error: ' . curl_error($tuCurl);
                             $resultadoPush = 'Push cancelado';

                             $tuCurl = curl_init();
                             curl_setopt($tuCurl, CURLOPT_URL, "https://sandbox.api.visa.com/visadirect/fundstransfer/v1/pushfundstransactions");
                             curl_setopt($tuCurl, CURLOPT_USERPWD, "4UOF2IULUA4UQWI20R1321dLNNXtSicwNTRD9MQ-IylJtQqus:dpAKN3YIt3n5mrh6rg2jLG9FoGXsAKi0Bc1LE3");
                             curl_setopt($tuCurl, CURLOPT_SSLCERT,public_path().'/cert.pem');
                             curl_setopt($tuCurl, CURLOPT_SSLKEY,public_path().'/privateKey.pem');

                                   $headers = array(
                                       'Content-Type:  application/json',
                                       'Content-Type: application/octet-stream',
                                   );

                             curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
                             curl_setopt($tuCurl, CURLOPT_POST, true);

                             $parametros = array(
                                 "acquirerCountryCode"   => "608",
                                 "acquiringBin"          => "408999",
                                 "amount"                => "24.01",
                                 "businessApplicationId" => "AA",
                                 "cardAcceptor" => array(
                                      "address" => array(
                                          "country" => "USA",
                                          "county"  => "San Mateo",
                                          "state"   => "CA",
                                          "zipCode" => "94404"
                                      ),
                                      "idCode"     => "VMT200911026070",
                                      "name"       => "Visa Inc. USA-Foster City",
                                      "terminalId" => "365539"
                                 ),
                                 "localTransactionDateTime"        => "2020-07-21T02:05:12",
                                 "originalDataElements" => array(
                                     "acquiringBin" => "408999",
                                     "approvalCode"  => "20304B",
                                     "systemsTraceAuditNumber"   => "897825",
                                     "transmissionDateTime" => "2020-07-21T02:05:12"
                                 ),
                                 "retrievalReferenceNumber"        => "330000550000",
                                 "senderCardExpiryDate"        => "2015-10",
                                 "senderCurrencyCode"        => "USD",
                                 "senderPrimaryAccountNumber"        => "4895100000055127",
                                 "systemsTraceAuditNumber"        => "451050",
                                 "transactionIdentifier"        => "381228649430011"

                             );

                             curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros));
                             curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
                             curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
                             curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
                             $curl_response = curl_exec($tuCurl);
                             curl_close($tuCurl);

                             if($curl_response === false)
                             {
                                 $resultadoReverse = 'Transaccion cancelado';
                             }
                             else
                             {
                                 $resultadoReverse = 'Transaccion inversa ejecutado';
                             }
                         }
                         else
                         {
                           $resultadoPush = 'Push ejecutado';
                           $recep = DB::table('receptions')
                                   ->where('id_user', $id)
                                   ->whereYear('date_reception', $anoActual)
                                   ->whereDay('date_reception', $diaActual-1)
                                   ->where('state', 2)
                                   ->where('transfer', 0)
                                   ->update(['transfer' => 1]);

                         }

                   }
                   // ----------------------------------------------------------------------
               }
               return redirect('/superadmin/transacciones');
             } else {
                  $montoTotalNegocio = [];
                  return redirect('/superadmin/transacciones');
             }
    }


}
