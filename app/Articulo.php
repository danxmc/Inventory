<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulos';
    protected $fillable = ['sku', 
    'name',
    'description',
    'stock_min',
    'stock_max',
    'pto_abastecimiento',
    'price',
    'risk_level',
    'category',
    'unit',
    'stock'];


    public function Movimiento(){
        return $this->belongsToMany('App\Movimiento', 'articulo_movimiento', 'articulo_sku', 'movimiento_id')
        ->withPivot('cantidad');
    }
}
