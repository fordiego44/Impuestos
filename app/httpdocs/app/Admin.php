<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    public $timestamps = false;
    protected $table = "admin";
    protected $fillable = ['password', 'dni', 'email','ruc','name','las_tname','description','telefono','name_business']; 
    protected $table2 = "bussines";

    public function changeActiveAdmin($id)
    {

        $cover = DB::table($this->table2)->where('id', $id)->first();

        $showCover = ($cover->isShow) ? 0 : 1;

        DB::table($this->table2)->where('id', '=', $id)->update(['isShow' => $showCover]);

        return DB::table($this->table2)->where('id', $id)->first();

    }

    public function getOneAdmin($id)
    {

        return DB::table($this->table2)->where('id', $id)->first();

    }
}
