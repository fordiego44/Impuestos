<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
  public $timestamps = false;
  protected $table = "variations";
  protected $fillable = [ 'id_attribute','name', 'price', 'image', 'available', 'state_delete'];

}
