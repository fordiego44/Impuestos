<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  public $timestamps = false;
  protected $table = "messages";
  protected $fillable = [ 'id', 'from','to', 'order_id', 'message','costumer_id', 'user_id', 'reception_id', 'type'];

 
}
