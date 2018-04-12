<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    protected $fillable = ['name'];

    public function Proyectos(){
        return $this->hasMany('App\Proyecto');

    }
    public function Usuarios(){
        return $this->hasMany('App\Usuario');
    }
}
