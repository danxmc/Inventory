<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table= 'proveedors';
    protected $fillable = ['rfc',
    'email',
    'name',
    'phone',
    'city',
    'state',
    'country',
    'zip_code',
    'contact'];

    public function Movimientos(){
        return $this->hasMany('App\Movimiento', 'proveedor_RFC', 'rfc');
    }
}
