<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
  public $timestamps = false;
  protected $table = "weights";
  protected $fillable = ['name'];
}
