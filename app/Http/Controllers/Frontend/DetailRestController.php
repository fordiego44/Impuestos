<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Classification;
use App\User;
use App\Gallery;
use App\Days;
use App\Cart;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class DetailRestController extends Controller
{
    public function index($slug) {
        $business = DB::table('bussines')->get(); 

        $user =  User::where('slug', $slug)->first();
        $clasifications1 =  Classification::with(['dishs'])
                            ->where('id_user', $user->id)
                            ->get();
        $clasifications =  DB::table('products')
                            ->join('categories','products.id_category','=','categories.id')
                            ->select(DB::raw("products.id as product_id"),
                                    'products.description','products.price','products.image','products.id_category',
                                     DB::raw("categories.name as category_name, products.name as product_name")
                                    )
                            ->where('products.id_user','=',$user->id)
                            ->get();
        $gallery = Gallery::where('user', $user->id)->get();
        $days = Days::where('user', $user->id)->first();
        $users = User::with(['categories'])->get();   

        return view('frontend.restaurant.index' )->with(compact('clasifications' ,'user', 'gallery', 'days','clasifications1','business', 'users'));
    }

    public function list(Request $request){

        $data = $request->data;
        $list =  DB::table('products')
                            ->join('categories','products.id_category','=','categories.id')
                            ->select(DB::raw("products.id as product_id"),
                                    'products.description','products.price','products.image','products.id_category',
                                     DB::raw("categories.name as category_name, products.name as product_name")
                                    )
                            ->where('products.id_user','=',$data)
                            ->get();

        return response()->json([
            'list' => $list
            ]);
                            

    }
    public function listado($id){

        
        $data =  DB::table('products')
                ->join('categories','products.id_category','=','categories.id')
                ->join('users','users.id','=','products.id_user')
                ->select('users.id','users.slug',DB::raw("products.id as product_id"),
                        'products.description','products.price','products.image','products.id_category',
                        DB::raw("categories.name as category_name, products.name as product_name, products.slug as product_slug")
                        )
                            ->where('products.id_user','=',$id)->paginate(5);
                            //->get();

         return response()->json([
                                'pagination' => [
                                  'total'         => $data->total(),
                                  'current_page'  => $data->currentPage(),
                                  'per_page'      => $data->perPage(),
                                  'last_page'     => $data->lastPage(),
                                  'from'          => $data->firstItem(),
                                  'to'            => $data->lastItem(),
                                ],
                                'pagos' => $data
                              ]);
                        
                            

    }
    public function searchCategory(Request $request){
   
            $data = $request->data;
            
                $category= DB::table('products')
                ->join('categories','products.id_category','=','categories.id')
                ->join('users','users.id','=','products.id_user')
                ->select('users.id','users.slug',DB::raw("products.id as product_id"),
                        'products.description','products.price','products.image','products.id_category',
                         DB::raw("categories.name as category_name, products.name as product_name")
                        )
                ->where('categories.id','=',$data)
                ->get();  
            return response()->json([
              'category' => $category
            ]);
          
    }
    public function searchCategorys($id){
   
        $valor = $id;
        
            $data= DB::table('products')
            ->join('categories','products.id_category','=','categories.id')
            ->join('users','users.id','=','products.id_user')
            ->select('users.id','users.slug',DB::raw("products.id as product_id"),
                    'products.description','products.price','products.image','products.id_category',
                     DB::raw("categories.name as category_name, products.name as product_name")
                    )
            ->where('categories.id','=',$valor)->paginate(5);
            //->get();  
        return response()->json([
            'pagination' => [
                'total'         => $data->total(),
                'current_page'  => $data->currentPage(),
                'per_page'      => $data->perPage(),
                'last_page'     => $data->lastPage(),
                'from'          => $data->firstItem(),
                'to'            => $data->lastItem(),
              ],
              'pagos' => $data
        ]);
      
    }
    public function searchWord(Request $request){

        
        $data = DB::table('products')
                ->join('categories','products.id_category','=','categories.id')
                ->join('users','users.id','=','products.id_user')
                ->select('users.id','users.slug',DB::raw("products.id as product_id"),
                        'products.description','products.price','products.image','products.id_category',
                         DB::raw("categories.name as category_name, products.name as product_name")
                        )
        ->where('products.id_user','=',$request->user)
        ->get();
        $prueba = [];
        $i=0;
        if($request->word == ''){
            $status = 'vacio';
            return response()->json([
                'sucess' => $status
            ]);
        }
        else{
            $status = 'lleno';
            foreach($data as $value){

                $pos = strrpos(strtolower($value->product_name), strtolower($request->word));
                //$pos = strrpos('Hola mundo','hola');
                if($pos === false){
                    
                    //$prueba[$i]='noencontrado';
                    
                }
                else{
                    $prueba[$i]=$value;
                }

                $i=$i+1;
            }
            return response()->json([
                'status' => $status,
                'data' =>$prueba
              ]);
        }
    }
    public function searchWords($id,$word){

        
        /*$content = DB::table('products')
                ->join('categories','products.id_category','=','categories.id')
                ->join('users','users.id','=','products.id_user')
                ->select('users.id','users.slug',DB::raw("products.id as product_id"),
                        'products.description','products.price','products.image','products.id_category',
                         DB::raw("categories.name as category_name, products.name as product_name")
                        )
        ->where('products.id_user','=',$id)->where('products.name','=',$word)
        ->paginate(5);*/
        $data = DB::table('products')
                ->join('categories','products.id_category','=','categories.id')
                ->join('users','users.id','=','products.id_user')
                ->select('users.id','users.slug',DB::raw("products.id as product_id"),
                        'products.description','products.price','products.image','products.id_category',
                         DB::raw("categories.name as category_name, products.name as product_name")
                        )
        ->where('products.id_user','=',$id)->where('products.name','LIKE','%'.$word.'%')
        ->paginate(5);
        //->get();
       /* $data = [];
        $i=0;
        
           
            foreach($content as $value){

                $pos = strrpos(strtolower($value->product_name), strtolower($word));
                //$pos = strrpos('Hola mundo','hola');
                if($pos === false){
                    
                    //$prueba[$i]='noencontrado';
                    
                }
                else{
                    $data[$i]=$value;
                }

                $i=$i+1;
            }
            */
            return response()->json([
                
                'pagination' => [
                    'total'         => $data->total(),
                    'current_page'  => $data->currentPage(),
                    'per_page'      => $data->perPage(),
                    'last_page'     => $data->lastPage(),
                    'from'          => $data->firstItem(),
                    'to'            => $data->lastItem(),
                  ],
                  'pagos' => $data
              ]);
        
    }

    
}
