<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Products;

class Category extends Model
{
  public $timestamps = false;
  protected $table = "categories";
  protected $fillable = ['id_user','name', 'description', 'image', 'order_start','search','uuid'];


  public function product() {
    return $this->belongsTo('App\Product', 'id_category');
  }
  public function user(){
    return $this->belongsTo('App\User', 'id');
  }
}
