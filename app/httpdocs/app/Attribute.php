<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{ 
  public $timestamps = false;
  protected $table = "attributes";
  protected $fillable = [ 'id_product','name', 'value', 'variation', 'state_delete'];
}
