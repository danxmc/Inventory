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
<li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="ion-ios-person"></i> Proveedores</a></li>
<li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab"><i class="ion-plus-circled"></i> Añadir</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="list">
<div class="col-md-12">
                                <div class="panel">
                                    <header class="panel-heading">
                                        <h2 class="panel-title">Proveedores Registrados</h2>
                                    </header>
                                    <div class="panel-body">
                                        <table id="datatable" class="table table-striped dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Razon Social</th>
                                                    <th>RFC</th>
                                                    <th>Contacto</th>
                                                    <th>Ventas</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($proveedores as $key=>$proveedor)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$proveedor->name}}</td>
                                                <td>{{$proveedor->rfc}}</td>
                                                <td>{{$proveedor->contact}}</td>
                                                <td>{{$proveedor->movimientos->count()}}</td>
                                                <td></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
<div role="tabpanel" class="tab-pane" id="new">
    <form class="form-horizontal" method="POST" action="/proveedor/nuevo">
    @csrf
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Razon Social</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="name" name="name" >
            </div>
        </div>
        
        <div class="form-group">
            <label for="contact" class="col-sm-3 control-label">Contacto</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="contact" name="contact">
            </div>
        </div>
         <div class="form-group">
            <label for="rfc" class="col-sm-3 control-label">RFC</label>
            <div class="col-sm-7">
                <input required required type="text" class="form-control" name="rfc" maxlenght="9" minlenght="9">
            </div>
        </div>
        <hr>
        
        <h4>Información Adicional</h4>
        <div class="form-group">
            <label for="pname" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-7">
                <input required type="email" class="form-control" id="pname" name="email">
            </div>
        </div>
          <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">Teléfono</label>
            <div class="col-sm-7">
                <input required type="number" class="form-control" id="phone" name="phone">
            </div>
        </div>
        <div class="form-group">
            <label for="country" class="col-sm-3 control-label">País</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="country" name="country">
            </div>
        </div>
        <div class="form-group">
            <label for="state" class="col-sm-3 control-label">Estado</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="state" name="state">
            </div>
        </div>
        <div class="form-group">
            <label for="city" class="col-sm-3 control-label">Ciudad</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="city" name="city">
            </div>
        </div>
        <div class="form-group">
            <label for="zip_code" class="col-sm-3 control-label">Codigo Postal</label>
            <div class="col-sm-7">
                <input required type="number" class="form-control" id="zip_code" name="zip_code">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-7">
                <button type="submit" class="btn btn-lg btn-primary rounded">Añadir Proveedor</button>
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