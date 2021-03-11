<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocolo extends Model
{
  public $timestamps = false;
  protected $table = "protocolos";
  protected $fillable = [ 'customer_id', 'date_reception',
      'quest1','quest2','quest3','quest4','quest5','quest6'
      ,'quest7','quest8','quest9','quest10','quest11','quest12'
      ,'quest13','quest14','quest15','quest16','quest17','quest18' ];
}
