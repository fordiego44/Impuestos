<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
  public $timestamps = false;
  protected $table = "products";
  protected $fillable = [ 'name', 'description', 'price', 'image'];

  public function category(){
    return $this->belongsTo('App\Dish', 'id_category');
  }
}
