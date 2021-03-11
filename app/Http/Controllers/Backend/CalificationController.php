<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;

class CalificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (session('user')->business == 1 || session('user')->business == 3) {

      $id_user=session('user')->id;
      $califications =  DB::SELECT("SELECT  r.pending, r.deliverier_id,d.name,d.last_name, r.answer1, r.answer2, r.state_answer
        FROM receptions r
        INNER JOIN deliveriers d on d.id=r.deliverier_id
        WHERE  r.state = 2 and r.id_user = $id_user and r.state_delivery= '1' and r.state_answer = '1' ORDER BY r.date_reception DESC");

      return view('backend.calification.index')->with(compact('califications'));
    }

    return redirect('/admin/profile');

    }

    public function showVaccine()
    {
      if (session('user')->business == 1 || session('user')->business == 3) {

          $id_user=session('user')->id;
          $califications =  DB::SELECT("SELECT  p.dni, p.name, p.last_name_mother, p.last_name_father,p.sexo, p.age, p.v1, p.v2, p.v3, p.v4, p.v5, p.v6, p.v7, p.v8, p.v9, p.v10, p.v11,
            p.v12, p.v13, p.v14, p.v15, p.v16, p.v17, p.v18, p.v19, p.v20, p.v21
            FROM patient p
            WHERE  p.state_delete = 0 ORDER BY p.fecha ASC");

          return view('backend.calification.index2')->with(compact('califications'));
        }

    // return redirect('/admin/profile');

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
