<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Storage;
use App\User;
use App\ReceptionDetail;
use App\Reception;
use App\Configuration;
use Carbon\Carbon;
use App\Costumer;
use App\Order;
//use App\Costumer;
use App\Libreria\Mail\PHPMailer;
Use App\Plugins\Requests\library\Requests;
Use CyberSource;
use App\Resources\ExternalConfiguration;
//Eliminar
use Illuminate\Support\Facades\Crypt;
use App\Card;
//Eliminar

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
use App\Classification;
//require_once __DIR__ .'/phpmailer/Exception.php';
//require_once __DIR__ .'/phpmailer/PHPMailer.php';
//require_once __DIR__ .'/phpmailer/SMTP.php';*/


class CheckoutController extends Controller
{

    public function index(){
        $bussines = DB::table('bussines')->get();
        $users = User::with(['categories'])->get();
        $subcategory  = Classification::groupby('name')->distinct()->get();
        return view('frontend.cart.index')->with(compact('subcategory','bussines', 'users'));
    }

    public function showcheckout(Request $request){
        $users = User::with(['categories'])->get();
        $subcategory  = Classification::groupby('name')->distinct()->get();
        if ($request->session()->exists('costumer')){

            $bussines = DB::table('bussines')->get();
            $cliente = session('costumer')->id;
            $usuario = DB::table('costumers')->where('costumers.id','=',$cliente)->first();
            $departamentos = DB::table('departamentos')->get();
            $usuario->departament != null ? $departamento = DB::table('departamentos')->get() : $departamento = false;
            $usuario->departament != null ? $provincias = DB::table('provincias')->where('department_id', $usuario->departament)->get() : $provincias = false;
            $usuario->province != null ? $distritos = DB::table('distritos')->where('province_id', $usuario->province)->get() : $distritos = false;

            //return view('frontend.cart.checkout')->with(compact('usuario','bussines','departamentos','provincias','distritos'));
			//Eliminar
			$cards = DB::table('customer_cards')->where('customer_cards.id_customer','=',$cliente)->get();
			foreach($cards as $item){
                $item->number = Crypt::decryptString($item->number);
            }

            return view('frontend.cart.checkout')->with(compact('subcategory','usuario','bussines','departamentos','departamento','provincias','distritos','cards', 'users'));

			//Eliminar
        }
        else{
            $bussines = DB::table('bussines')->get();
            return view('frontend.cart.checkout')->with(compact('subcategory','bussines', 'users'));
        }


    }
    public function resume(Request $request){
        $bussines = DB::table('bussines')->get();
        $users = User::with(['categories'])->get();
        $subcategory  = Classification::groupby('name')->distinct()->get();

        return view('frontend.cart.resume')->with(compact('subcategory','bussines', 'users'));
    }
	//Eliminar
	public function card(Request $request){
        $card = Card::where('id','=',$request->id)->first();
        $card->number = Crypt::decryptString($card->number);
        $card->mounth = Crypt::decryptString($card->mounth);
        $card->year = Crypt::decryptString($card->year);
        $card->cvv = Crypt::decryptString($card->cvv);
        $card->name = Crypt::decryptString($card->name);
        $card->type_document = Crypt::decryptString($card->type_document);
        $card->document = Crypt::decryptString($card->document);
        if($card->cvv == $request->cvv){
            return response()->json([ 'card' => $card, 'status' => 200]);
        }
        else{
            return response()->json([ 'status' => 201]);
        }


    }
	//Eliminar
    public function checkout(Request $request){
		//dd($request);
        //VALIDACION DE DEPARTAMENTO


        $detail = json_decode($request->detail);
        $company = json_decode($request->companys);
        $company = array_map("unserialize", array_unique(array_map("serialize", $company)));
        $detail = array_map("unserialize", array_unique(array_map("serialize", $detail)));
        $bussines = DB::table('bussines')->get();
        $totalVenta = 0;
        //Filtro de sabotage del LocalStorage de parte del Frontend
        foreach($detail as $item){
            $totalVenta = $totalVenta + $item->subtotal;
            if($item->subtotal != ($item->cant * $item->price) || $item->subtotal < 1){
                return redirect('/checkout');
            }
        }
        //Filtro de sabotage del LocalStorage de parte del Frontend
        //Filtro de ID_MP DE TODAS LAS COMPAÑIAS
        $contador = 0;
        $bandera = false;
        $empresasNoRegistradas = [];

        foreach($company as $item){
            $empresa = User::where('id',$item->id)->first();
            if($empresa->id_MP == null){
                $empresasNoRegistradas[$contador] = $empresa;
                $contador++;
                $bandera = true;
            }
        }
        //dd($empresasNoRegistradas[0]->id);
        if($bandera){

            return redirect('/resume')->with(['status' => 301,'companys' => $empresasNoRegistradas]);
        }

        if($request->state_delivery == "1"){
            if($request->departamento != "23"){


                $id_user = session('costumer')->id;
                $recepciones = DB::table('receptions')->where('customer_id', $id_user)->where('state','!=','3')->orderBy('date_reception','desc')->get();
                $i = 1;
                $totalVentasCliente = 0;
                if ($recepciones == null) {
                    $reception=[];
                }
                foreach ($recepciones as $recepcion) {
                    $reception[$i] = DB::table('receptions')
                                            ->join('reception_details','reception_details.order_detail','receptions.pending')
                                            ->join('products','products.id','reception_details.dish_id')
                                            ->join('costumers','costumers.id','receptions.customer_id')
                                            ->where('receptions.pending', $recepcion->pending)
                                            ->where('receptions.id_user', $recepcion->id_user)
                                            ->where('reception_details.id_user_detail',$recepcion->id_user)
                                            ->where('receptions.departament','!=', "23")
                                            ->where('receptions.state_delivery','=', 1)
                                            ->get();

                    foreach($reception[$i] as $item){
                        $totalVentasCliente = $totalVentasCliente + $item->total;
                    }
                    $i = $i + 1 ;

                }
                //dd($recepciones);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://free.currconv.com/api/v7/convert?q=USD_PEN&compact=ultra&apiKey=76717b08f772283d7792",
                    CURLOPT_RETURNTRANSFER => 1
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $response = json_decode($response, true);
                //$conversion = $response["USD_PEN"];
                $limiteCompraTacna = 3000 * 3.64;
                $limiteVenta = ($totalVentasCliente + $totalVenta);
                //$limiteCompraTacna = 3000;
                //$limiteVenta = 3001;
                //dd($limiteCompraTacna,$limiteVenta,$totalVentasCliente, $conversion,$totalVenta);
                if($limiteVenta > $limiteCompraTacna){

                    $status = 300;
                    return redirect('/resume')->with(['status' => $status]);

                }
                else{
                    $limiteRestante = $limiteCompraTacna - $limiteVenta;
                    $limiteTotal = $limiteCompraTacna;
                    $fleg = true;
                }

            }
            if($request->state_delivery_tipo == 1){

                foreach($detail as $item){
                    $item->comision = $item->subtotal * 0.15;
                }
                $comision_delivery = 0.15;
            }
            else{
                foreach($detail as $item){
                    $item->comision = $item->subtotal * 0.2;
                }
                $comision_delivery = 0.2;
            }
            //dd($detail);
        }
        else{
            foreach($detail as $item){
                $item->comision = 0;

            }
            $comision_delivery = 0;
        }
        //dd($detail, $request);
        //FILTRO DE MAXIMO DE COMPRAS POR AÑO




        $request->type_card == 'debito' ? $payment_type_id = "debit_card" : $payment_type_id = "credit_card";
        $parametros = [];
        $i = 0;
		$j = 1;
        $comision = Configuration::first();
        $comision = ($comision->companyPercentage)/100;

        foreach($company as $companys){
            $total = 0;
            foreach($detail as $item){
                if($companys->id == $item->id){
                    $total = $total + $item->subtotal + $item->comision;
                }
            }
            $GM = floatval($total * $comision);
            $parametros[$i] = array(
                "amount" => number_format($total, 2, '.', ''),
                "external_reference" => "ref-collector-$j",
                "collector_id" => $companys->id_MP,
                "application_fee"     => number_format($GM, 2, '.', ''),
				//"application_fee"     => preg_replace("/(?<=\\.[0-9]{2})[0]+\$/","",$GM),
                "money_release_days"   => 30
            );
            $i++;
			$j++;
        }

        // COMPRA POR MERCADO PAGO
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, "https://api.mercadopago.com/v1/advanced_payments?access_token=APP_USR-6444359659263359-081916-1309b389c51f08d43b12ab2d1d279845-626339400");
              $headers = array(
                  'Content-Type:  application/json',
                  'Accept: application/json',
              );

        curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($tuCurl, CURLOPT_POST, true);


        $EMAIL = $request->email;
        $TOKEN = $request->token;
        $PAYMENT_METHOD_ID = $request->payment_method_id;
        $TRANSACTION_AMOUNT = $request->transaction_amount;
        $INSTALLMENTS = $request->installments;


        $parametros2 =
            array(
                       "payer"   =>
                           array(
                               "email" => $EMAIL
                           ),
				  	   "binary_mode" => true,
                       "payments" => array(
                           array(
                               "payment_method_id"     => $PAYMENT_METHOD_ID,
                               "payment_type_id"       => $payment_type_id,
                               "token" => $TOKEN,
                               "transaction_amount"     => number_format($TRANSACTION_AMOUNT, 2, '.', ''),
                               "installments"       => $INSTALLMENTS,
                               "processing_mode" => "aggregator"
                           )),
                           "disbursements" => $parametros,
                          "external_reference"      => "ref-transaction"

            );

		//dd($parametros2);
        curl_setopt($tuCurl, CURLOPT_POSTFIELDS, json_encode($parametros2));
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($tuCurl, CURLOPT_TIMEOUT, 300); //timeout in seconds
        $curl_response = curl_exec($tuCurl);
        curl_close($tuCurl);


        if($curl_response === false){
            $status = 500;
            return redirect('/resume')->with(['status' => $status]);
        }
        else{
           	//dd($comision_delivery);
            $curl_response = json_decode($curl_response);
            //dd($curl_response);
		    /*$advanced_payments_id = $curl_response->id;

			$curl_response = $curl_response->payments;
			$status = $curl_response[0]->status;
			$status_detail = $curl_response[0]->status_detail;*/

			$status_detail = 'accredited';
			$advanced_payments_id = 123456;

            switch($status_detail){
                    case "accredited":

                        $status = 200;
                        $costumer_id = session('costumer')->id;

						if($request->check == 'on'){
                            $card = new Card;

                            $card->id_customer =$costumer_id;
                            $card->number = Crypt::encryptString($request->cardNumber);
                            $card->mounth = Crypt::encryptString($request->cardExpirationMonth);
                            $card->year = Crypt::encryptString($request->cardExpirationYear);
                            $card->cvv = Crypt::encryptString($request->securityCode);
                            $card->name = Crypt::encryptString($request->cardholderName);
                            $card->type_document = Crypt::encryptString($request->docType);
                            $card->document = Crypt::encryptString($request->docNumber);
                            $card->credeb = $request->type_card;

                            $card->type_card = $request->payment_method_id;
                            $card->save();


                        }

                        $date = Carbon::now();
                        $order = New Order;
                        $order->user_id = $costumer_id;
                        $order->date = $date;
                        $order->advanced_payments_id = $advanced_payments_id;
                        $order->save();

						//dd($order);
                        foreach($company as $companys){

                            $pending_data = DB::table('receptions')
                            ->where('id_user','=',$companys->id)
                            ->select('*')
                            ->orderBy('pending','desc')
                            ->take(1)
                            ->first();
                            $pending = $pending_data->pending;
                            $pending = $pending+1;
                            $pedido = new Reception;
                            $pedido->customer_id = $costumer_id;
                            $pedido->id_user = $companys->id;
                            $pedido->pending = $pending;
                            $pedido->date_reception = $date;
                            $pedido->state = "1";
                            if($request->state_delivery == 1){
                                $pedido->longitude = $request->longitud;
                                $pedido->latitude = $request->latitud;
                                $pedido->address = $request->direccion;
                                //$pedido->address = $request->direccion;
                                $pedido->departament = $request->departamento;
                                $pedido->province = $request->provincia;
                                $pedido->district = $request->distrito;

                                //'departament','province','district
                            }
                            else{
                                $pedido->longitude = 0;
                                $pedido->latitude = 0;
                                //$pedido->delivery_type
                            }
                            $pedido->name = $request->nombre;
                            $pedido->last_name = $request->apellido;
                            $pedido->telephone = $request->telefono;
                            $pedido->cellphone = $request->celular;
                            $pedido->address_email = $request->email;
                            $pedido->orders_id = $order->id;
                            $pedido->state_delivery = $request->state_delivery;
                            $pedido->advanced_payments_id = $advanced_payments_id;
                            $pedido->answer1 = 0;
                            $pedido->answer2 = 0;
                            $pedido->state_answer = 0;
                            $pedido->delivery_type = $request->state_delivery_tipo ?? null;
                            $pedido->save();

                            $correo = User::where('id','=',$companys->id)->first();

                            $company = DB::table('users')
                                        ->join('bussines','bussines.id','users.business')
                                        ->join('departamentos','departamentos.id','users.department')
                                        ->join('provincias','provincias._id','users.province')
                                        ->join('distritos','distritos._id','users.district')
                                        ->select('users.company','users.email','users.phone',
                                                'users.address','bussines.name as tipo',
                                                'departamentos.name as departamento',
                                                'provincias.name as provincia',
                                                'distritos.name as distrito')
                                        ->where('users.id','=',$companys->id)->first();
                            if(isset($pedido)){
                                foreach($detail as $item){
                                    if($item->id == $companys->id){
                                        $reception_details = ReceptionDetail::create([
                                            'order_detail' => $pedido->pending,
                                            'dish_id' => $item->product_id,
                                            'quantity' => $item->cant,
                                            'total' => $item->subtotal + $item->comision,
                                            'id_user_detail' => $item->id,
                                            'id_attribute' =>$item->id_attribute,
                                            'id_variation' =>$item->id_variation,
                                            'orders_id' =>$order->id,
                                            'comision' =>$comision_delivery
                                        ]);
                                    }

                                }
                            }

                        }
                        $dni= Costumer::where('id', $costumer_id)->first();
                        isset($request->departamentoNombre) ? $departamento = $request->departamentoNombre : $departamento = false;
                        isset($request->provinciaNombre) ? $provincia = $request->provinciaNombre : $provincia = false;
                        isset($request->distritoNombre) ? $distrito = $request->distritoNombre : $distrito = false;
                        isset($request->direccion) ? $direccion= $request->direccion : $direccion = false;
                        isset($limiteRestante) ? $limiteRestante = $limiteRestante : $limiteRestante = 0;
                        isset($limiteTotal) ? $limiteTotal = $limiteTotal : $limiteTotal = 0;
                        isset($fleg) ? $fleg = $fleg : $fleg = false;
                        //$empresa = 2;
                        $costumer = array(
                            "nombre"         => $request->nombre,
                            "apellido"       => $request->apellido,
                            "celular"        => $request->celular,
                            "telefono"       => $request->telefono,
                            "fleg"           => $fleg,
                            "limiteTotal"    => $limiteTotal,
                            "limiteRestante" => $limiteRestante,
                            "direccion"      => $direccion,
                            "state_delivery" => $request->state_delivery,
                            "departamento"   => $departamento,
                            "provincia"      => $provincia,
                            "distrito"       => $distrito,
                            "email"          => $request->email,
                            "dni"            => $dni->dni
                        );


                        //Envio de EMAIL
                        $asunto = 'Tacna Market Plaza';
                        //PARA EL CLIENTE

                        $i = 0;
                        $company = json_decode($request->companys);
                        $company = array_map("unserialize", array_unique(array_map("serialize", $company)));
                        for($i = 0; $i < count($company); $i++){
                            $result = User::where('users.id','=',$company[$i]->id)->first();
                            $company[$i] = $result;

                        }

                        $mail = new PHPMailer(true);
                        //$mail->SMTPDebug = 0;
                        $mail->SMTPDebug = 2;
                        $mail->isSMTP();
                        /*$mail->Host       = 'mail.tacnamarketplaza.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'soporte@tacnamarketplaza.com';
                        $mail->Password   = '123456789';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port       = 465;*/
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'globalplazamarket@gmail.com';
                        $mail->Password   = 'globalplazamarket2020';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;
                        $mail->setFrom('soporte@tacnamarketplaza.com', 'Tacna Market Plaza');
                        $mail->addAddress($request->email);
                        $mail->isHTML(true);
                        $mail->Subject = $asunto;
                        $mail->Body    = view('frontend.mail.index')->with(compact('detail','company','costumer'));
                        $mail->send();


                        //PARA LOS VENDEDORES
                        foreach($company as $item){
                            $empresa = $item->id;
                            //$costumer_id = session('costumer')->id;
                            $mail = new PHPMailer(true);
                            //$mail->SMTPDebug = 0;
                            $mail->SMTPDebug = 2;
                            $mail->isSMTP();
                            /*$mail->Host       = 'mail.tacnamarketplaza.com';
                            $mail->SMTPAuth   = true;
                            $mail->Username   = 'soporte@tacnamarketplaza.com';
                            $mail->Password   = '123456789';
                            $mail->SMTPSecure = 'ssl';
                            $mail->Port       = 465;*/
                            $mail->Host       = 'smtp.gmail.com';
                            $mail->SMTPAuth   = true;
                            $mail->Username   = 'globalplazamarket@gmail.com';
                            $mail->Password   = 'globalplazamarket2020';
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port       = 587;
                            $mail->setFrom('soporte@tacnamarketplaza.com', 'Tacna Market Plaza');
                            $mail->addAddress($item->email);
                            $mail->isHTML(true);
                            $mail->Subject = $asunto;
                            $mail->Body    = view('frontend.mail.indexCompany')->with(compact('detail','empresa','costumer'));
                            $mail->send();
                            //dd($company,$costumer,$detail);

                        }
                        //dd($status);
                        return redirect('/resume')->with([
                            'orden' => $order->id,
                            'fecha' => date_format($order->date,'Y-m-d'),
                            'status' => $status,
                            'detail' => $detail,
                            'nombre' => $request->nombre,
                            'apellido'=>$request->apellido,
                            'direccion' => $direccion,
                            'email' => $request->email,
                            'telefono' => $request->telefono,
                            'celular' => $request->celular,
                            'departamento' => $departamento,
                            'provincia' => $provincia,
                            'distrito' => $distrito,
                            'limiteRestante' => $limiteRestante,
                            'limiteTotal' => $limiteTotal,
                            'fleg' => $fleg,
                            'dni' => $dni->dni

                        ]);

                    break;

                    case "pending_contingency":
                        $status = 201;
                        $message = "Estamos procesando tu pago.";
                        $detail = "No te preocupes, menos de 2 días hábiles te avisaremos por e-mail si se acreditó o si necesitamos más información.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message, 'detail' => $detail]);
                    break;

                    case "pending_review_manual":
                        $status = 202;
                        $message = "Estamos procesando tu pago.";
                        $detail = "No te preocupes, menos de 2 días hábiles te avisaremos por e-mail si se acreditó o si necesitamos más información.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message, 'detail' => $detail]);
                    break;

                    case "cc_rejected_bad_filled_card_number":
                        $status = 203;
                        $message = "Revisa el número de tarjeta.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message]);
                    break;

                    case "cc_rejected_bad_filled_date":
                        $status = 204;
                        $message = "Revisa la fecha de vencimiento.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message]);
                    break;

                    case "cc_rejected_bad_filled_other":
                        $status = 205;
                        $message = "Revisa los datos.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message]);
                    break;

                    case "cc_rejected_bad_filled_security_code":
                        $status = 206;
                        $message = "CVV Incorrecto";
                        $detail = "Revisa el código de seguridad de la tarjeta.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message, 'detail' => $detail]);
                    break;

                    case "cc_rejected_blacklist":
                        $status = 207;
                        $message = "No pudimos procesar tu pago.";
                        $detail = "Elige otra tarjeta u otro medio de pago.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message, 'detail' => $detail]);
                    break;

                    case "cc_rejected_call_for_authorize":
                        $status = 208;
                        $message = "Debes autorizar a tu banco del monto a pagar.";
                        $detail = "Llame a su proveedor para poder activar tu tarjeta. El teléfono está al dorso de tu tarjeta.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message, 'detail' => $detail]);
                    break;

                    case "cc_rejected_card_disabled":
                        $status = 209;
                        $message = "Su tarjeta requiere activación";
                        $detail = "Llame a su proveedor para poder activar tu tarjeta. El teléfono está al dorso de tu tarjeta.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message, 'detail' => $detail]);
                    break;

                    case "cc_rejected_card_error":
                        $status = 210;
                        $message = "No pudimos procesar tu pago.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message]);
                    break;

                    case "cc_rejected_duplicated_payment":
                        $status = 211;
                        $message = "Si necesitas volver a pagar usa otra tarjeta u otro medio de pago.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message]);
                    break;

                    case "cc_rejected_high_risk":
                        $status = 212;
                        $message = "Tu pago fue rechazado";
                        $detail = "Elige otra tarjeta u otro medio de pago.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message, 'detail' => $detail]);
                    break;

                    case "cc_rejected_insufficient_amount":
                        $status = 213;
                        $message = "Tu tarjeta no tiene fondos suficientes.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message]);
                    break;

                    case "cc_rejected_invalid_installments":
                        $status = 214;
                        $message = "Tu tarjeta no procesa pagos en cuotas.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message]);
                    break;

                    case "cc_rejected_max_attempts":
                        $status = 215;
                        $message = "Llegaste al límite de intentos permitidos";
                        $detail = "Elige otra tarjeta u otro medio de pago.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message, 'detail' => $detail]);
                    break;

                    case "cc_rejected_other_reason":
                        $status = 216;
                        $message = "Tu tarjeta no proceso el pago";
                        $detail = "Contactate con tu proveedor.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message, 'detail' => $detail ]);
                    break;

                    default:
                        $status = 217;
                        $message = "No pudimos procesar tu pago.";
                        return redirect('/resume')->with(['status' => $status,'message' => $message]);
                    break;
            }

        }

    }
    public function searchProvincia(Request $request) {

        $provincias = DB::table('provincias')
                        ->where('provincias.department_id',$request->department_id)
                        ->get();
        return response()->json([ 'provincias' => $provincias]);

    }
    public function searchDistrito(Request $request) {
        $distritos = DB::table('distritos')
                        ->where('distritos.department_id', 'like', '%'. $request->department_id . '%')
                        ->where('distritos.province_id', 'like', '%'. $request->province_id . '%')
                        ->get();
        return response()->json([ 'distritos' => $distritos]);
    }
    public function searchUbicacion(Request $request){
        $ubicacion = DB::table('departamentos')
                    ->join('provincias','departamentos.id','provincias.department_id')
                    ->join('distritos','distritos.province_id','provincias._id')
                    ->select('departamentos.name as departamento_name','provincias.name as provincia_name','distritos.name as distrito_name')
                    ->where('departamentos.id','=',$request->departament_id)
                    ->where('provincias._id','=', $request->province_id)
                    ->where('distritos._id','=',$request->district_id)
                    ->first();
                    return response()->json([ 'departamento' => $ubicacion->departamento_name, 'provincia' => $ubicacion->provincia_name, 'distrito' => $ubicacion->distrito_name]);
    }
    public function viewVisaDevelopment(Request $request) {
        $bussines = DB::table('bussines')->get();
        $users = User::with(['categories'])->get();
        $subcategory  = Classification::groupby('name')->distinct()->get();
        return view('frontend.cart.visa')->with(compact('subcategory','bussines', 'users'));;
    }
    public function  VisaDevelopment(Request $request) {

    }
    public function processPayment($request) {

        $capture = false;
        $code = 'TC50171_3';
         $numberCard = '4111111111111111';

        $expirationMonth = '12';
        $expirationYear = '2031';
        $totalAmount = '100.23';
        $currency = 'USD';

        /*info client */
        $firstName = "John";
        $lastName =  "Doe";
        $address1 = '1 Market St';
        $locality = 'san francisco';
        $administrativeArea = 'CA';
        $postalCode = '94105';
        $country = 'US';
        $email = "test@cybs.com";
        $phoneNumber = "4158880000";


        $clientReferenceInformationArr = [
                "code" => $code
        ];
        $clientReferenceInformation = new CyberSource\Model\Ptsv2paymentsClientReferenceInformation($clientReferenceInformationArr);

        $processingInformationArr = [
                "capture" => $capture
        ];
        $processingInformation = new CyberSource\Model\Ptsv2paymentsProcessingInformation($processingInformationArr);

        $paymentInformationCardArr = [
                "number" => $numberCard,
                "expirationMonth" => $expirationMonth,
                "expirationYear" => $expirationYear
        ];
        $paymentInformationCard = new CyberSource\Model\Ptsv2paymentsPaymentInformationCard($paymentInformationCardArr);

        $paymentInformationArr = [
                "card" => $paymentInformationCard
        ];
        $paymentInformation = new CyberSource\Model\Ptsv2paymentsPaymentInformation($paymentInformationArr);

        $orderInformationAmountDetailsArr = [
                "totalAmount" => $totalAmount,
                "currency" => $currency
        ];
        $orderInformationAmountDetails = new CyberSource\Model\Ptsv2paymentsOrderInformationAmountDetails($orderInformationAmountDetailsArr);

        $orderInformationBillToArr = [
                "firstName" => $firstName,
                "lastName" => $lastName,
                "address1" => $address1,
                "locality" => $locality,
                "administrativeArea" => $administrativeArea,
                "postalCode" => $postalCode,
                "country" => $country,
                "email" => $email,
                "phoneNumber" => $phoneNumber
        ];
        $orderInformationBillTo = new CyberSource\Model\Ptsv2paymentsOrderInformationBillTo($orderInformationBillToArr);

        $orderInformationArr = [
                "amountDetails" => $orderInformationAmountDetails,
                "billTo" => $orderInformationBillTo
        ];
        $orderInformation = new CyberSource\Model\Ptsv2paymentsOrderInformation($orderInformationArr);

        $requestObjArr = [
                "clientReferenceInformation" => $clientReferenceInformation,
                "processingInformation" => $processingInformation,
                "paymentInformation" => $paymentInformation,
                "orderInformation" => $orderInformation
        ];
        $requestObj = new CyberSource\Model\CreatePaymentRequest($requestObjArr);


        $commonElement = new ExternalConfiguration();

        $config = $commonElement->ConnectionHost();
        $merchantConfig = $commonElement->merchantConfigObject();

        $api_client = new CyberSource\ApiClient($config, $merchantConfig);
        $api_instance = new CyberSource\Api\PaymentsApi($api_client);

        try {
            $apiResponse = $api_instance->createPayment($requestObj);
            $body = json_decode($apiResponse[0]);
            return $body;
        } catch (Cybersource\ApiException $e) {
            print_r($e->getResponseBody());
            print_r($e->getMessage());
        }


    }

    public function MercadoPago(){
        $bussines = DB::table('bussines')->get();
        $users = User::with(['categories'])->get();
        $subcategory  = Classification::groupby('name')->distinct()->get();
        return view('frontend.mercado.index')->with(compact('subcategory','bussines', 'users'));
    }


    public function ProcesarPago(Request $request)
     {
       $bussines = DB::table('bussines')->get();
       // dd($request);
       // return view('frontend.mercado.index')->with(compact('bussines'));
       $tuCurl = curl_init();
       curl_setopt($tuCurl, CURLOPT_URL, "https://api.mercadopago.com/v1/advanced_payments?access_token=TEST-510930383220964-081123-9dad3f9fe43694a4be203ab73c5279f2-624594712");
             $headers = array(
                 'Content-Type:  application/json',
                 'Accept: application/json',
             );

       curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($tuCurl, CURLOPT_POST, true);

       // dd($request);
       $EMAIL = $request->email;
       $TOKEN = $request->token;
   $PAYMENT_METHOD_ID = $request->payment_method_id;
       $TRANSACTION_AMOUNT = $request->transaction_amount;
   $INSTALLMENTS = $request->installments;


             $parametros =
                  array(
                      "payer"   =>
                          array(
                              "email" => $EMAIL
                          ),
                      "payments" => array(
                          array(
                              "payment_method_id"     => $PAYMENT_METHOD_ID,
                              "payment_type_id"       => "credit_card",
                              "token" => $TOKEN,
                              "transaction_amount"     => $TRANSACTION_AMOUNT,
                              "installments"       => $INSTALLMENTS,
                              "processing_mode" => "aggregator"
                          )),
                          "disbursements" => array(
                              array(
                                  "amount"     => 50,
                                  "external_reference" => "ref-collector-1",
                                  "collector_id" => 624594794,
                                  "application_fee"     => 3.0,
                                  "money_release_days"   => 30
                              ),
                              array(
                                  "amount"     => 50,
                                  "external_reference" => "ref-collector-1",
                                  "collector_id" => 624956825,
                                  "application_fee"     => 0.7,
                                  "money_release_days"   => 30
                              )
                              ),
                          "external_reference"      => "ref-transaction"

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
           echo 'Curl error: ' . curl_error($tuCurl);
           // $resultadoPull = 'Pull cancelado';
       }else {
          // echo 'salio';
          return $curl_response;
       }

     }

     public function paypalPrueba()
      {
            return view('frontend.mercado.paypalPrueba');
      }


}
