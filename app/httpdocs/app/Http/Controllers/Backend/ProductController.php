<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
// use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
// use App\Imports\ExcelImport;
use Illuminate\Http\Request;
use App\Variation;
use App\Attribute;
use App\Category;
use App\Product;
use Auth;

// use App\Libreria\PHPExcel\Classes\PHPExcel;
use App\Libreria\PHPExcel\Classes\PHPExcel\IOFactory ;
// require_once __DIR__ .'/PHPexcel/Classes/PHPExcel.php';
// require 'PHPExcel/Classes/PHPExcel/IOFactory.php';
// include_once('../../../Libreria/PHPExcel/Classes/PHPExcel/IOFactory.php');

class ProductController extends Controller
{
  public function index()
  {
        // $dish = Dish::all();
        // where('id', $id)->where('id_user', session('user')->id)->first();
        // return   __DIR__ .'/maatwebsite/excel/src/ExcelServiceProvider.php';
        $dish = Product::orderBy('id', 'desc')->where('state_delete',0 )->where('id_user', session('user')->id)->get();
        return view('backend.dish.index')->with(compact('dish'));
  }

  public function createDish()
  {
        // $dish = Dish::all();
        $category = Category::orderBy('id', 'desc')->where('id_user', session('user')->id)->where('state_delete', 0)->get();
        return view('backend.dish.createDish')->with(compact('category'));
  }

  public function upDish(Request $request)
  {
      if ($request->ajax()) {

            // return $request->file;

            $plato = new Product;

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
            $plato->price = $request->precio;
            $plato->state_delete  = 0 ;
            $plato->time_delay = $request->tiempo;
            $plato->slug  = strtr($request->nombre, " ", "-");
            $plato->save();

            $recenGenerate = Product::orderBy('id', 'desc')->where('name',$request->nombre)->where('id_user', session('user')->id)->take(1)->get();

            // return redirect('/admin/platos');
            $resultado='up';
              return response()->json([
                'recenGenerate'=>$recenGenerate,
                'resultado'=>$resultado
                    ]);
        }
  }

  public function upAttribute(Request $request)
  {
      if ($request->ajax()) {

            $atributo = new Attribute;
            $atributo->id_product = $request->id_producto;
            $atributo->name = $request->nombre;
            $atributo->value = $request->valor;
            $atributo->variation = $request->variacion;
            $atributo->state_delete  = 0;
            $atributo->save();

              return response()->json([
                'nombre'=> $request->nombre,
                'valor'=> $request->valor,
                'variacion'=> $request->variacion
                    ]);
        }
  }

  public function editDish($id)
  {
        $dish = Product::find($id);

        $category = Category::orderBy('id', 'desc')->where('id_user', session('user')->id)->where('state_delete', 0)->get();
        return view('backend.dish.editDish')->with(compact('dish'))->with(compact('category'));
  }

  public function updateDish(Request $request)
  {
        if ($request->ajax()) {
              $plato  = Product::where('id', $request->id_producto)->where('id_user', session('user')->id)->first();

              if($request->hasFile('file')) {
                $file = $request->file('file');
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/',$name);
                $plato->image = $name;
              }

              $plato->name = $request->nombre;
              $plato->slug  = strtr($request->nombre, " ", "-");
              $plato->description = $request->descripcion;
              $plato->id_category = $request->categoria;
              $plato->time_delay = $request->tiempo;
              $plato->price = $request->precio;
              $plato->save();

              $recenGenerate = $request->id_producto;
              $resultado = 'update';
              // return redirect('/admin/platos');

                return response()->json([
                  'recenGenerate'=>$recenGenerate,
                  'resultado'=>$resultado
                      ]);
        }
  }

  public function deleteDish($id)
  {
        $dish = Product::where('id',$id)->where('id_user', session('user')->id)->first();
        $dish->state_delete = 1;
        // $dish->delete();
        $dish->save();

        return redirect('/admin/productos');
  }

  public function deleteAttribute(Request $request)
  {
      if ($request->ajax()) {
            $atributo = Attribute::where('id_product',$request->id_producto)->where('name',$request->nombre)->first();
            $atributo->state_delete = 1;
            // $dish->delete();
            $atributo->save();

            return response()->json([
              'resultado'=> $request->id_producto
                  ]);
      }
  }

