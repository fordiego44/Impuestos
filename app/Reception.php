<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Reception extends Model
{
  public $timestamps = false;
  protected $table = "receptions";
  protected $fillable = [ 'id_user','customer_id','pending','coupon','state','date_reception','longitude','latitude','name','last_name','address','departament','province','district','telephone','cellphone','address_email','orders_id','state_delivery','advanced_payments_id','answer1','answer2','state_answer','delivery_type'];



  public function detail()
  {
    return $this->hasMany(ReceptionDetail::class, 'order_detail');
  } 
  public function messages() {
    return $this->hasMany(Message::class, 'reception_id');
  } 
  public function user() {
     
    return $this->belongsTo(User::class, 'id_user'); 
  }
  public function costumer() {
     
    return $this->belongsTo(Costumer::class, 'costumer_id'); 
  }
}
