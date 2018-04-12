<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuarios';
    protected $fillable=['rfc',
    'email',
    'name',
    'position',
    'phone',
    'gender',
    'birth_date'];

    public function Departamento(){
        return $this->belongsTo('App\Departamento');
    }
    public function Proyecto(){
        return $this->hasOne('App\Proyecto', 'mngr_RFC', 'rfc');
    }
    public function Movimiento(){
        return $this->hasMany('App\Movimiento', 'user_RFC', 'rfc');
    }
}
