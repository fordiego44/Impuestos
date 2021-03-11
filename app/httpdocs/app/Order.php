<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  public $timestamps = false;
  protected $table = "orders";
  protected $fillable = [ 'id', 'date', 'user_id','image','advanced_payments_id'];
}
