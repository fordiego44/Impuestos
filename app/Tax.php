<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
  public $timestamps = false;
  protected $table = "estates";
  protected $fillable = [ 'direction','catastral_cod', 'pedrial_cod','state', 'autovaluo', 'part', 'autovaluo_afecto', 'tax_year'];

}
