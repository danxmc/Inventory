@extends('layouts.admin')
@section('css')
@stop
@section('content')
<div class="row">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="list-inline tabs-bordered margin-b-20" role="tablist">
<li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="ion-ios-person"></i> Articulos</a></li>
<li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab"><i class="ion-plus-circled"></i> Añadir</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="list">
<div class="col-md-12">
                                <div class="panel">
                                    <header class="panel-heading">
                                        <h2 class="panel-title">Articulos Registrados</h2>
                                    </header>
                                    <div class="panel-body">
                                        <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>SKU</th>
                                                    <th>Nombre</th>
                                                    <th>Stock</th>
                                                    <th>Punto Abastecimiento</th>
                                                    <th>Categoría</th>
                                                    <th>Nivel de Riesgo</th>
                                                    <th>Proveedores</th>
                                                    <th>Costo</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($articulos as $articulo)
                                            @if($articulo->stock <= $articulo->pto_abastecimiento)
                                            <tr class="danger">
                                            @else
                                            <tr>
                                            @endif
                                                <td><a href="/articulo{{$articulo->id}}">{{$articulo->sku}}</a></td>
                                                <td>{{$articulo->name}}</td>
                                                <td>{{$articulo->stock}} {{$articulo->unit}}</td>
                                                <td>{{$articulo->pto_abastecimiento}}
                                                <td>{{$articulo->category}}</td>
                                                <td>{{$articulo->risk_level}}</td>
                                                <td>
                                                @php
                                                $proveedores = [];
                                                $idpro = [];
                                                @endphp
                                                @foreach($articulo->movimiento as $compra)
                                                
                                                    @if(!is_null($compra->proveedor))
                                                    @php
                                                        $proveedores[] = $compra->proveedor->name;
                                                        $idpro[] =  $compra->proveedor->id;
                                                  @endphp
                                                    @endif
                                                @endforeach
                                                @php
                                                $proveedores = array_unique($proveedores);
                                                $idpro = array_unique($idpro);
                                                @endphp
                                                @foreach($proveedores as $key => $proveedor)
                                                <a href="/proveedor{{$idpro[$key]}}">{{$proveedor}} <br>
                                                @endforeach
                                                </td>
                                                <td>${{$articulo->price}}</td>
                                                <td>${{$articulo->price * $articulo->stock}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
<div role="tabpanel" class="tab-pane" id="new">
    <form class="form-horizontal" method="POST" action="/articulo/nuevo">
    @csrf
        <div class="form-group">
            <label for="sku" class="col-sm-3 control-label">SKU</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="sku" name="sku" >
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="name" name="name" >
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-3 control-label">Descripción</label>
            <div class="col-sm-7">
                <textarea required class="form-control" id="description" name="description" ></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="stock_min" class="col-sm-3 control-label">Stock mínimo</label>
            <div class="col-sm-7">
                <input required type="number" class="form-control" id="stock_min" name="stock_min" >
            </div>
        </div>
        <div class="form-group">
            <label for="stock_max" class="col-sm-3 control-label">Stock máximo</label>
            <div class="col-sm-7">
                <input required type="number" class="form-control" id="stock_max" name="stock_max" >
            </div>
        </div>
        <div class="form-group">
            <label for="pto_abastecimiento" class="col-sm-3 control-label">Punto de Abastecimiento</label>
            <div class="col-sm-7">
                <input required type="number" class="form-control" id="pto_abastecimiento" name="pto_abastecimiento" >
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-3 control-label">Precio</label>
            <div class="col-sm-7">
                <input required type="number" class="form-control" id="price" name="price" >
            </div>
        </div>
        <div class="form-group">
            <label for="risk_level" class="col-sm-3 control-label">Nivel de Riesgo</label>
            <div class="col-sm-7">
                <input required type="number" min="0" max="5" class="form-control" id="risk_level" name="risk_level" >
            </div>
        </div>
        <div class="form-group">
            <label for="category" class="col-sm-3 control-label">Categoria</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="category" name="category" >
            </div>
        </div>
        <div class="form-group">
            <label for="unit" class="col-sm-3 control-label">Unidad</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="unit" name="unit" >
            </div>
        </div>
        <input type="hidden" name="stock" value="0">
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-7">
                <button type="submit" class="btn btn-lg btn-primary rounded">Añadir Artículo</button>
                <div class="pull-right">
                <button type="reset" class="btn btn-lg btn-warning rounded">Limpiar</button>
                </div>
            </div>
        </div>
    </form>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>                      
                          
                        </div>
                    
@stop
@section('scripts')
<script src="/assets/plugins/lightbox2/dist/js/lightbox.min.js"></script>
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {
        $('#datatable').dataTable();
        });
        </script>
@stop