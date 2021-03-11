<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public $timestamps = false;
  protected $table = "products";
  protected $fillable = [ 'name','id_user', 'description', 'price', 'image', 'time_delay','state_delete','slug','id_category'];

  public function category(){
    return $this->belongsTo('App\Category', 'id');
  }
  public function user(){
    return $this->belongsTo('App\User', 'id');
  }
}
