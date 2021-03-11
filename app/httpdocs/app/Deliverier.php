<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliverier extends Model
{
    public $timestamps = false;
    protected $table = "deliveriers";
    protected $fillable = [ 'id_user','password', 'dni','name','last_name', 'direction',
                            'phone', 'email','image','state_deliver','state_delete'];

}
