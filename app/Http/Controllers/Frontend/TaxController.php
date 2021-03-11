<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Storage;
use App\User;

use App\Configuration;
use Carbon\Carbon;
use App\Costumer;
use Illuminate\Support\Facades\Crypt;
Use App\Plugins\Requests\library\Requests;
use Session;
use App\Tax;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Session::has('costumer')) {
          return redirect('/');
        }


            $cliente = session('costumer')->id;
            $usuario = DB::table('costumers')->where('costumers.id','=',$cliente)->first();

            return view('frontend.tax.index')->with(compact( 'usuario'    ));


    }


    public function showTax(Request $request)
    {
              // session('costumer')->id;
           $predio = Tax::where('pedrial_cod', $request->codigo)->first();
           $cliente = Costumer::where('id', session('costumer')->id )->select('dni', 'name', 'last_name', 'email', 'phone', 'telephone')->first();
            return response()->json([
              'respPredio'=> $predio,
              'respCliente'=> $cliente
                  ]);
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
    public function destroy($id)
    {
        //
    }
}
