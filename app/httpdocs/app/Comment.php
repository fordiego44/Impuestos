<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class Comment extends Model
{
  public $timestamps = false;
  protected $table = "comments";
  protected $fillable = [ 'id_user', 'id_customer', 'comment', 'state_delete', 'date','qualification'];

}
