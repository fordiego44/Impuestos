<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
  public $timestamps = false;
  protected $table = "costumers";
  protected $fillable = [
                        'name',
                        'last_name',
                        'dni', 'phone',
                        'email', 'date_register', 'password','telephone','direction','change_dni'];
}
