<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
 use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Admin;

use App\Classification;
use App\Costumer;
use App\ValidatorCustom;
use App\Deliverier;
use App\Days;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->oValidator = new ValidatorCustom();

        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $validator = $this->oValidator->validateLogin($request);
        $errors = new \stdClass();

        if (isset($validator->email) || isset($validator->password) || isset($validator->email_register))  {
            return response()->json(['status' => 500, 'errors'=> $validator]);
        } else {
            $user = User::where('email', $request->email)->first();
            if(isset($user)) {
                if (Hash::check($request->password, $user->password)) {
                    session(['user' => $user]);
                    return response()->json(['status'=> 200 ]);
                } else {
                    $errors->password = 'La contraseña es invalida';
                    return response()->json(['status' => 500, 'errors' => $errors]);
                }
            } else {
                $errors->email = 'El email no esta registrado';
                return response()->json(['status' => 500, 'errors' => $errors]);
            }
        }

    }
    public function register(Request $request) {
        $validator = $this->oValidator->validateRegister($request);
        $errors = new \stdClass();

        if (isset($validator->email_register) || isset($validator->names) || isset($validator->lastnames) ||  isset($validator->email) || isset($validator->password) || isset($validator->password_confirmation) ||  isset($validator->password_equal)) {

            return response()->json(['status' => 500, 'errors'=> $validator]);
        } else {
            if (isset($validator->phone)) {
                if (isset($validator->cellphone)) {
                    return response()->json(['status' => 500, 'errors'=> $validator]);

                } else {
                    $user = User::create([
                        'name' => $request->names,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'last_name' => $request->lastnames,
                        'password' => bcrypt($request->password),
                        'business' => $request->business,
                    ]);

                    $day = New Days;
                    $day->user= $user->id;
                    $day->save();
                    return response()->json(['status'=> 200, 'costumer' => $user]);

                }

            } else {
                if (isset($validator->cellphone)) {
                    $user = User::create([
                        'name' => $request->names,
                        'email' => $request->email,
                        'last_name' => $request->lastnames,
                        'cellphone' => $request->cellphone,
                        'password' => bcrypt($request->password),
                        'business' => $request->business,
                    ]);
                    $day = New Days;
                    $day->user= $user->id;
                    $day->save();
                    return response()->json(['status'=> 200, 'costumer' => $user]);

                } else {
                    $user = User::create([
                        'name' => $request->names,
                        'email' => $request->email,
                        'cellphone' => $request->cellphone,
                        'phone' => $request->phone,
                        'last_name' => $request->lastnames,
                        'password' => bcrypt($request->password),
                        'business' => $request->business,
                    ]);
                    $day = New Days;
                    $day->user= $user->id;
                    $day->save();
                    return response()->json(['status'=> 200, 'costumer' => $user]);

                }
            }


        }
    }
    public function loginRepartidor (Request $request) {
        $validator = $this->oValidator->validateLoginRepartidor($request);
        $errors = new \stdClass();

        if (isset($validator->email) || isset($validator->password) || isset($validator->email_register ))  {
            return response()->json(['status' => 500, 'errors'=> $validator]);
        } else {
            $deliever = Deliverier::where('email', $request->email)
                                  ->where('state_delete', 0)
                                  ->first();

            if(isset($deliever)) {
                if (Hash::check($request->password, $deliever->password)) {
                    session(['deliverier' => $deliever]);
                    return response()->json(['status'=> 200, 'deliverier' => $deliever ]);
                }else {
                    $errors->password = 'La contraseña es invalida';
                    return response()->json(['status' => 500, 'errors' => $errors]);
                }

            } else {
                $errors->email = 'El email no esta registrado o inhabilitado';
                return response()->json(['status' => 500, 'errors' => $errors]);
            }
        }
    }
    public function loginAdmin (Request $request) {
        $validator = $this->oValidator->validateLoginAdmin($request);
        $errors = new \stdClass();

        if (isset($validator->email) || isset($validator->password) || isset($validator->email_register ))  {
            return response()->json(['status' => 500, 'errors'=> $validator]);
        } else {
            $admin = Admin::where('email', $request->email)->first();
            if(isset($admin)) {
                if (Hash::check($request->password, $admin->password)) {
                    session(['admin' => $admin]);
                    return response()->json(['status'=> 200, 'admin' => $admin ]);
                }else {
                    $errors->password = 'La contraseña es invalida';
                    return response()->json(['status' => 500, 'errors' => $errors]);
                }
            } else {
                $errors->email = 'El email no esta registrado';
                return response()->json(['status' => 500, 'errors' => $errors]);
            }
        }
    }
    public function viewRegister(){
        return view('auth.register');
    }

    public function viewLogin(){
        $bussines = DB::table('bussines')->get();
        $users = User::with(['categories'])->get();
        $subcategory = Classification::groupby('name')->distinct()->get();
        return view('auth.login')->with(compact('subcategory','bussines', 'users'));
    }

    public function viewLoginRepartidor(){
        $bussines = DB::table('bussines')->get();
        $users = User::with(['categories'])->get();
        $subcategory = Classification::groupby('name')->distinct()->get();
        return view('auth.login-repartidor')->with(compact('subcategory','bussines', 'users'));
    }
    public function viewLoginAdmin() {
        $bussines = DB::table('bussines')->get();
        $users = User::with(['categories'])->get();
        $subcategory = Classification::groupby('name')->distinct()->get();
        return view('auth.login-admin')->with(compact('subcategory','bussines', 'users'));
    }
    public function logout(Request $request){
        $request->session()->forget('user');
        $request->session()->flush();
        return redirect('/login');
    }
    public function logoutAdmin(Request $request){
        $request->session()->forget('admin');
        $request->session()->flush();
        return redirect('/login-admin');
    }
}
