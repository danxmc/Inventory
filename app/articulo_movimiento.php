<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class articulo_movimiento extends Model
{
    protected $table = 'articulo_movimientos';

    protected $fillable =['cantidad'];

}
