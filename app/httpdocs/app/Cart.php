<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  public $timestamps = false;
  protected $table = "carts";
  protected $fillable = [
                        'id_usuario', 'id_producto',
                         'id_clasificacion'];
}
