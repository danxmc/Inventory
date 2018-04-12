<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\articulo_movimiento;
use App\Articulo;
use App\Departamento;
use App\Movimiento;
use App\Proveedor;
use App\Proyecto;
use App\Usuario;

class ControllerInventory extends Controller
{
    public function newMovimiento(Request $request){
        
    }
    public function showPrecio(Request $request){
        $articulo = Articulo::find($request->get('articulo'));
        return response("".$articulo->price);
    }
    public function newDepartamento(Request $request){
        $departamento = Departamento::create($request->all());
        $departamento->save();
        return redirect('/departamento')->with('success', 'Departamento nuevo registrado');
    }
    public function newUsuario(Request $request){
        $Usuario = Usuario::create($request->all());
        $departamento = Departamento::find($request->post('departamento'));
        $departamento->Usuarios()->save($Usuario);
        $Usuario->Departamento()->associate($departamento)->save();

        return redirect('/usuario')->with('success', 'Usuario nuevo registrado');
    }
    public function newProveedor(Request $request){
        $Proveedor = Proveedor::create($request->all());
        $Proveedor->save();

        return redirect('/proveedor')->with('success', 'Proveedor nuevo registrado');
    }
    public function newProyecto(Request $request){
        $proyecto = Proyecto::create($request->all());
        $responsable = Usuario::find($request->post('Responsable'));
        $responsable->Proyecto()->save($proyecto);
        $proyecto->Manager()->associate($responsable);

        $departamento = Departamento::find($request->post('departamento'));
        $departamento->Proyectos()->save($proyecto);
        $proyecto->Departamento()->associate($departamento)->save();

        return redirect('/proyecto')->with('success', 'Proyecto nuevo registrado');
    }
    public function newArticulo(Request $request){
        $articulo = Articulo::create($request->all());
        $articulo->save();
        return redirect('/articulo')->with('success', 'Artículo nuevo registrado');
    }
}
