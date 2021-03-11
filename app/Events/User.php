<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Category;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','business','company','slug','last_name' ,'dni','ruc','business', 'department' ,'province', 'district', 'cellphone',
        'phone','password','image','latitude','longitude','address','state','description','paypal1','paypal2','paypal3','qualification','opinions','id_MP',
        'access_token','token_type','expires_in','scope','refresh_token','public_key','live_mode', 'code'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function product() {
        return $this->belongsTo('App\Product', 'id_user');
    }
    public function categories()
    {
      return $this->hasMany(Category::class, 'id_user');
    }
}
