@extends('layouts.admin')
@section('css')
@stop
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-body">
                <div class="profile-info">
                    <h4>{{$articulo->sku}} - {{$articulo->name}}</h4>
                    <p class="text-uppercase color-info">{{$articulo->category}}</p>
                    <div class="space-30"></div>
                        <div class="row">
                            <div class="col-md-6 text-right">
                            Precio:<br>
                            Nivel de riesgo:<br>
                            Stock:
                            </div>
                            <div class="col-md-6 text-left">
                            ${{$articulo->price}}<br>
                            {{$articulo->risk_level}}<br>
                            {{$articulo->stock}} {{$articulo->unit}}
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
                        <div class="col-md-4 col-sm-4 col-xs-6">
                        <h1>{{$articulo->stock_min}}</h1>
                        <h4>Stock mínimo</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <h1>{{$articulo->stock_max}}</h1>
                            <h4>Stock máximo</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <h1>{{$articulo->pto_abastecimiento}}</h1>
                            <h4>Punto Abastecimiento</h4>
                        </div>
                    </div>
                </div><!--Profile states-->
            </div><!--panel body-->
        </div><!--panel-->
        <div class="space-20"></div>
        <div class="panel">
            <div class="panel-body">
                <div class="about-profile">
                    <h4>Descripción de {{$articulo->name}}</h4>
                        <p>
                        {{$articulo->description}}
                        </p>
                </div>
            </div><!--panel body-->
        </div><!--panel-->
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                    <ul class="list-inline tabs-bordered margin-b-20" role="tablist">
                        <li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="ion-ios-person"></i>Movimientos Registrados</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="list">
                            <header class="panel-heading">
                                <h2 class="panel-title">Movimientos Registrados</h2>
                            </header>
                            <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Movimiento</th>
                                                    <th>Fecha</th>
                                                    <th>Responsable</th>
                                                    <th>Proveedor</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($articulo->movimiento as $movimiento)
                                            <tr>
                                                <td>{{$movimiento->id}}</td>
                                                <td>
                                                @switch($movimiento->type)
                                                 @case(1)
                                                    Compra
                                                @break
                                                @case(2)
                                                    Devolución
                                                @break
                                                @case(3)
                                                    Regalo
                                                @break
                                                @case(4)
                                                    Prestamo
                                                @break
                                                @case(5)
                                                    Extravío
                                                @break
                                                @case(6)
                                                    Daño
                                                @break
                                                @endswitch
                                                </td>
                                                <td>{{$movimiento->created_at}}</td>
                                                <td>{{$movimiento->usuario->name}}</td>
                                                <td>
                                                @if(!is_null($movimiento->proveedor))
                                                {{$movimiento->proveedor->name}}
                                                @else
                                                NA
                                                @endif
                                                </td>
                                                <td>{{$movimiento->pivot->cantidad}}</td>
                                                <td>{{$articulo->price * $movimiento->pivot->cantidad}}</td>
                                                </tr>
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