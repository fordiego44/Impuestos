<?php

namespace App\Http\Controllers\BackEnd;
//namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Vehicle;
use Auth;
use App\Deliverier;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function index()
    {
        $vehicles = Vehicle::orderBy('id', 'desc')->where('user', session('user')->id)->get();
        return view('backend.vehicle.index')->with(compact('vehicles'));
    }

    public function editvehicle($id){

        $vehicle = Vehicle::find($id);
        $deliverys = Deliverier::orderBy('id', 'desc')->where('id_user', session('user')->id)->get();
        return view('backend.vehicle.edit-vehicle')->with(compact('vehicle'))->with(compact('deliverys'));
    }

    public function newvehicle(){

        $deliverys = Deliverier::orderBy('id', 'desc')->where('id_user', session('user')->id)->get();
        //return view('backend.vehicle.create-vehicle');
        return view('backend.vehicle.create-vehicle')->with(compact('deliverys'));
    }

    public function newvehiclesave(Request $request){

        $vehicle = new Vehicle;
        $user = session('user')->id;
        $vehicle->user = $user;
        $vehicle->delivery = $request->deliverys;
        $vehicle->plaque=$request->plaque;
        $vehicle->type=$request->type;
        $vehicle->license=$request->license;
        $vehicle->category=$request->category;
        $vehicle->mark=$request->mark;
        $vehicle->model=$request->model;
        $vehicle->soat=$request->soat;
        $vehicle->vehicleserie=$request->serie;
        $vehicle->description=$request->description;
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
            $vehicle->vehiclephoto = $name;
          }
        //$vehicle->=$request->;

        $vehicle->save();

        return redirect('/admin/vehicle');
        //return view('backend.vehicle.create-vehicle');
    }
    public function updatevehicle(Request $request, $id){

        $vehicle = Vehicle::find($id);
        //$vehicle->user = $user;
        $vehicle->plaque=$request->plaque;
        $vehicle->type=$request->type;
        $vehicle->delivery = $request->deliverys;
        $vehicle->license=$request->license;
        $vehicle->category=$request->category;
        $vehicle->mark=$request->mark;
        $vehicle->model=$request->model;
        $vehicle->soat=$request->soat;
        $vehicle->vehicleserie=$request->serie;
        $vehicle->description=$request->description;
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
            $vehicle->vehiclephoto = $name;
          }
        //$vehicle->=$request->;

        $vehicle->save();
        return redirect('/admin/vehicle');
    }
    public function deletevehicle($id){
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        return redirect('/admin/vehicle');
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
     public function guide()
     {
         return view('backend.vehicle.guia');
     }
}
