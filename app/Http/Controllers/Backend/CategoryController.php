<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use Auth;

class CategoryController extends Controller
{
  public function index()
  {

        // $classification = Classification::all();
        $classification = Category::orderBy('order_start', 'asc')->where('state_delete',0 )->where('id_user', session('user')->id)->get();

        return view('backend.classification.index')->with(compact('classification'));
  }


  public function searchClasificacion( Request $request )
  {
      $term = $request->term;

      $users = User::where('id', session('user')->id )->first();
      $business = $users->business;
      // $classifications = Category::where('state_delete', 0 )->where('search', 0 )->where('name','LIKE','%'.$term.'%' )->get();
      $classifications = DB::table('categories')->select('categories.name')
        ->join('users', function ($join) use ($business) {
            $join->on('categories.id_user', '=', 'users.id')
                 ->where('users.business','=', $business)
                 ->where('users.id','!=', session('user')->id);
        })->where('categories.state_delete', 0 )->where('categories.search', 0 )->where('categories.name','LIKE','%'.$term.'%' )->get();

      $data = [];
      $a =0;
      foreach ($classifications as $classification) {
        $a = 1;
        $data[] = [
          'label' => $classification->name
        ];
      }

      if ($users->business == 4) {
        $a = 1;
        $data[] = [
          'label' => 'Zapatillas',
        ];
      }

      if ($users->business == 11) {
        $a = 1;
        $data[] = [
          'label' => 'Relojes',
        ];

        $data[] = [
          'label' => 'Joyas',
        ];
      }
      if ($users->business == 10) {
        $a = 1;
        $data[] = [
          'label' => 'Licores',
        ];

        $data[] = [
          'label' => 'Sodas',
        ];

        $data[] = [
          'label' => 'Chocolates',
        ];
      }
      if ( $a == 0) {
        $data[] = [
          'label' => 'Subcategorías no encontradas',
        ];
      }

      return response()->json([
        'datos'=> $data
            ]);
  }

  public function upSearchClasificacion( Request $request )
  {
    $nombre = $request->nombre;

    $subcategoriaExiste =Category::where('name',$nombre )->where('state_delete', 0)->where('id_user', session('user')->id)->get();

    if (!$subcategoriaExiste->isEmpty()) {
      $subcategoria = 1;
    } else {
      $clasificacion = new Category;
      $clasificacion->id_user =  session('user')->id;
      $clasificacion->name = $nombre ; //falta
      $clasificacion->state_delete  = 0 ;
      $clasificacion->search =  1; //falta
      $clasificacion->uuid =  $request->uuid; //falta
      $clasificacion->save();

      $subcategoria = Category::where('uuid',$request->uuid )->where('id_user', session('user')->id)->first();
    }

    return response()->json([
      'datos'=> $subcategoria
          ]);
  }

  public function createClassification()
  {
        return view('backend.classification.createClassification');
  }

  public function upClassification(Request $request)
  {
    $nombre = $request->nombre;

    $subcategoriaExiste =Category::where('name',$nombre )->where('state_delete', 0)->where('id_user', session('user')->id)->get();

    if (!$subcategoriaExiste->isEmpty()) {
      return redirect('/admin/clasificaciones/nuevaClasificacion')->with('status', 'La subcategoría ya existe, ingrese otra subcategoría.');

    } else {
      $clasificacion = new Category;

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
      $clasificacion->search =  0;
      $clasificacion->save();


      return redirect('/admin/clasificaciones');
    }

  }

  public function editClassification($id)
  {
        $classification = Category::find($id);
        return view('backend.classification.editClassification')->with(compact('classification'));
  }

  public function updateClassification(Request $request, $id)
  {
    $nombre = $request->nombre;
    $clasificacion  = Category::where('id', $id)->where('id_user', session('user')->id)->first();

    if ($clasificacion['name'] == $nombre) {
      $clasificacion  = Category::where('id', $id)->where('id_user', session('user')->id)->first();

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
    } else {
      $subcategoriaExiste =Category::where('name',$nombre )->where('state_delete', 0)->where('id_user', session('user')->id)->get();
      if (!$subcategoriaExiste->isEmpty()) {
        return redirect('/admin/clasificaciones/editarClasificacion/'.$id)->with('status', 'La subcategoría ya existe, ingrese otra subcategoría.');
      } else {
        $clasificacion  = Category::where('id', $id)->where('id_user', session('user')->id)->first();

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
    }







  }

  public function deleteClassification(Request $request)
  {
        $id= $request->id_producto;

        $dish = Category::where('id',$id)->where('id_user', session('user')->id)->first();
        // $dish->state_delete = 1;
        $dish->delete();

        // $dish->save();

        return response()->json([
          'datos'=> $id
              ]);
        // return redirect('/admin/clasificaciones');
  }


  public function orderClassification()
  {
        $classification = Category::orderBy('order_start', 'asc')->where('state_delete',0 )->where('id_user', session('user')->id)->get();
        // -------------------------------
        // --------------------------------------------
        $id_user=session('user')->id;
        $carta = DB::SELECT("SELECT  id  FROM categories Where id_user = $id_user and state_delete = 0");
        // dd($carta);
       // $i=1;
       if ($carta  == null) {
         $cartita=[];
         $cart_name=[];
       }
       $i=1;
       foreach ($carta  as $cartas ) {
         $cartita[$cartas->id] = DB::SELECT("SELECT  d.id as d_id, d.name as d_name,cl.id as cl_id,cl.name as cl_name
                                 FROM products d
                                 INNER JOIN categories cl on cl.id=d.id_category
                                 WHERE d.id_category = $cartas->id and d.state_delete = 0");
          $cart_name[$i] = DB::SELECT("SELECT id,name FROM categories WHERE id = $cartas->id and id_user = $id_user");
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

          DB::table('categories')
                  // ->where('cliente_id', $cliente)
                  ->where('name', $lista)->where('id_user', session('user')->id)
                  ->update(['order_start' => $j]);
          $j= $j + 1;
        }
        return redirect('/admin/clasificaciones');
  }

  public function guide()
  {
        return view('backend.classification.guia');
  }


}
