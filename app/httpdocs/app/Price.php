<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
  public $timestamps = false;
  protected $table = "prices";
  protected $fillable = [ 'name','price','status'];
}
