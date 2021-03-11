<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Gallery;
use App\Product;
use App\Comment;
use App\Classification;

class MapController extends Controller
{

    public function index($slug, $id) {
        $gallery = Gallery::where('user', $id)->get();

        $bussines = DB::table('bussines')->get();

        $departamentos = DB::table('departamentos')->get();
        $user = DB::table('users')
                        ->join('bussines', 'bussines.id', '=', 'users.business')
                        ->join('departamentos', 'departamentos.id', '=', 'users.department')
                        ->join('provincias', 'provincias._id', '=', 'users.province')
                        ->join('distritos', 'distritos._id', '=', 'users.district')
                        ->select( 'users.address',
                                  'users.phone',
                                  'users.slug',
                                  'users.qualification',
                                  'users.opinions',
                                  'bussines.name as bussines',
                                  'users.id', 'users.name',
                                  'users.company',
                                  'departamentos.name as department',
                                  'provincias.name as  province',
                                  'distritos.name as district')
                        ->where('users.id' ,'=', $id)
                        ->first();


         $products = DB::table('products')
                ->join('users', 'users.id', '=', 'products.id_user')
                ->join('categories', 'categories.id', '=', 'products.id_category')
                ->join('bussines', 'bussines.id', '=', 'users.business')
                ->select('products.id', 'bussines.name as business', 'users.slug as user_slug', 'users.id as user_id', 'users.company', 'products.name','products.image' ,'products.slug' , 'categories.name as category')
                ->where('users.id', 'like', '%'.$id. '%')
                ->where('products.state_delete', 0)
                ->groupBy('products.id')
                ->get();

        $categories = DB::table('users')
                        ->join('categories', 'categories.id_user', '=', 'users.id')
                        ->select('categories.name', 'categories.id')
                        ->where('users.id' ,'=', $id)
                        ->where('categories.state_delete', 0)
                        ->get();

        $comment =DB::SELECT("SELECT  co.comment, co.date, cu.name, cu.last_name, co.qualification,cu.image
                                FROM comments co
                                INNER JOIN costumers cu on cu.id=co.id_customer
                                INNER JOIN users u on u.id=co.id_user
                                WHERE co.id_user = $id  ");

          foreach ($comment as $comments) {
            $fecha = $comments->date;
            $fechaComoEntero = strtotime($fecha);
            $comments->anio = date("Y", $fechaComoEntero);
            $mes = date("m", $fechaComoEntero);

            $comments->dia = date("d", $fechaComoEntero);
            $comments->hora = date("H", $fechaComoEntero);
            if ($comments->hora > 11) {
              $comments->estado = "pm" ;
            } else {
              $comments->estado = "am" ;
            }

            $comments->minutos = date("i", $fechaComoEntero);
            $comments->segundos = date("s", $fechaComoEntero);
            if ($mes == 1) {
              $comments->mes="Enero";
            } else {
              if ($mes == 2) {
                $comments->mes="Febrero";
              } else {
                if ($mes== 3) {
                  $comments->mes = "Marzo";
                } else {
                  if ($mes == 4) {
                    $comments->mes="Abril";
                  } else {
                    if ($mes == 5) {
                      $comments->mes = "Mayo";
                    } else {
                      if ($mes == 6) {
                        $comments->mes = "Junio";
                      } else {
                        if ($mes == 7) {
                          $comments->mes = "Julio";
                        } else {
                          if ($mes == 8) {
                            $comments->mes = "Agosto";
                          } else {
                            if ($mes == 9) {
                              $comments->mes = "Setiembre";
                            } else {
                              if ($mes == 10) {
                                $comments->mes = "Octubre";
                              } else {
                                if ($mes == 11) {
                                  $comments->mes = "Noviembre";
                                } else {
                                  if ($mes == 12) {
                                    $comments->mes = "Diciembre";
                                  }
                                }
                              }
                            }
                          }
                        }
                      }

                    }

                  }

                }

              }

            }

          }




        $users = User::with(['categories'])->get();
        $subcategory  = Classification::groupby('name')->distinct()->get();

        return view('frontend.map.index')->with(compact('subcategory','bussines', 'categories', 'gallery','products', 'user','departamentos','comment', 'users'));
    }
     public function searchProduct(Request $request){

         if(isset($request->bussines)) {
            if (count($request->bussines) == 1 && $request->bussines[0] == 0) {
                $data = DB::table('products')
               ->join('users', 'users.id', '=', 'products.id_user')
               ->join('categories', 'categories.id', '=', 'products.id_category')
               ->join('bussines', 'bussines.id', '=', 'users.business')
               ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
               ->where('users.id', 'like', '%'.$request->user_id. '%')
               ->where('products.state_delete', 0)
               ->groupBy('products.id')
               ->paginate(9);
            } else {
                $data = DB::table('products')
                ->join('users', 'users.id', '=', 'products.id_user')
                ->join('categories', 'categories.id', '=', 'products.id_category')
                ->join('bussines', 'bussines.id', '=', 'users.business')
                ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' , 'products.price','products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
                ->where('users.id', 'like', '%'.$request->user_id. '%')
                ->whereIn('categories.id', $request->bussines)
                ->where('products.state_delete', 0)
                ->groupBy('products.id')
                ->paginate(9);
            }

        } else {

            $data = DB::table('products')
            ->join('users', 'users.id', '=', 'products.id_user')
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('bussines', 'bussines.id', '=', 'users.business')
            ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' , 'products.price' , 'products.name', 'products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
            ->where('users.id', 'like', '%'.$request->user_id. '%')
            ->whereIn('categories.id', $request->bussines)
            ->where('products.state_delete', 0)
            ->groupBy('products.id')
            ->paginate(9);
        }


        return response()->json([
            'pagination' => [
              'total'         => $data->total(),
              'current_page'  => $data->currentPage(),
              'per_page'      => $data->perPage(),
              'last_page'     => $data->lastPage(),
              'from'          => $data->firstItem(),
              'to'            => $data->lastItem(),
            ],
            'products' => $data,
          ]);
    }
    public function users() {
       $users = User::all();
       return $users;
    }
    public function list(Request $request) {

      $data = User:: select('users.state','users.opinions','users.qualification','users.id', 'users.business as business_id', 'bussines.name as business', 'users.company', 'users.image' ,'users.slug', 'users.id', 'users.longitude', 'users.latitude')

      ->join('bussines', 'bussines.id', '=', 'users.business')
      ->where('users.department',23)
      //->where('users.district', 'like', '%'.$request->district. '%')
      ->where('users.business', 'like', '%'.$request->business. '%')
      ->paginate(9);
    
      foreach($data as $item){
          $item->liked = "0";
      }
      if ($request->session()->exists('costumer')){//noexiste

              $costumer_id = session('costumer')->id;
              $favorites = DB::table('mybusinesses')
                              ->where('id_customer','=',$costumer_id)->get();

              foreach($data as $product){

                  foreach($favorites as $item){
                      if($product->id == $item->id_user && $item->state_delete == "0"){
                          $product->liked = "1";
                      }

                  }
              }
      }


        return response()->json([
            'pagination' => [
              'total'         => $data->total(),
              'current_page'  => $data->currentPage(),
              'per_page'      => $data->perPage(),
              'last_page'     => $data->lastPage(),
              'from'          => $data->firstItem(),
              'to'            => $data->lastItem(),
            ],
            'users' => $data,
          ]);
    }
    public function listRestaurants(Request $request) {
        $users = DB::table('users')
        ->join('bussines', 'bussines.id', '=', 'users.business') 
        ->where('users.district', 'like', '%'.$request->district_id. '%') 
        ->where('users.department', 23) 
        ->select('users.id', 'bussines.name as business', 'users.company', 'users.image' ,'users.slug', 'users.id', 'users.longitude', 'users.latitude')
        ->get();

        return response()->json(['users' => $users]);
    }
    public function searchSucursales(Request $request ) {

      $branches = DB::table('users')
                      ->select('users.id', 'bussines.name as business', 'users.company', 'users.image','users.business as business_id' ,'users.slug', 'users.id', 'branches.longitude', 'branches.latitude')
                      ->join('bussines', 'bussines.id', '=', 'users.business')
                      ->join('branches', 'branches.id_user', '=', 'users.id')
                      ->where('users.id', $request->id)
                      ->get();

      $user = DB::table('users')
                      ->select('users.id', 'bussines.name as business', 'users.company', 'users.image','users.business as business_id' ,'users.slug', 'users.id', 'users.longitude', 'users.latitude')
                      ->join('bussines', 'bussines.id', '=', 'users.business')
                       ->where('users.id', $request->id)
                      ->first();

      return response()->json([ 'branches' => $branches, 'user' => $user ]);


    }
    public function sucursales(Request $request, $slug, $id) {
      $bussines = DB::table('bussines')->get();
      $users = User::with(['categories'])->get();

      return view('frontend.map.sucursales')->with(compact('bussines', 'users'));

    }
    public function searchProductAll1(Request $request){

      if(isset($request->ctg)) {

        $data = DB::table('products')
            ->join('users', 'users.id', '=', 'products.id_user')
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('bussines', 'bussines.id', '=', 'users.business')
            ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
            ->where('categories.name', 'like', '%'.$request->ctg. '%')
            ->where('products.state_delete', 0)
            ->groupBy('products.id')
            ->paginate(9);

     } else {

         $data = DB::table('products')
            ->join('users', 'users.id', '=', 'products.id_user')
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('bussines', 'bussines.id', '=', 'users.business')
            ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' , 'products.price' , 'products.name', 'products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
            ->where('categories.name', 'like', '%'.$request->ctg. '%')
            ->where('products.state_delete', 0)
            ->groupBy('products.id')
            ->paginate(9);
     }

      return response()->json([
        'pagination' => [
          'total'         => $data->total(),
          'current_page'  => $data->currentPage(),
          'per_page'      => $data->perPage(),
          'last_page'     => $data->lastPage(),
          'from'          => $data->firstItem(),
          'to'            => $data->lastItem(),
        ],
			  'products' => $data,
       ]);
  }
  public function searchProductAll(Request $request) {

    $query_business = $request->business == "null" ? '': $request->business;
    $query_department = $request->department == "null" ?'' : $request->department;
    $query_ctg = $request->ctg == "null" ?  '': $request->ctg ;
    $query_type = $request->type == "null" ? 0  : $request->type;
  
    $departament = DB::table('distritos')
            ->where('department_id', 23)
						->where('name', 'like', '%'.$query_department. '%')
            ->first();

    $departament_id = isset($departament->id) ? $departament->id : '';
    if ($query_type !== 0) {
      
          switch ($query_type) {
            case 'bussines':

                  $data = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.id_user')
                        ->join('categories', 'categories.id', '=', 'products.id_category')
                        ->join('bussines', 'bussines.id', '=', 'users.business')
                        ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
                        ->where('bussines.name', 'like', '%'.$query_ctg. '%')
                        ->where('products.state_delete', 0)
                        ->groupBy('products.id')
                        ->paginate(9);
            break;
            case 'users':
                $data = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.id_user')
                        ->join('categories', 'categories.id', '=', 'products.id_category')
                        ->join('bussines', 'bussines.id', '=', 'users.business')
                        ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
                        ->where('users.company', 'like', '%'.$query_ctg. '%')
                        ->where('products.state_delete', 0)
                        ->groupBy('products.id')
                        ->paginate(9);
            break;
            case 'categories':
                $data = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.id_user')
                        ->join('categories', 'categories.id', '=', 'products.id_category')
                        ->join('bussines', 'bussines.id', '=', 'users.business')
                        ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
                        ->where('categories.name', 'like', '%'.$query_ctg. '%')
                        ->where('products.state_delete', 0)
                        ->groupBy('products.id')
                        ->paginate(9);


            break;
            case 'products':
                $data = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.id_user')
                        ->join('categories', 'categories.id', '=', 'products.id_category')
                        ->join('bussines', 'bussines.id', '=', 'users.business')
                        ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
                        ->where('products.name', 'like', '%'.$query_ctg. '%')
                        ->where('products.state_delete', 0)
                        ->groupBy('products.id')
                        ->paginate(9);
            break;
            case 'departamentos':
                $departament = DB::table('departamentos')
                        ->where('name', 'like', '%'.$query_ctg. '%')
                        ->first();

                if (isset($departament)) {
                  $data = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.id_user')
                        ->join('categories', 'categories.id', '=', 'products.id_category')
                        ->join('bussines', 'bussines.id', '=', 'users.business')
                        ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
                        ->where('users.department', 'like', '%'.$departament->id. '%')
                        ->where('products.state_delete', 0)
                        ->groupBy('products.id')
                        ->paginate(9);
                } else {
                  $data = [];
                }
            break;
            case 'distritos':
                  $district = DB::table('distritos')
                    ->where('department_id', 23)
                    ->where('name', 'like', '%'.$query_ctg. '%')
                    ->first();

                if (isset($district)) {
                  $data = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.id_user')
                        ->join('categories', 'categories.id', '=', 'products.id_category')
                        ->join('bussines', 'bussines.id', '=', 'users.business')
                        ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
                        ->where('users.district', 'like', '%'.$district->_id. '%')
                        ->where('products.state_delete', 0)
                        ->groupBy('products.id')
                        ->paginate(9);
                } else {
                  $data = [];
                }
            break;

          }
          return response()->json([
            'pagination' => [
              'total'         => $data->total(),
              'current_page'  => $data->currentPage(),
              'per_page'      => $data->perPage(),
              'last_page'     => $data->lastPage(),
              'from'          => $data->firstItem(),
              'to'            => $data->lastItem(),
            ],
            'products' => $data,
           ]);
    } else {
         // dd("ctmr".$);
            $data = DB::table('products')
                ->join('users', 'users.id', '=', 'products.id_user')
                ->join('categories', 'categories.id', '=', 'products.id_category')
                ->join('bussines', 'bussines.id', '=', 'users.business')
                ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
                ->where('bussines.name', 'like', '%'.$query_business. '%')
                ->where('users.department', 'like', '%'.$request->department. '%')
                 ->where('products.state_delete', 0)
                ->groupBy('products.id')
                ->paginate(9);
 
                return response()->json([
                  'pagination' => [
                    'total'         => $data->total(),
                    'current_page'  => $data->currentPage(),
                    'per_page'      => $data->perPage(),
                    'last_page'     => $data->lastPage(),
                    'from'          => $data->firstItem(),
                    'to'            => $data->lastItem(),
                  ],
                  'products' => $data,
                 ]);
    }

  }



  /*
  public function searchProductAll(Request $request){
    $query_filter = $request->ctg;
    $business = DB::table('products')
						->join('users', 'users.id', '=', 'products.id_user')
						->join('categories', 'categories.id', '=', 'products.id_category')
						->join('bussines', 'bussines.id', '=', 'users.business')
						->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
						->where('bussines.name', 'like', '%'.$query_filter. '%')
						->where('products.state_delete', 0)
						->groupBy('products.id')
            ->paginate(9);

    $categories = DB::table('products')
            ->join('users', 'users.id', '=', 'products.id_user')
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('bussines', 'bussines.id', '=', 'users.business')
            ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
            ->where('categories.name', 'like', '%'.$query_filter. '%')
            ->where('products.state_delete', 0)
            ->groupBy('products.id')
            ->paginate(9);

    $products = DB::table('products')
						->join('users', 'users.id', '=', 'products.id_user')
						->join('categories', 'categories.id', '=', 'products.id_category')
						->join('bussines', 'bussines.id', '=', 'users.business')
						->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
						->where('products.name', 'like', '%'.$query_filter. '%')
						->where('products.state_delete', 0)
						->groupBy('products.id')
            ->paginate(9);

    $users = DB::table('products')
						->join('users', 'users.id', '=', 'products.id_user')
						->join('categories', 'categories.id', '=', 'products.id_category')
						->join('bussines', 'bussines.id', '=', 'users.business')
						->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
						->where('users.name', 'like', '%'.$query_filter. '%')
						->where('products.state_delete', 0)
						->groupBy('products.id')
            ->paginate(9);

    $departament = DB::table('departamentos')
						->where('name', 'like', '%'.$query_filter. '%')
            ->first();

   // dd($departament);
   if (isset($departament)) {
    $departments = DB::table('products')
      ->join('users', 'users.id', '=', 'products.id_user')
      ->join('categories', 'categories.id', '=', 'products.id_category')
      ->join('bussines', 'bussines.id', '=', 'users.business')
      ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
      ->where('users.department', 'like', '%'.$departament->name. '%')
      ->where('products.state_delete', 0)
      ->groupBy('products.id')
      ->paginate(9);
   } else {
     $departments = [];
   }


    $district = DB::table('distritos')
 						->where('name', 'like', '%'.$query_filter. '%')
            ->first();

    if (isset($district)) {
      $districts = DB::table('products')
        ->join('users', 'users.id', '=', 'products.id_user')
        ->join('categories', 'categories.id', '=', 'products.id_category')
        ->join('bussines', 'bussines.id', '=', 'users.business')
        ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
        ->where('users.district', 'like', '%'.$district->name. '%')
        ->where('products.state_delete', 0)
        ->groupBy('products.id')
        ->paginate(9);
    } else {
      $districts = [];
    }


    $business_length = count($business);
    $categories_length = count($categories);
    $products_length = count($products);
    $users_length = count($users);
    $departments_length = count($departments);
    $districts_length = count($districts);

    if ($business_length > 0) {
      $data = $business;
    }
    if ($categories_length > 0) {
      $data = $categories;
    }
    if ($products_length > 0) {
      $data = $products;
    }
    if ($users_length > 0) {
      $data = $users;
    }
    if ($departments_length > 0) {
      $data = $departments;
    }
    if ($districts_length > 0) {
      $data = $districts;
    }
    return response()->json([
      'pagination' => [
        'total'         => $data->total(),
        'current_page'  => $data->currentPage(),
        'per_page'      => $data->perPage(),
        'last_page'     => $data->lastPage(),
        'from'          => $data->firstItem(),
        'to'            => $data->lastItem(),
      ],
      'products' => $data,
     ]);
  }*/

  public function validateType($query) {

    $business = DB::table('products')
						->join('users', 'users.id', '=', 'products.id_user')
						->join('categories', 'categories.id', '=', 'products.id_category')
						->join('bussines', 'bussines.id', '=', 'users.business')
						->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
						->where('business.name', 'like', '%'.$query_filter. '%')
						->where('products.state_delete', 0)
						->groupBy('products.id')
            ->paginate(9);

    $categories = DB::table('products')
            ->join('users', 'users.id', '=', 'products.id_user')
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('bussines', 'bussines.id', '=', 'users.business')
            ->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
            ->where('categories.name', 'like', '%'.$query_filter. '%')
            ->where('products.state_delete', 0)
            ->groupBy('products.id')
            ->paginate(9);

    $products = DB::table('products')
						->join('users', 'users.id', '=', 'products.id_user')
						->join('categories', 'categories.id', '=', 'products.id_category')
						->join('bussines', 'bussines.id', '=', 'users.business')
						->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
						->where('products.name', 'like', '%'.$query_filter. '%')
						->where('products.state_delete', 0)
						->groupBy('products.id')
            ->paginate(9);

    $users = DB::table('products')
						->join('users', 'users.id', '=', 'products.id_user')
						->join('categories', 'categories.id', '=', 'products.id_category')
						->join('bussines', 'bussines.id', '=', 'users.business')
						->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
						->where('users.name', 'like', '%'.$query_filter. '%')
						->where('products.state_delete', 0)
						->groupBy('products.id')
            ->paginate(9);

    $departament = DB::table('products')
						->join('departament', 'users.id', '=', 'products.id_user')
						->select('users.id', 'departament.name')
						->where('departament.name', 'like', '%'.$query_filter. '%')
						->first();

    $departments = DB::table('products')
						->join('users', 'users.id', '=', 'products.id_user')
						->join('categories', 'categories.id', '=', 'products.id_category')
						->join('bussines', 'bussines.id', '=', 'users.business')
						->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
						->where('users.department', 'like', '%'.$departament_id->id. '%')
						->where('products.state_delete', 0)
						->groupBy('products.id')
            ->paginate(9);

    $district = DB::table('products')
						->join('departament', 'users.id', '=', 'products.id_user')
						->select('users.id', 'departament.name')
						->where('departament.name', 'like', '%'.$query_filter. '%')
						->first();

    $districts = DB::table('products')
						->join('users', 'users.id', '=', 'products.id_user')
						->join('categories', 'categories.id', '=', 'products.id_category')
						->join('bussines', 'bussines.id', '=', 'users.business')
						->select('users.id', 'bussines.name as business', 'users.company', 'products.description' ,  'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
						->where('users.district', 'like', '%'.$district->id. '%')
						->where('products.state_delete', 0)
						->groupBy('products.id')
            ->paginate(9);

    $business_length = count($business);
    $categories_length = count($categories);
    $products_length = count($products);
    $users_length = count($users);
    $departments_length = count($departments);
    $districts_length = count($districts);

    if ($business_length > 0) {
      $data = $business;
    }
    if ($categories_length > 0) {
      $data = $categories;
    }
    if ($products_length > 0) {
      $data = $products;
    }
    if ($users_length > 0) {
      $data = $users;
    }
    if ($departments_length > 0) {
      $data = $departments;
    }
    if ($districts_length > 0) {
      $data = $districts;
    }
    return response()->json([
      'pagination' => [
        'total'         => $data->total(),
        'current_page'  => $data->currentPage(),
        'per_page'      => $data->perPage(),
        'last_page'     => $data->lastPage(),
        'from'          => $data->firstItem(),
        'to'            => $data->lastItem(),
      ],
      'products' => $data,
     ]);
  }
}
