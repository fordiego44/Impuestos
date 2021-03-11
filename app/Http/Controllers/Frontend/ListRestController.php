<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Product;
use App\Attribute;
use App\Variation;
use App\User;
use App\Classification;

class ListRestController extends Controller
{
    public function index($userSlug,$userId,$productSlug,$productId){

      $data = Product::where('id','=',$productId)->first();

      $category = DB::table('products')
              ->join('categories','categories.id','products.id_category')
              ->select('categories.name')
              ->where('products.state_delete', 0)
              ->where('products.id','=',$productId)->first();

      $user = DB::table('users')
              ->join('bussines','users.business','bussines.id')
              ->join('departamentos','departamentos.id','users.department')
              ->join('provincias','provincias._id','users.province')
              ->join('distritos','distritos._id','users.district')
              ->select('users.id','users.slug', 'users.company',
              'users.phone', 'users.email_susti', 'users.image',
              'users.address', 'users.description', DB::raw("bussines.name as business,
              departamentos.name as departamento, provincias.name as provincia, distritos.name as distrito"))
              ->where('users.id','=',$userId)->first();

      $bussines = DB::table('bussines')->get();

      $slug = $userSlug;
      $others = Product::where('id_user','=',$data->id_user)->where('state_delete','!=',1)->where('id','!=',$productId)->orderBy(DB::raw('RAND()'))->take(3)->get();
      $attributs = Attribute::where('id_product','=',$productId)->where('variation','=','0')->where('state_delete','=','0')->get();
      $variations = DB::table('attributes')
                    ->join('variations','attributes.id','variations.id_attribute')
                    ->select('variations.state_delete','attributes.id','attributes.id_product','attributes.value',DB::raw("attributes.name as product_name"),
                              'variations.id_attribute',DB::raw("variations.id as variation_id"),DB::raw("variations.name as variation_name"),
                              DB::raw("variations.price as variation_price"), DB::raw("variations.image as variation_image"))
                    ->where('id_product','=',$productId)->where('variation','=','1')->where('variations.state_delete','=','0')->get();

      $attributs_1 = Attribute::where('id_product','=',$productId)->where('variation','=','1')->where('state_delete','=','0')->get();
      $users = User::with(['categories'])->get();
      $i = 0;
      $prueba = [];
      foreach($attributs_1 as $atributos){
        foreach($variations as $variaciones){
          if($atributos->id == $variaciones->id_attribute){
            $prueba[$i] = $atributos;
            $i++;
            break;
          }
        }
      }
      $attributs_1 = $prueba;

      $subcategory  = Classification::groupby('name')->distinct()->get();

      if($data->status_gallery == "1"){
          $images = DB::table('product_images')->where('product_images.id_product','=',$productId)->get();
          //dd($images);
          return view('frontend.details.index')->with(compact('subcategory','data','others','attributs','variations','attributs_1','slug','user', 'bussines','category', 'users','images'));

      }
      else{
        //dd($images);
        return view('frontend.details.index')->with(compact('subcategory','data','others','attributs','variations','attributs_1','slug','user', 'bussines','category', 'users'));

      }


    }

    public function change(Request $request){

      $data = Variation::where('id','=',$request->id)->get();
      return response()->json([
        'data' => $data
      ]);

    }
    //cambios
    public function qualification(Request $request){


      if (!$request->session()->exists('costumer')) {//no existe
        $status="200";
        return response()->json([
          'status' => $status
        ]);

      }
      else{//existe
        $status="201";
        $costumer_id = session('costumer')->id;
        $exits = DB::table('qualification')
                ->where('costumer_id','=', $costumer_id)
                ->where('user_id','=',$request->id)
                ->first();
        if($exits){
            $message = "Hay algo";
            $qualificate = DB::table('qualification')
                            ->where('id','=', $exits->id)
                            ->update([
                              'qualification' => $request->qualification
                            ]);
        }
        else{
          $message = "vacio";
          $qualification = DB::table('qualification')
                    ->insert([
                      'user_id' => $request->id,
                      'costumer_id' => $costumer_id,
                      'qualification' => $request->qualification,
                    ]);
        }
        $qualificate = DB::table('qualification')
                    ->select(DB::raw("SUM(qualification) / COUNT(user_id) as conteo"),DB::raw("COUNT(user_id) as cifra"))
                    ->where('user_id','=', $request->id)
                    ->groupBy('user_id')
                    ->get();
          $update = User::find($request->id);

          foreach($qualificate as $item){
            $update->opinions = $item->cifra;
            $update->qualification = $item->conteo;
            $update->save();
          }


        return response()->json([
          'status' => $status,
          'qualificate' => $qualificate,
          'update' => $update
        ]);



      }

    }
    //cambios
    public function like(Request $request){

      if (!$request->session()->exists('costumer')) {//no existe
        $status="200";
        return response()->json([
          'status' => $status
        ]);

      }
      else{//existe
        $status="201";
        $costumer_id = session('costumer')->id;
        $exits = DB::table('mybusinesses')->select('*')
                  ->where('id_customer','=', $costumer_id)
                  ->where('id_user','=', $request->user)->first();
        if($exits){
          $message = "hay algo";
          if($exits->state_delete == "0"){
            $qualificate = DB::table('mybusinesses')

                        ->where('id','=',$exits->id)
                        ->update([
                          'state_delete' => "1"
                        ]);
          }
          else{
            $qualificate = DB::table('mybusinesses')

                        ->where('id','=',$exits->id)
                        ->update([
                          'state_delete' => "0"
                        ]);
          }
        }
        else{
          $message = "no hay nada";
          $qualificate = DB::table('mybusinesses')
                        ->insert([
                          'id_user' => $request->user,
                          'id_customer' => $costumer_id,
                          'state_delete' => "0"
                        ]);
        }

        return response()->json([
          'status' => $status,
          'data' => $qualificate,
          'exits' => $exits,
          'message' => $message

        ]);

      }
    }

}
