<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  public $timestamps = false;
  protected $table = "addresses";
  protected $fillable = [ 'user_id','customer_id','latitude','longitude'];
}
