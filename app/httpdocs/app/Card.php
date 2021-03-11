<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
  public $timestamps = false;
  protected $table = "customer_cards";
  protected $fillable = [
                        'id',
                        'id_customer', 'number',
                        'mounth', 'year', 'cvv','name','type_document','document','type_card'];
}
