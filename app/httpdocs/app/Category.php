<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
use App\Products;

class Category extends Model
{
  public $timestamps = false;
  protected $table = "categories";
  protected $fillable = [
                        'name', 'description',
                         'image', 'order_start'];


  public function product() {
    return $this->belongsTo('App\Product', 'id_category');
  }
}
