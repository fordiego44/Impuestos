<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
  public $timestamps = false;
  protected $table = "costumers";
  protected $fillable = [
                        'name',
                        'dni', 'phone',
                        'email', 'date_register', 'password','telephone','direction'];
}
