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
Route::get('/departamento/responsable', function(Request $request){
    $departamento = App\Departamento::find($_GET['id']);
    $usuarios = $departamento->usuarios;
    $select = '<option disabled selected style="display:none">Asigne un Responsable</option>';
    foreach($usuarios as $usuario){
        if(is_null($usuario->proyecto)){
            $select.='<option value="'.$usuario->id.'">'.$usuario->name.'</option>';
        }
    }
    return response($select);     
});

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
    return view('pages.proyectos', compact('proyectos','departamentos'));
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
Route::get('/articulo{articulo}', function( App\Articulo $articulo){
    return view('pages.articuloDetalle', compact('articulo'));
});
Route::get('/departamento{departamento}', function( App\Departamento $departamento){
    return view('pages.departamentoDetalle', compact('departamento'));
});
Route::get('/usuario{usuario}', function( App\Usuario $usuario){
    return view('pages.usuarioDetalle', compact('usuario'));
});
Route::get('/proveedor{proveedor}', function( App\Proveedor $proveedor){
    return view('pages.proveedorDetalle', compact('proveedor'));
});
Route::get('/movimiento{movimiento}', function( App\Movimiento $movimiento){
    return view('pages.movimientoDetalle', compact('movimiento'));
});
Route::post('/proyecto/nuevo', 'ControllerInventory@newProyecto');
Route::post('/departamento/nuevo', 'ControllerInventory@newDepartamento');

Route::post('/movimiento/nuevo', 'ControllerInventory@newMovimiento');
Route::post('/usuario/nuevo', 'ControllerInventory@newUsuario');
Route::GET('/producto/precio', 'ControllerInventory@showPrecio');
Route::post('/proveedor/nuevo', 'ControllerInventory@newProveedor');
Route::post('/articulo/nuevo','ControllerInventory@newArticulo');

Route::post('/usuario/delete', 'ControllerInventory@deleteUsuario');
Route::post('/proveedor/delete', 'ControllerInventory@deleteProveedor');
Route::post('/articulo/delete', 'ControllerInventory@deleteArticulo');
Route::post('/departamento/delete', 'ControllerInventory@deleteDepartamento');
Route::post('/proyecto/delete', 'ControllerInventory@deleteProyecto');
