<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  public $timestamps = false;
  protected $table = "payments";
  protected $fillable = [ 'costumer_id','predial_cod', 'total','date',];
}
