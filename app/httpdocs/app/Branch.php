<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
  public $timestamps = false;
  protected $table = "branches";
  protected $fillable = [ 'id_user','address', 'latitude', 'longitude', 'state_delete', 'date_creation'];
}
