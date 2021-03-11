<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model 
{
  public $timestamps = false;
  protected $table = "categories";
  protected $fillable = [
                        'name', 'description',
                         'image', 'order_start'];
 
}
