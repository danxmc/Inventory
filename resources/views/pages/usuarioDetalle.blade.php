@extends('layouts.admin')
@section('css')
@stop
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-body">
                <div class="profile-info">
                    <h4>{{$usuario->rfc}} - {{$usuario->name}}</h4>
                    <p class="text-uppercase color-info"><a href="/departamento{{$usuario->departamento->id}}">{{$usuario->departamento->name}}</a></p>
                    <div class="space-30"></div>
                        <div class="row">
                            <div class="col-md-6 text-right">
                            Posición:<br>
                            Email:<br>
                            Teléfono:<br>
                            Fecha de nacimiento:
                            </div>
                            <div class="col-md-6 text-left">
                            {{$usuario->position}}<br>
                            {{$usuario->email}}<br>
                            {{$usuario->phone}}<br>
                            {{$usuario->birth_date}} 
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
                        <h1>{{$usuario->gender}}</h1>
                        <h4>Sexo</h4>
                        </div>
    
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            @if(!is_null($usuario->proyecto))
                            <h1>{{$usuario->proyecto->name}}</h1>
                            @else
                            <h1>NA</h1>
                            @endif
                            <h4>Administrador</h4>
                        </div>
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
                                <h2 class="panel-title">Movimientos Registrados</h2>
                            </header>
                            <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Movimiento</th>
                                                    <th>Fecha</th>
                                                    <th>Artículo</th>
                                                    <th>Proveedor</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($usuario->movimiento as $movimiento)
                                            @foreach($movimiento->articulos as $articulo)
                                            <tr>
                                                <td><a href="/movimiento{{$movimiento->id}}">{{$movimiento->id}}</a></td>
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
                                                <td><a href="/articulo{{$articulo->id}}">{{$articulo->name}}</a></td>
                                                <td>
                                                @if(!is_null($movimiento->proveedor))
                                                <a href="/movimiento{{$movimiento->proveedor->id}}">{{$movimiento->proveedor->name}}</a>
                                                @else
                                                NA
                                                @endif
                                                </td>
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