<?php

namespace App\Http\Controllers\BackEnd; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classification;
use App\Dish;
use Auth;


class DishController extends Controller
{
  public function index()
  {
        // $dish = Dish::all();
        // where('id', $id)->where('id_user', session('user')->id)->first();

        $dish = Dish::orderBy('id', 'desc')->where('state_delete',0 )->where('id_user', session('user')->id)->get();
        return view('backend.dish.index')->with(compact('dish'));
  }

  public function createDish()
  {
        // $dish = Dish::all();
        $category = Classification::orderBy('id', 'desc')->where('id_user', session('user')->id)->get();
        return view('backend.dish.createDish')->with(compact('category'));
  }

  public function upDish(Request $request)
  {
        // return $request;

        $plato = new Dish;

        if($request->hasFile('file')) {
          $file = $request->file('file');
          $name = time().$file->getClientOriginalName();
          $file->move(public_path().'/images/',$name);
          $plato->image = $name;
        }
        $plato->id_user =  session('user')->id;

        $plato->name = $request->nombre;
        $plato->description = $request->descripcion;
        $plato->id_category = $request->categoria;
        $plato->time_delay = $request->tiempo;
        $plato->price = $request->precio;
        $plato->state_delete  = 0 ;
        $plato->save();

        return redirect('/admin/platos');
  }

  public function editDish($id)
  {
        $dish = Dish::find($id);

        $category = Classification::orderBy('id', 'desc')->where('id_user', session('user')->id)->get();
        return view('backend.dish.editDish')->with(compact('dish'))->with(compact('category'));
  }

  public function updateDish(Request $request, $id)
  {
        // return $request;
        $plato  = Dish::where('id', $id)->where('id_user', session('user')->id)->first();

        if($request->hasFile('file')) {
          $file = $request->file('file');
          $name = time().$file->getClientOriginalName();
          $file->move(public_path().'/images/',$name);
          $plato->image = $name;
        }

        $plato->name = $request->nombre;
        $plato->description = $request->descripcion;
        $plato->id_category = $request->categoria;
        $plato->time_delay = $request->tiempo;
        $plato->price = $request->precio;
        $plato->save();

        return redirect('/admin/platos');
  }

  public function deleteDish($id)
  {
        $dish = Dish::where('id',$id)->where('id_user', session('user')->id)->first();
        $dish->state_delete = 1;
        // $dish->delete();
        $dish->save();

        return redirect('/admin/platos');
  }

}
