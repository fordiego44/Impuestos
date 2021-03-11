<?php

//namespace App\Http\Controllers;
namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Gallery;
use App\Days;
use Illuminate\Support\Str;


class UserController extends Controller
{

    /*public function createdays() {
        $usuario = session('user')->email;
        $day = New Days;
        $day->user= $usuario;
        $day->save();
        return redirect('/admin/profile');
    }*/
    public function index() {

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

        $usuario = session('user')->id;
        $user = User::where('id', session('user')->id)->first();
        $day = Days::where('user',$usuario)->get();
        $gallery = Gallery::where('user',$usuario)->get();

        $departaments = DB::table('departamentos')
                        ->get();



            $provincias = DB::table('provincias')
                        ->where('provincias.department_id', 'like', '%23%')
                        ->get();


            if ($user->province != null) {
              $distritos = DB::table('distritos')
                          ->where('distritos.province_id', 'like', '%'. $user->province . '%')
                          ->where('distritos.department_id','=',23)
                          ->get();
            } else {
              $distritos = DB::table('distritos')
                          ->where('distritos.province_id', 'like', '%2301%')
                          ->where('distritos.department_id','=',23)
                          ->get();
            }


        return view('backend.user.index')->with(compact('user','day','gallery','departaments', 'provincias', 'distritos'));
    }
    public function listDepartamento(Request $request) {
        $departamentos = DB::table('departamentos')->get();
        return response()->json([ 'departamentos' => $departamentos]);
    }
    public function filterProvincia(Request $request) {

        $provincias = DB::table('provincias')
                        ->where('provincias.department_id',$request->department_id)
                        ->get();
        return response()->json([ 'provincias' => $provincias]);

    }
    public function filterDistrito(Request $request) {
        $distritos = DB::table('distritos')
                        ->where('distritos.department_id', 'like', '%'. $request->department_id . '%')
                        ->where('distritos.province_id', 'like', '%'. $request->province_id . '%')
                        ->get();
        return response()->json([ 'distritos' => $distritos]);
    }
    public function galeriaprueba(){

        $usuario = session('user')->id;
        $galeria = Gallery::where('user',$usuario)->get();

        return response()->json([

          'galeria' => $galeria
        ]);

    }
    public function gallerydelete(Request $request){

        if ($request->ajax()) {

            $user = session('user')->id;
            $cart = Gallery::where('image', $request->image)->where('user',$user);
            $cart->delete();


            return response()->json(['image'=>$request->image]);
        }

    }
    public function photos(){



            $user = session('user')->id;
            $photos = Gallery::where('user',$user)->get();
            //$cart->delete();


            return response()->json(['photos'=>$photos]);


    }
    public function update(Request $request){

        if ($request->ajax()) {

            $user = User::find($request->id);

            if($request->hasFile('file')) {
                $file = $request->file('file');
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/',$name);
                $user->image = $name;
            }

            $slug = Str::slug($request->company, '-');
            $user->name = $request->name;
            $user->last_name = $request->lastname;
            $user->company = $request->company;
            $user->phone = $request->phone;
            $user->cellphone = $request->cellphone;
            $user->email_susti = $request->email;
            $user->dni = $request->dni;
            $user->ruc = $request->ruc;
            $user->slug = $slug;
            $user->bank_account = $request->bank;

            $user->district = $request->district;
            $user->province = $request->province;
            $user->department = $request->department;

            $user->description = $request->description;

            $user->save();
            return response()->json([ 'user' => $user]);
            //return redirect('/admin/profile');
            //return view('backend.user.index');

        }


    }

    public function UpdateUbication(Request $request){

        $user = User::where('id','=',session('user')->id)->first();
            $user->latitude = $request->latitud;
            $user->longitude =$request->longitud;
            $user->address=$request->direccion;

            $user->save();

            $resultado = "Resultado";
            return response()->json([
              'resultado'=>$resultado
                  ]);

    }

