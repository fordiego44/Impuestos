<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
  public $timestamps = false;
  protected $table = "product_images";
  protected $fillable = [ 'id_product','name','route_name','filesize','uuid'];
}
