<?php

namespace App\Http\Controllers\Deliverier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Deliverier;
use Auth;
use App\Http\Controllers\Deliverier\DeliverierController;


class DeliverierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        // return session('deliverier')->name ;
        $name = session('deliverier')->name;
        $last_name = session('deliverier')->last_name;

        return view('backend.deliverierReception.dashboard')->with(compact('name'))->with(compact('last_name'));
      //
      // // ->where('id_user', session('user')->id)
      // $deliverier = Deliverier::orderBy('id', 'asc')->where('state_delete', 0)->get();
      //
      // return view('backend.deliverier.index')->with(compact('deliverier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDeliverier()
    {
        return view('backend.deliverier.createDeliverier');
    }

    public function editDeliverier($id)
    {
          $deliverier = Deliverier::where('dni',$id)->get();
          // return $deliverier;
          return view('backend.deliverier.editDeliverier')->with(compact('deliverier'));
    }

    public function deleteDeliverier($id)
    {

          // $dish = Classification::where('id',$id)->where('id_user', session('user')->id)->first();
          // $dish->delete();
          //
          // return redirect('/admin/clasificaciones');
          $repartidor  = Deliverier::where('dni', $id)->where('id_user', session('user')->id)->first();
          $repartidor->state_delete = 1;
          $repartidor->save();

          return redirect('/admin/repartidores');

    }

    public function updateDeliverier(Request $request, $id)
    {

          $repartidor  = Deliverier::where('dni', $id)->where('id_user', session('user')->id)->first();

          if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
            $repartidor->image = $name;
          }
          $repartidor->id_user =  session('user')->id;
          $repartidor->name = $request->nombre;
          $repartidor->last_name = $request->apellidos;
          $repartidor->dni = $request->dni;
          $repartidor->direction = $request->direction;
          $repartidor->phone = $request->phone;
          $repartidor->email  = $request->email ;
          $repartidor->user_name = $request->user_name;
          $repartidor->password  = bcrypt($request->password) ;

          $repartidor->save();

          return redirect('/admin/repartidores');
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

    }


    public function upDeliverier(Request $request)
    {
          // return $request;

          $repartidor = new Deliverier;
          $repartidor->image = 'repartidor-sample.jpg';
          if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
            $repartidor->image = $name;
          }
          $repartidor->id_user =  session('user')->id;
          $repartidor->name = $request->nombre;
          $repartidor->last_name = $request->apellidos;
          $repartidor->dni = $request->dni;
          $repartidor->direction = $request->direction;
          $repartidor->phone = $request->phone;
          $repartidor->email  = $request->email ;
          $repartidor->state_delete  = 0 ;
          $repartidor->state_deliver = 0 ;
          $repartidor->user_name = $request->user_name;
          $repartidor->password  = bcrypt($request->password) ;

          $repartidor->save();

          return redirect('/admin/repartidores');
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
