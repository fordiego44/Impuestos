<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
  public $timestamps = false;
  protected $table = "categories";
  protected $fillable = [
                        'id_user','name', 'description',
                         'image', 'order_start'];

}
