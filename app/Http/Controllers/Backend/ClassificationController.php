<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Classification;
use Auth;
class ClassificationController extends Controller
{
  public function index()
  {
        // $classification = Classification::all();
          $classification = Classification::orderBy('order_start', 'asc')->where('state_delete',0 )->where('id_user', session('user')->id)->get();


        return view('backend.classification.index')->with(compact('classification'));
  }

  public function createClassification()
  {
        return view('backend.classification.createClassification');
  }

  public function upClassification(Request $request)
  {

        $clasificacion = new Classification;

        if($request->hasFile('file')) {
          $file = $request->file('file');
          $name = time().$file->getClientOriginalName();
          $file->move(public_path().'/images/',$name);
          $clasificacion->image = $name;
        }

        $clasificacion->id_user =  session('user')->id;
        $clasificacion->name = $request->nombre;
        $clasificacion->state_delete  = 0 ;
        $clasificacion->description = $request->descripcion;
        $clasificacion->save();


        return redirect('/admin/clasificaciones');
  }

  public function editClassification($id)
  {
        $classification = Classification::find($id);
        return view('backend.classification.editClassification')->with(compact('classification'));
  }

  public function updateClassification(Request $request, $id)
  {

        $clasificacion  = Classification::where('id', $id)->where('id_user', session('user')->id)->first();

        if($request->hasFile('file')) {
          $file = $request->file('file');
          $name = time().$file->getClientOriginalName();
          $file->move(public_path().'/images/',$name);
          $clasificacion->image = $name;
        }

        $clasificacion->name = $request->nombre;
        $clasificacion->description = $request->descripcion;
        $clasificacion->save();

        return redirect('/admin/clasificaciones');
  }

  public function deleteClassification($id)
  {
        $dish = Classification::where('id',$id)->where('id_user', session('user')->id)->first();
        $dish->state_delete = 1;
        // $dish->delete();

        $dish->save();

        return redirect('/admin/clasificaciones');
  }


  public function orderClassification()
  {
        $classification = Classification::orderBy('order_start', 'asc')->where('state_delete',0 )->where('id_user', session('user')->id)->get();
        // -------------------------------
        // --------------------------------------------
        $id_user=session('user')->id;
        $carta = DB::SELECT("SELECT  id  FROM classifications Where id_user = $id_user and state_delete = 0");
        // dd($carta);
       // $i=1;
       if ($carta  == null) {
         $cartita=[];
         $cart_name=[];
       }
       $i=1;
       foreach ($carta  as $cartas ) {
         $cartita[$cartas->id] = DB::SELECT("SELECT  d.id as d_id, d.name as d_name,cl.id as cl_id,cl.name as cl_name
                                 FROM dishes d
                                 INNER JOIN classifications cl on cl.id=d.id_category
                                 WHERE d.id_category = $cartas->id");
          $cart_name[$i] = DB::SELECT("SELECT id,name FROM classifications WHERE id = $cartas->id and id_user = $id_user");
          $i = $i +1 ;
       }
       // dd($cartita);

        // return view('backend.cart.index')->with(compact('dish'))->with(compact('cartita'))->with(compact('cart_name'));
        // ------------------------------------------------

        // ------------------------------
        return view('backend.classification.order')->with(compact('classification'))->with(compact('cartita'))->with(compact('cart_name'));
  }

  public function upOrderClassification(Request $request)
  {

        $i = count($request['orden']);
        // return $i;
        $j=1;
        foreach ($request['orden'] as $lista) {

          DB::table('classifications')
                  // ->where('cliente_id', $cliente)
                  ->where('name', $lista)->where('id_user', session('user')->id)
                  ->update(['order_start' => $j]);
          $j= $j + 1;
        }
        return redirect('/admin/clasificaciones');
  }






}
