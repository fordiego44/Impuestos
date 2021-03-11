<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
  public $timestamps = false;
  protected $table = "sizes";
  protected $fillable = [ 'name', 'status'];
}
