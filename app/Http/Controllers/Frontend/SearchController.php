<?php

namespace App\Http\Controllers\FrontEnd;
//namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\User;
use App\Classification;
class SearchController extends Controller
{
    //
    public function index(Request $request){
        $business = DB::table('bussines')->get();
        $users = User::with(['categories'])->get();
        $subcategory  = Classification::groupby('name')->distinct()->get();

        $districts = DB::table('distritos')->where('department_id', 23)->get();

        return view('frontend.search.index')->with(compact('subcategory','business', 'districts', 'users'));

    }
    public function products(Request $request){

        //$data = DB::select("SELECT b.name, SUM(c.quantity) FROM users a INNER JOIN products b on a.id = b.id_user INNER JOIN reception_details c ON b.id = c.dish_id INNER JOIN receptions d ON d.id = c.order_detail GROUP BY c.dish_id");

       $data = DB::table('receptions')
                    ->join('reception_details','receptions.id','reception_details.order_detail')
                    ->join('products','products.id','reception_details.dish_id')
                    ->join('users','users.id','products.id_user')
                    ->select('users.id','users.slug','users.company','products.name','products.price','products.image',DB::raw("SUM(quantity) as suma"))
                    ->groupBy('reception_details.dish_id')
                    ->orderBy('suma','desc')
                    ->take(41)->paginate(6);


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
    public function selected($datos){
        $datos1 = explode(",", $datos);

        $datos1[0] = ($datos1[0] == "1") ? "Restaurantes":'';
        $datos1[1] = ($datos1[1] == "1") ? "Textos, Idiomas y Estudios":'';
        $datos1[2] = ($datos1[2] == "1") ? "Productos Electrodomesticos":'';
        $datos1[3] = ($datos1[3] == "1") ? "Belleza y Estética":'';
        $datos1[4] = ($datos1[4] == "1") ? "Moda, Vestimenta y Textileria":'';
        $datos1[5] = ($datos1[5] == "1") ? "Servicios":'';
        $datos1[6] = ($datos1[6] == "1") ? "Veterinarias":'';
        $datos1[7] = ($datos1[7] == "1") ? "Ferreteria":'';
        $datos1[8] = ($datos1[8] == "1") ? "Otros":'';


        $data = DB::table('products')

                    ->join('users','users.id','products.id_user')
                    ->select('users.id','users.slug','users.company','products.name','products.price','products.image')
                    ->where('users.business',$datos1[0])
                    ->orWhere('users.business',$datos1[1])
                    ->orWhere('users.business',$datos1[2])
                    ->orWhere('users.business',$datos1[3])
                    ->orWhere('users.business',$datos1[4])
                    ->orWhere('users.business',$datos1[5])
                    ->orWhere('users.business',$datos1[6])
                    ->orWhere('users.business',$datos1[7])
                    ->orWhere('users.business',$datos1[8])

                    ->orderBy('products.id','desc')
                    ->paginate(6);


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
    public function departmentOne(Request $request){

        $departamento = DB::table('departamentos')
                            ->where('id','=',$request->id)->get();

        return response()->json([

            'departamento' => $departamento
        ]);
    }
    public function searchProduct(Request $request){


        $data = User:: select('users.state','users.opinions','users.qualification','users.id', 'users.business as business_id', 'bussines.name as business', 'users.company', 'users.image' ,'users.slug', 'users.id', 'users.longitude', 'users.latitude')

            ->join('bussines', 'bussines.id', '=', 'users.business')
            ->where('users.department', 'like', '%'. $request->department . '%')
            ->where('users.province', 'like', '%'.$request->province. '%')
            ->where('users.district', 'like', '%'.$request->district. '%')
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
            'products' => $data,
          ]);


    }
    public function searchCategory(Request $request) {

        $categories = DB::table('users')
                    ->join('categories', 'users.id', '=', 'categories.id_user')
                    ->select('users.id', 'users.business', 'categories.name', 'categories.id')
                    ->where('users.department', '=', $request->department_id)
                    ->where('users.business', '=', $request->business)
                    ->get();

        return response()->json(['categories' => $categories]);
    }
}
