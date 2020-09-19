<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username','email','imagen','estado','oficina_id','rol','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function oficinas(){
        return $this->belongsTo('App\Oficinas','oficina_id');
    }

    public function tickets(){
        return $this->hasMany('App\Tickets','user_id');
    }

    public function equipos(){
        return $this->hasMany('App\Equipos','usuario_id');
    }

    public function bitacora(){
        return $this->hasMany('App\Bitacora','usuario_id','id'); //modelo, campo foraneo
    }
}
