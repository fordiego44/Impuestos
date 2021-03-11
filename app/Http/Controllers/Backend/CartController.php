<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cart;
use App\Dish;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id_user=session('user')->id;
      $clasification=DB::select("SELECT cl.name, cl.id FROM classifications cl WHERE id_user = $id_user ");
      $dish = Dish::orderBy('id', 'desc')->where('id_user', session('user')->id)->get();
      // --------------------------------------------------------
      $carta = DB::SELECT("SELECT  id  FROM classifications Where id_user = $id_user");
      // dd($carta);
     // $i=1;
     if ($carta  == null) {
       $cartita=[];
       $cart_name=[];
     }
     $i=1;
     foreach ($carta  as $cartas ) {
       $cartita[$cartas->id] = DB::SELECT("SELECT  d.id as d_id, d.name as d_name,cl.id as cl_id,cl.name as cl_name
                               FROM carts c
                               INNER JOIN dishes d on d.id = c.id_dish
                               INNER JOIN classifications cl on cl.id=c.id_clasification
                               WHERE c.id_clasification = $cartas->id");
        $cart_name[$i] = DB::SELECT("SELECT id,name FROM classifications WHERE id = $cartas->id and id_user = $id_user");
        $i = $i +1 ;
     }

     // dd($cart_name);
     // return $cartita;
      // ----------------------------------------------------

       return view('backend.cart.index')->with(compact('dish'))->with(compact('cartita'))->with(compact('cart_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upCart(Request $request)
    {
      if ($request->ajax()) {
                $carta = new Cart;
                $carta->id_user = session('user')->id;
                $carta->id_dish = $request->id_dish;
                $carta->id_clasification = $request->id_classification;

                $carta->save();

                $plato  = Dish::find($request->id_dish);

          return response()->json([
                'plato'               =>$plato,
           ]);
      }
    }



    public function deleteCart(Request $request)
    {
      if ($request->ajax()) {
                $id_user=session('user')->id;
                $cart = Cart::where('id_dish', $request->id_dish)->where('id_clasification', $request->id_clasification)->where('id_user',$id_user );
                $cart->delete();


          return response()->json([
           ]);
      }
    }


    public function store(Request $request)
    {
        //
    }

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
