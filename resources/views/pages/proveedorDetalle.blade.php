@extends('layouts.admin')
@section('css')
@stop
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-body">
                <div class="profile-info">
                    <h4>{{$proveedor->rfc}} - {{$proveedor->name}}</h4>
                    <p class="text-uppercase color-info">{{$proveedor->contact}}</p>
                    <div class="space-30"></div>
                        <div class="row">
                            <div class="col-md-6 text-right">
                            Teléfono:<br>
                            Email:<br>
                            CP:
                            </div>
                            <div class="col-md-6 text-left">
                            {{$proveedor->phone}}<br>
                            {{$proveedor->email}}<br>
                            {{$proveedor->zip_code}}
                            </div>
                        </div>
                </div><!--profile info-->
            </div>
        </div>
        <div class="space-20"></div>
        <div class="panel">
            <div class="panel-body">
                <div class="profile-states">
                     <div class="row">
                        <h1>{{$proveedor->state}}</h1>
                        <h4>Estado</h4>
                        </div>
                        <div class="row">
                            <h1>{{$proveedor->city}}</h1>
                            <h4>Ciudad</h4>
                        </div>
                    
                </div><!--Profile states-->
            </div><!--panel body-->
        </div><!--panel-->
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                    <ul class="list-inline tabs-bordered margin-b-20" role="tablist">
                        <li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="fa fa-align-right"></i>Movimientos Registrados</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="list">
                            <header class="panel-heading">
                                <h2 class="panel-title">Compras Registrados</h2>
                            </header>
                            <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>SKU</th>
                                                    <th>Nombre</th>
                                                    <th>Responsable</th>
                                                    <th>Fecha</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($proveedor->movimientos as $movimiento)
                                            @foreach($movimiento->articulos as $articulo)
                                            <tr>
                                                <td>{{$movimiento->id}}</td>
                                                <td><a href="/articulo{{$articulo->id}}">{{$articulo->sku}}</a></td>
                                                <td>{{$articulo->name}}</td>
                                                <td><a href="/usuario{{$movimiento->usuario->id}}">{{$movimiento->usuario->name}}</a></td>
                                                <td>{{$movimiento->created_at}}</td>
                                                <td>{{$articulo->pivot->cantidad}}</td>
                                                <td>{{$articulo->price * $articulo->pivot->cantidad}}</td>
                                                </tr>
                                            @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                        </div>
                    </div>
                    </diV>
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