<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Message;
use App\Reception;
use App\Events\PublicMessage;
use App\Costumer;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Classification;

require_once __DIR__ .'/phpmailer/Exception.php';
require_once __DIR__ .'/phpmailer/PHPMailer.php';
require_once __DIR__ .'/phpmailer/SMTP.php';


class ChatController extends Controller
{
     
    
    public function create(Request $request) { 

        $costumer = session()->get('costumer');  
        $message = Message::create([
            'from' => $request->from,
            'to' => $request->to,
            'costumer_id' => $request->costumer_id,
            'user_id' => $request->user_id,
            'reception_id' => $request->reception_id,  
            'order_id' => $request->order_id,
            'message' => $request->message

           
        ]);  
        
        $message->save(); 
        $reception = Reception::with(['detail', 'messages', 'user' ])->where('id', $request->reception_id)->first();
        $costumer = Costumer::where('id', $request->costumer_id)->first();  
     //   $this->sendMail($costumer->email, $reception, $reception->user, $reception->user, $message ); 
        return response()->json(['status' => 200]); 
    }
    public function sendMail( $to, $reception, $costumer, $user, $message ) {
        
                $asunto = 'Tacna Market Plaza'; 
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'globalplazamarket@gmail.com';
                $mail->Password   = 'globalplazamarket2020';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
                $mail->Port       = 587; 
                $mail->setFrom('globalplazamarket@gmail.com', 'Global Plaza Market');
                $mail->addAddress($to);
                $mail->isHTML(true);
                $mail->Subject = $asunto;
                $mail->Body    = view('frontend.mail.messageUser')->with(compact('reception','costumer', 'user', 'message'));
                $mail->send();
        
    }
}
