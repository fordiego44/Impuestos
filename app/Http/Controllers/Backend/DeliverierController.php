<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
      if (session('user')->business == 1 || session('user')->business == 3) {
        $deliverier = Deliverier::orderBy('id', 'asc')->where('id_user', session('user')->id)->where('state_delete', 0)->get();
        return view('backend.deliverier.index')->with(compact('deliverier'));
      }

      return redirect('/admin/profile');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDeliverier() 
    {
        if (session('user')->business == 1 || session('user')->business == 3) {
          return view('backend.deliverier.createDeliverier');
        }

        return redirect('/admin/profile');
    }

    public function editDeliverier($id)
    {
        if (session('user')->business == 1 || session('user')->business == 3) {
          $deliverier = Deliverier::where('id',$id)->get();
          return view('backend.deliverier.editDeliverier')->with(compact('deliverier'));
        }

        return redirect('/admin/profile');
    }

    public function deleteDeliverier($id)
    {
          if (session('user')->business == 1 || session('user')->business == 3) {
            $repartidor  = Deliverier::where('id', $id)->where('id_user', session('user')->id)->first();
            $repartidor->state_delete = 1;
            $repartidor->save();
            // $repartidor->delete();

            return redirect('/admin/repartidores');
        }

        return redirect('/admin/profile');
    }

    public function updateDeliverier(Request $request, $id)
    {
        if (session('user')->business == 1 || session('user')->business == 3) {
          $repartidor  = Deliverier::where('id', $id)->where('id_user', session('user')->id)->first();

          if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
            $repartidor->image = $name;
          }

          if($request->hasFile('file2')) {
                $file = $request->file('file2');  //valido el pdf
                $validator = Validator::make(
                                    array(
                                        'file' => $file,
                                    ),
                                    array(
                                        'file' => 'file|max:5000|mimes:pdf,docx,doc',
                                    )
                       );
            //Si no pasa la validacion realizas una accion
              if ($validator->fails()) {
                // dd('no era pdf');
                $url = '/admin/repartidores/editarDeliverier/'.$id;
                return redirect($url)->with('status', 'Profile updated!');

              }else {
                 // dd('si era pdf');
                 $file = $request->file('file2');
                 $name = time().$file->getClientOriginalName();
                 $file->move(public_path().'/images/',$name);
                 $repartidor->pdf_constancia = $name;
              }
          }


          $repartidor->id_user =  session('user')->id;
          $repartidor->name = $request->nombre;
          $repartidor->last_name = $request->apellidos;
          $repartidor->dni = $request->dni;
          $repartidor->direction = $request->direction;
          $repartidor->phone = $request->phone;
          $repartidor->email  = $request->email ;
          // $repartidor->user_name = $request->user_name;

          if ($request->password != null) {
             $repartidor->password  = bcrypt($request->password) ;
          }
          $repartidor->save();

          return redirect('/admin/repartidores');
        }

        return redirect('/admin/profile');
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
      if (session('user')->business == 1 || session('user')->business == 3) {
          // dd($request);
          $repartidor = new Deliverier;
          $repartidor->image = 'repartidor-sample.jpg';
          if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
            $repartidor->image = $name;
          }


              $file = $request->file('file2');  //valido el pdf
              $validator = Validator::make(
                                  array(
                                      'file' => $file,
                                  ),
                                  array(
                                      'file' => 'file|max:5000|mimes:pdf,docx,doc',
                                  )
                     );
          //Si no pasa la validacion realizas una accion
            if ($validator->fails()) {
              // dd('no era pdf');
              return redirect('/admin/repartidores/nuevo-repartidor')->with('status', 'Profile updated!');

            }else {
               // dd('si era pdf');
               $file = $request->file('file2');
               $name = time().$file->getClientOriginalName();
               $file->move(public_path().'/images/',$name);
               $repartidor->pdf_constancia = $name;
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

        return redirect('/admin/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function guide()
     {
        if (session('user')->business == 1 || session('user')->business == 3) {
            return view('backend.deliverier.guia');
          }

          return redirect('/admin/profile');
     }
}
