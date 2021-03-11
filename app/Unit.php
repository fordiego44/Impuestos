<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
  public $timestamps = false;
  protected $table = "units";
  protected $fillable = [ 'name','content', 'status'];
}
