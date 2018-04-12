<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    protected $fillable = ['name',
    'start_date',
    'end_date'];

    public function Departamento(){
        return $this->belongsTo('App\Departamento');
    }
    public function Manager(){
        return $this->belongsTo('App\Usuario', 'mngr_RFC', 'rfc');
    }
}
