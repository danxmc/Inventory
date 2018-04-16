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
        $movimiento = Movimiento::create($request->all());
        $usuario = Usuario::find($request->post('usuario'));
        $usuario->Movimiento()->save($movimiento);
        $movimiento->Usuario()->associate($usuario);
        if($request->post('type')=='1'){
            $proveedor = Proveedor::find($request->post('proveedor'));
            $proveedor->Movimientos()->save($movimiento);

            $movimiento->Proveedor()->associate($proveedor);
        }
        $POST_articulos = $request->post('articulo');
        $POST_cantidad = $request->post('cantidad');
        foreach($POST_articulos as $key => $POST_articulo){
            $articulo = Articulo::find($POST_articulo);
            if($request->post('type')<4){
                $articulo->stock = $articulo->stock + $POST_cantidad[$key];
            }else{
                $articulo->stock = $articulo->stock - $POST_cantidad[$key];
            }
            $articulo->save();
            $movimiento->Articulos()->save($articulo, ['cantidad'=>$POST_cantidad[$key]]);
        }
        return redirect('/movimiento')->with("success", "Movimiento nuevo registrado");
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
    public function deleteUsuario(Request $request){
        $usuario = Usuario::find($request->post('id'));
        $usuario->delete();
        return redirect('/usuario')->with('success', 'Usuario dado de baja');
    }
    public function deleteArticulo(Request $request){
        $articulo = Articulo::find($request->post('id'));
        $articulo->delete();
        return redirect('/articulo')->with('success', 'Artículo dado de baja');
    }
    public function deleteProveedor(Request $request){
        $proveedor = Proveedor::find($request->post('id'));
        $proveedor->delete();
        return redirect('/proveedor')->with('success', 'Proveedor dado de baja');
    }
    public function deleteProyecto(Request $request){
        $proyecto = Proyecto::find($request->post('id'));
        $proyecto->delete();
        return redirect('/proyecto')->with('success', 'Proyecto dado de baja');
    }
    public function deleteDepartamento(Request $request){
        $departamento = Departamento::find($request->post('id'));
        $departamento->delete();
        return redirect('/departamento')->with('success', 'Departamento dado de baja');
    }
}
