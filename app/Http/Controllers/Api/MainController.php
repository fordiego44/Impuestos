<?php

namespace App\Http\Controllers\Api;

use App\Deliv;
use App\User;
use App\Protocolo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Deliverier;
use App\Gallery;



class MainController extends Controller
{
    
    public function all(Request $request){

        $business = DB::table('bussines')
				 		 ->select('bussines.id', 'bussines.name as bussines', 'bussines.name as filter_name', 'bussines.name as type', 'bussines.name as type_filter','bussines.id as product_id')
				 
                        ->get();
            
        $categories = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.id_user')
                        ->join('categories', 'categories.id', '=', 'products.id_category')
                        ->join('bussines', 'bussines.id', '=', 'users.business')
                        ->select('categories.id', 'bussines.name as business', 'users.company', 'products.description' , 'categories.name as filter_name' , 'categories.name as type_filter','categories.name as type' ,'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
                        ->where('products.state_delete', 0) 
                        ->groupBy('categories.id')
                        ->get();

        $products = DB::table('products')
						->join('users', 'users.id', '=', 'products.id_user')
						->join('categories', 'categories.id', '=', 'products.id_category')
						->join('bussines', 'bussines.id', '=', 'users.business')
						->select('products.id', 'bussines.name as business', 'products.name as filter_name', 'users.company', 'products.description' , 'products.name as type_filter', 'products.name as type' , 'products.price', 'products.name','products.image' ,'users.slug', 'categories.name as category','products.id as product_id','products.slug as product_slug')
						->where('products.state_delete', 0) 
						->groupBy('products.id')
                        ->get();
    
   
 
         
        foreach ($business as $key => $value) {
            $business[$key]->type = 'categoria';
            $business[$key]->type_filter = 'bussines';
        }   
                     
        foreach ($categories as $key => $value) {
            $categories[$key]->type = 'sub-categoria';
            $categories[$key]->type_filter = 'categories';
        }  
        foreach ($products as $key => $value) {
            $products[$key]->type = 'Producto';
            $products[$key]->type_filter = 'products';
        }  
        
      

        $data = collect($business) 
                    ->concat(collect($categories))
                    ->concat(collect($products));
 
        return response()->json($data);                
    }
    

}