  public function showAttribute(Request $request)
  {
      if ($request->ajax()) {
            // $atributo = Attribute::where('id_product',$request->id_producto)->where('variation',1)->get();
            $atributo = DB::SELECT("SELECT * FROM attributes Where state_delete = 0 and id_product=$request->id_producto");
            // $dish->delete();
            // $atributo->save();

            return response()->json([
              'resultado'=> $atributo
                  ]);
      }
  }


  public function showVariations(Request $request)
  {
      if ($request->ajax()) {
            // $atributo = Attribute::where('id_product',$request->id_producto)->where('variation',1)->get();
            $variacion = DB::SELECT("SELECT  at.id as idAtributo,at.name as nombreAtributo, v.name, v.price, v.image
                                    FROM variations v
                                    INNER JOIN attributes at on at.id=v.id_attribute
                                    INNER JOIN products p on p.id=at.id_product
                                    WHERE p.id = $request->id_producto and v.state_delete = 0 and at.state_delete = 0");
            // $dish->delete();
            // $atributo->save();

            return response()->json([
              'resultado'=> $variacion
                  ]);
      }
  }
  public function showVariation(Request $request)
  {
      if ($request->ajax()) {
            // $atributo = Attribute::where('id_product',$request->id_producto)->where('variation',1)->get();
            $atributo = DB::SELECT("SELECT id,name FROM attributes Where variation = 1 and state_delete = 0 and id_product=$request->id_producto");
            // $dish->delete();
            // $atributo->save();

            return response()->json([
              'resultado'=> $atributo
                  ]);
      }
  }


  public function upVariation(Request $request)
  {
      if ($request->ajax()) {

              $variacion = new Variation;

              if($request->hasFile('file')) {
                $file = $request->file('file');
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/',$name);
                $variacion->image = $name;
              }
              $variacion->id_attribute =  $request->atributo_id;
              $variacion->name = $request->variacion_nombre;
              $variacion->price = $request->variacion_precio;
              $variacion->available = 1;
              $variacion->state_delete  = 0 ;
              $variacion->save();

              $atributo = DB::SELECT("SELECT id,name FROM attributes Where variation = 1 and state_delete = 0 and id=$request->atributo_id");



              return response()->json([
                'atributo'=> $atributo,
                'nombre'=> $request->variacion_nombre,
                'precio'=> $request->variacion_precio,
                'id_atributo'=> $request->atributo_id,
                'resultado'=> 'Registrado'
                    ]);
        }


  }

  public function deleteVariacion(Request $request)
  {
      if ($request->ajax()) {
            $variacion = Variation::where('id_attribute',$request->id_atributo)->where('name',$request->nombre)->first();
            $variacion->state_delete = 1;
            $variacion->available= 0;
            // $dish->delete();
            $variacion->save();

            return response()->json([
              'resultado'=> "Eliminado"
                  ]);
      }
  }

  public function guide()
  {
      return view('backend.dish.guia');
  }

  public function upExcel()
  {
      return view('backend.dish.excel');
  }

  public function registerExcel(Request $request)
  {



          // require_once __DIR__ .'/PHPExcel/Classes/PHPExcel.php';
          // require  __DIR__ .'/PHPExcel/Classes/PHPExcel/IOFactory.php';
          // require_once '../Classes/PHPExcel/IOFactory.php';

          if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $resultado = strpos($name,'.xlsx');
            if ($resultado) {
                // $file  = $request->file;
                // Excel::import(new ExcelImport, $file);
                // return redirect('/admin/productos');
// \Mpdf\Mpdf::
                //Cargar nuestra hoja de excel
                // App\Http\Controllers\BackEnd\ProductController::registerExcel()
                  // PhpOffice\PhpSpreadsheet\IOFactory
                  // PHPExcel\Classes\PHPExcel\IOFactory

                $excel = IOFactory::load($request->file);

                //Cargar la hoja de calculo que queremos
                $numerofila = $excel -> setActiveSheetIndex(0)->getHighestRow();
                echo $numerofila;

            } else {

              $error = 1;
              return view('backend.dish.excel')->with(compact('error'));
            }


          }
  }

  public function downExcel()
  {
          return response()->download(public_path('images/Plantilla.xlsx'));
  }

}
