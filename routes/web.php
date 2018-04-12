<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});
Route::get('/departamento', function () {
    $departamentos = App\Departamento::all();
    return view('pages.departamento', compact('departamentos'));
});
Route::get('/proveedor', function(){
    $proveedores = App\Proveedor::all();
    return view('pages.proveedor', compact('proveedores'));
});
Route::get('/usuario', function(){
    $usuarios = App\Usuario::all();
    $departamentos = App\Departamento::all();
    return view('pages.usuario', compact('usuarios','departamentos'));
});
Route::get('/proyecto', function(){
    $proyectos = App\Proyecto::all();
    $departamentos = App\Departamento::all();
    $Responsables = App\Usuario::has('proyecto', '0')->get();
    return view('pages.proyectos', compact('proyectos','departamentos', 'Responsables'));
});
Route::get('/articulo', function(){
    $articulos = App\Articulo::all();
    return view('pages.articulos', compact('articulos'));
});
Route::get('/movimiento', function(){
    $movimientos = App\Movimiento::all();
    $articulos = App\Articulo::all();
    $proveedores = App\Proveedor::all();
    $usuarios = App\Usuario::all();
    return view('pages.movimiento', compact('movimientos', 'articulos', 'proveedores', 'usuarios'));
});
Route::post('/proyecto/nuevo', 'ControllerInventory@newProyecto');
Route::post('/departamento/nuevo', 'ControllerInventory@newDepartamento');

Route::post('/movimiento/nuevo', 'ControllerInventory@newMovimiento');
Route::post('/usuario/nuevo', 'ControllerInventory@newUsuario');

Route::GET('/producto/precio', 'ControllerInventory@showPrecio');
Route::post('/proveedor/nuevo', 'ControllerInventory@newProveedor');
Route::post('/articulo/nuevo','ControllerInventory@newArticulo');
