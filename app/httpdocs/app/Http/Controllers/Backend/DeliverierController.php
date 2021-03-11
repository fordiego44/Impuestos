<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Deliverier;
use Auth;


class DeliverierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $deliverier = Deliverier::orderBy('id', 'asc')->where('id_user', session('user')->id)->where('state_delete', 0)->get();

      return view('backend.deliverier.index')->with(compact('deliverier'));
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
          $deliverier = Deliverier::where('id',$id)->get();
          // return $deliverier;
          return view('backend.deliverier.editDeliverier')->with(compact('deliverier'));
    }

    public function deleteDeliverier($id)
    {
          // return $id;
          $repartidor  = Deliverier::where('id', $id)->where('id_user', session('user')->id)->first();
          $repartidor->state_delete = 1;
          $repartidor->save();

          return redirect('/admin/repartidores');

    }

    public function updateDeliverier(Request $request, $id)
    {

          $repartidor  = Deliverier::where('id', $id)->where('id_user', session('user')->id)->first();

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
          // $repartidor->user_name = $request->user_name;
          //$repartidor->password  = bcrypt($request->password) ;

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
          // $repartidor->user_name = $request->user_name;
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
     public function guide()
     {
       return view('backend.deliverier.guia');
     }
}