    public function UpdateDays(Request $request){


        $id = session('user')->id;
        //$id = '8';
        $user = Days::where('user',"=",$id)->first();

        $user->monday1 = $request->monday1;
        $user->monday2 = $request->monday2;
        $user->tuesday1 = $request->tuesday1;
        $user->tuesday2 = $request->tuesday2;
        $user->wednesday1 = $request->wednesday1;
        $user->wednesday2 = $request->wednesday2;
        $user->thursday1 = $request->thursday1;
        $user->thursday2 = $request->thursday2;
        $user->friday1 = $request->friday1;
        $user->friday2 = $request->friday2;
        $user->saturday1 = $request->saturday1;
        $user->saturday2 = $request->saturday2;
        $user->sunday1 = $request->sunday1;
        $user->sunday2 = $request->sunday2;

        $user->save();
        return response()->json([

            'sucess' => 'se cambio correctamente'
        ]);
        //return redirect('/admin/profile');
       // return view('backend.user.index');
    }

    public function UploadPhotos(Request $request){

        $id = session('user')->id;

            $imagen = $request->file('file');
            //dd($imagen);

                //$name = time().$imagenes->getClientOriginalName();
                $name = $imagen->getClientOriginalName();
                $imagen->move(public_path().'/images/',$name);

                $img = new Gallery;
                $img->user = $id;
                $img->image = $name;
                $img->save();

        /*$imagenProducto = new ProductImage;
        $imagenProducto->id_product = $request->producto;

        $file = $request->file('file');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/',$name);
        $imagenProducto->route_name = $name;
        $imagenProducto->name = $request->name;
        $imagenProducto->filesize = $request->filesize;
        $imagenProducto->uuid = $request->uuid;

        $imagenProducto->save();*/
        //return redirect('/admin/profile');
        //return view('backend.user.index');
    }


    public function deletePhoto($image){

        $id = session('user')->id;
        $delete = Gallery::where('image', $image)->where('user', $id);
        $delete->delete();

        return redirect('/admin/profile/gallery');
    }
    public function Gallery(){
        $usuario = session('user')->id;
        $gallery = Gallery::where('user',$usuario)->get();
        return view('backend.gallery.index')->with(compact('gallery'));


    }
    public function state(Request $request){

        $id = session('user')->id;
        $user = User::find($id);
        $user->state = $request->estado;

        $user->save();
        return response()->json([

            'sucess' => 'se cambio correctamente'
        ]);

    }
    public function panel(){
        $restaurantes= DB::select("SELECT DISTINCT * FROM users LIMIT 6" );
        return view('index')->with(compact('restaurantes'));
    }
    public function reniec(Request $request) {
        $data = file_get_contents("https://dniruc.apisperu.com/api/v1/".$request->tipo."/".$request->numero."?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InRlc3QudmFjYWNpb25lcy5kb3NAZ21haWwuY29tIn0.mF4K3N3wdgcvyiOpRp4WavBvGZF5LqMn8vsU07cQ-68");

        $info = collect(json_decode($data));


        if ($request->tipo == 'dni') {
            return response()->json(['user'=> $info, 'type' => 'dni']);
        } else {
            if(isset($info['departamento'])) {
                $departamentos = DB::table('departamentos')
                            ->where('departamentos.name', 'like', '%'. $info['departamento'] . '%')
                            ->first();

                $provincias = DB::table('provincias')
                            ->where('provincias.name', 'like', '%'. $info['provincia'] . '%')
                            ->where('provincias.department_id', 'like', '%'. $departamentos->id . '%')
                            ->first();
                $distritos = DB::table('distritos')
                            ->where('distritos.name', 'like', '%'. $info['distrito'] . '%')
                            ->where('distritos.department_id', 'like', '%'. $departamentos->id . '%')
                            ->where('distritos.province_id', 'like', '%'. $provincias->_id . '%')
                            ->first();

              return response()->json(['user'=> $info, 'departament' => $departamentos, 'province' => $provincias, 'district' => $distritos, 'type' => 'ruc']);

            } else {
                return response()->json(['user'=> $info, 'type' => 'ruc2']);
            }

        }

    }

}
