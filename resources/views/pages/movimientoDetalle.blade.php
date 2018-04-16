@extends('layouts.admin')
@section('css')
@stop
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-body">
                <div class="profile-info">
                    <h4>{{$movimiento->id}} - @switch($movimiento->type)
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
                                                @endswitch</h4>
                    <p class="text-uppercase color-info"><a href="/usuario{{$movimiento->usuario->id}}">{{$movimiento->usuario->name}}</a></p>
                    <div class="space-30"></div>
                        <div class="row">
                            <div class="col-md-6 text-right">
                            Fecha:<br><br>
                            Departamento:<br>
                            Total:
                            </div>
                            <div class="col-md-6 text-left">
                            {{$movimiento->created_at}}<br>
                            <a href="/departamento{{$movimiento->usuario->departamento->id}}">{{$movimiento->usuario->departamento->name}}</a><br>
                            <p id="totalMovimiento"></p>
                            </div>
                        </div>
                  
                </div><!--profile info-->
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                    <ul class="list-inline tabs-bordered margin-b-20" role="tablist">
                        <li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="ion-ios-person"></i>Articulos</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="list">
                            <header class="panel-heading">
                                <h2 class="panel-title">Detalles del movimiento</h2>
                            </header>
                            <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                        
                                                    <th>SKU</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                            $total = 0;
                                            @endphp
                                            @foreach($movimiento->articulos as $articulo)
                                            <tr>
                                                <td><a href="/articulo{{$articulo->id}}">{{$articulo->sku}}</a></td>
                                                <td>{{$articulo->pivot->cantidad}}</td>
                                                <td>{{$articulo->price * $articulo->pivot->cantidad}}</td>
                                                @php
                                                $total+=$articulo->price * $articulo->pivot->cantidad;
                                                @endphp
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
        $("#totalMovimiento").text("${{$total}}");
        </script>
@stop