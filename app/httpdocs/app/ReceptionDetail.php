<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceptionDetail extends Model
{
  public $timestamps = false;
  protected $table = "reception_details";
  protected $fillable = [
                        'order_detail','dish_id','quantity',
                        'total','id_user_detail','id_attribute','id_variation','orders_id'
                      ];
}
