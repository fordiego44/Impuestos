<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Deliverier;
use App\User;
use App\Business;
use App\Admin;
use App\Configuration;
use App\Reception;
use Illuminate\Support\Facades\Hash;

use Auth;
use App\Http\Controllers\Admin\HomeController;

class HomeController extends Controller
{

    private $oAdmin;

    public function __construct()
    {
        $this->oAdmin = new Admin();

    }
    public function index()
    {
        $users = User::all();
        return view('admin.index')->with(compact('users'));
    }
    public function list() {
        $business = Business::all();
        return view('admin.business.index')->with(compact('business'));
    }
    public function create() {
        return view('admin.business.create');
    }

    public function edit($id) {
        $business = Business::where('id', $id)->first();

        return view('admin.business.edit')->with(compact('business'));
    }
    public function update(Request $request, $id) {
        $business = Business::find($id);
        $business->name = $request->name;
        $business->save();
        return back();
    }
    public function state($id) {

    }
    public function store(Request $request) {
        $business = new Business;
        $business->name = $request->name;
        $business->save();
        return redirect('/superadmin/categoria');

    }
    public function isActive($id)
    {

        $admin = $this->oAdmin->getOneAdmin($id);
        if($admin){
            $admin = $this->oAdmin->changeActiveAdmin($id);
            if($admin->isShow == 1){
                return redirect('/superadmin/categoria')->with('success','Genial. El cover se ha puesto en línea!!');
                //return redirect()->route('superadmin.categoria.list')->with('success','Genial. El cover se ha puesto en línea!!');
            }else{
                //return redirect()->route('superadmin.categoria.list')->with('warning','El cover ya no está en línea!!');
                return redirect('/superadmin/categoria')->with('warning','El cover ya no está en línea!!');
            }
        } else {
            return redirect('/superadmin/categoria')->with('warning','El cover con el id '. $id . ' no ha sido encontrada!');
            //return redirect()->route('superadmin.categoria.list')->with('warning','El cover con el id '. $id . ' no ha sido encontrada!');
        }

    }
    public function profile(){
        $admin = Admin::first();
        return view('admin.perfil.index')->with(compact('admin'));

    }
    public function profileEdit(Request $request){
        $admin = Admin::first();
        $admin->name = $request->name;
        $admin->last_name = $request->lastname;
        $admin->ruc = $request->ruc;
        $admin->name_business = $request->company;
        $admin->email = $request->email;
        $admin->description = $request->description;
        $admin->telefono = $request->phone;
        $admin->save();
          return redirect('/superadmin/perfil');
    }
    public function password(Request $request){
        $admin = Admin::first();
        /*$admin->password = Hash::make($request->password_old);
        $admin->save();*/
        if(Hash::check($request->password, $admin->password)){
            $admin->password = Hash::make($request->password_old);
            $admin->save();
            return response()->json(['status' => 200]);
        }
        else{
            return response()->json(['status' => 204]);
        }
        //return response()->json(['password' => $request->password, 'password_old' => $request->password_old, 'password_old_two' => $request->password_old_two]);
    }



}

?>
