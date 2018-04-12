<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    protected $fillable = ['type'];


    public function Proveedor(){
        return $this->belongsTo('App\Proveedor', 'proveedor_RFC', 'rfc');
    }
    public function Usuario(){
        return $this->belongsTo('App\Usuario', 'user_RFC', 'rfc');
    }
    public function Articulos(){
        return $this->belongsToMany('App\Articulo', 'articulo_movimiento',  'movimiento_id', 'articulo_sku')
        ->withPivot('cantidad');
    }

}
