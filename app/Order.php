<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
  
class Order extends Model
{
  public $timestamps = false;
  protected $table = "orders";
  protected $fillable = [ 'id', 'date', 'user_id','image','advanced_payments_id'];
  
  public function order_detail()
  {
    return $this->hasMany(ReceptionDetail::class, 'orders_id');
  } 
  public function reception() 
  {
    return $this->belongsTo(Reception::class, 'orders_id');
  }
  public function messages() {
    return $this->hasMany(Message::class, 'order_id');
  }

  public function user() {
    
    return $this->belongsTo(User::class, 'user_id'); 
  }
  
}
