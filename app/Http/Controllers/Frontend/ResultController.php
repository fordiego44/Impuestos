<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Classification;

class ResultController extends Controller
{

    public function index()
    {
        $business = DB::table('bussines')->get();
        $departaments = DB::table('departamentos')->get();
        $companies = DB::table('users')->get();
        $users = User::with(['categories'])->get();

        return view('frontend.result.index')->with(compact('business','departaments','companies','users'));

    }
    public function allCompanies(Request $request)
    {
        $companies = DB::table('users')
                            ->where('users.department', 'like', '%'. $request->department . '%')
                            ->where('users.business', 'like', '%'. $request->business . '%')
                            ->get();
        return $companies;
    }
    public function searchCompanies(Request $request) {
        if(isset($request->info)  && !isset($request->department)) {
            $result = DB::table('departamentos')->where('name', 'like', '%'. $request->info . '%')->first();
            $department = $result->id;
        } else {
            $department = $request->department;
        }
        $data = User:: select('users.address','users.state','users.opinions','users.qualification','users.id', 'users.business as business_id', 'bussines.name as business', 'users.company', 'users.image' ,'users.slug', 'users.id', 'users.longitude', 'users.latitude')
                ->join('bussines', 'bussines.id', '=', 'users.business')
                ->where('users.department', 'like', '%'. $request->department . '%')
                ->where('users.business', 'like', '%'.$request->business. '%')
                ->where('users.id', 'like', '%'.$request->name. '%')
                ->paginate(9);

        if ($request->session()->exists('costumer')){

            $costumer_id = session('costumer')->id;
            $favorites = DB::table('mybusinesses')
                            ->where('id_customer','=',$costumer_id)->get();

            foreach($data as $restaurant){

                foreach($favorites as $item){
                    if($restaurant->id == $item->id_user && $item->state_delete == "0"){
                        $restaurant->liked = "1";
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
            'companies' => $data,
            ]);
    }
    public function searchName() {
        $users = User::all();
        return $users;
    }
    public function searchDepartment(Request $request) {
        $result = DB::table('departamentos')->where('name', 'like', '%'. $request->info . '%')->first();
        return $result->id;
    }
    public function productos(Request $request) {
        $business = DB::table('bussines')->get();
        $departaments = DB::table('distritos')->where('department_id', 23)->get();
        $companies = DB::table('users')->get();
        $users = User::with(['categories'])->get();
        $subcategory  = Classification::groupby('name')->distinct()->get();

        return view('frontend.product')->with(compact('subcategory','business','departaments','companies', 'users'));
    }
}
