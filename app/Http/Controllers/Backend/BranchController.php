<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Branch;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.branch.index');  
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


     public function deleteBranch(Request $request)
     {
         if ($request->ajax()) {
               $sucursal = Branch::where('id',$request->id_sucursal)->first();
               $sucursal->state_delete = 1;
               $sucursal->delete();
               // $sucursal->save();
               $resultado = 'Eliminado';
               return response()->json([
                 'resultado'=>$resultado
                     ]);
         }
     }

    public function upBranch(Request $request)
    {
      if ($request->ajax()) {

            // return $request->file;
            $now = new \DateTime();
            $sucursal = new Branch;
            $sucursal->id_user =  session('user')->id;
            $sucursal->address = $request->direccion;
            $sucursal->latitude = $request->latitud;
            $sucursal->longitude = $request->longitud;
            $sucursal->state_delete  = 0;
            $sucursal->date_creation = $now;
            $sucursal->save();

            // $atributo = DB::SELECT("SELECT * FROM branches Where date_creation = $now and id_user = $user");
            $atributo = Branch::where('date_creation', '=', $now)->first();

            // return redirect('/admin/platos');
            $resultado='subido';
              return response()->json([
                'resultado'=>$resultado,
                'atributo'=>$atributo
                    ]);
        }
    }

    public function showBranch(Request $request)
    {
      if ($request->ajax()) {

            // return $request->file;
            $user= session('user')->id;
            $atributo = DB::SELECT("SELECT * FROM branches Where state_delete = 0 and id_user = $user");

              return response()->json([
                'atributo'=>$atributo
                    ]);
        }
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
