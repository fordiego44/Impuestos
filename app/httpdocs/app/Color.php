<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
  public $timestamps = false;
  protected $table = "colors";
  protected $fillable = [ 'name','code','status'];
}
