<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyBusiness extends Model
{
  public $timestamps = false;
  protected $table = "my_businesses";
  protected $fillable = [ 'name', 'description', 'price', 'image','date'];
}
