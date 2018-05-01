@extends('layouts.admin')
@section('css')
@stop
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-body">
                <div class="profile-info">
                    <h4>{{$departamento->id}} - {{$departamento->name}}</h4>
                
                  
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
                        <li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="fa fa-user"></i>Usuarios</a></li>
                        <li role="presentation" ><a href="#articulos" aria-controls="articulos" role="tab" data-toggle="tab"><i class="fa fa-cube"></i>Articulos en uso</a></li>
                        <li role="presentation" ><a href="#proyectos" aria-controls="proyectos" role="tab" data-toggle="tab"><i class="fa fa-braille"></i>Proyectos</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="list">
                            <header class="panel-heading">
                                <h2 class="panel-title">Usuarios del Departamento</h2>
                            </header>
                            <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>RFC</th>
                                                    <th>Nombre</th>
                                                    <th>Administra</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($departamento->usuarios as $usuario)
                                                <tr>
                                                    <td>{{$usuario->id}}</td>
                                                    <td>{{$usuario->rfc}}</td>
                                                    <td><a href="/usuario{{$usuario->id}}">{{$usuario->name}}</a></td>
                                                    <td>
                                                    @if(!is_null($usuario->proyecto))
                                                {{$usuario->proyecto->name}}
                                                @else
                                                NA
                                                @endif
                                                </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="articulos">
                            <header class="panel-heading">
                                <h2 class="panel-title">Historial Articulos</h2>
                            </header>
                            <table id="datatable2" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Movimiento</th>
                                               
                                                    <th>Articulo</th>
                                                    <th>Cantidad</th>
                                                    <th>Motivo</th>
                                                    <th>Responsable</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($departamento->usuarios as $usuario)
                                            @foreach($usuario->movimiento as $movimiento)
                                                @if($movimiento->type == 4 || $movimiento->type == 2)
                                                @foreach($movimiento->articulos as $articulo)
                                                <tr>
                                                    <td><a href="/movimiento{{$movimiento->id}}">{{$movimiento->id}}</a></td>
                                                    <td><a href="/articulo{{$articulo->id}}">{{$articulo->name}}</a></td>
                                                    <td>{{$articulo->pivot->cantidad}}</td>
                                                    <td>
                                                    @if($movimiento->type == 4)
                                                    Préstamo
                                                    @else
                                                    Devolución
                                                    @endif
                                                    </td>
                                                    <td><a href="/usuario{{$movimiento->usuario->id}}">{{$movimiento->usuario->name}}</a>
                                                </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="proyectos">
                            <header class="panel-heading">
                                <h2 class="panel-title">Proyectos</h2>
                            </header>
                            <table id="datatable3" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                               
                                                    <th>Proyecto</th>
                                                    <th>Responsable</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($departamento->usuarios as $usuario)
                                            @if(!is_null($usuario->proyecto))
                                                <tr>
                                                    <td>{{$usuario->proyecto->id}}</td>
                                                    <td><a href="/proyecto">{{$usuario->proyecto->name}}</a></td>
                                                    <td><a href="/usuario{{$usuario->id}}">{{$usuario->name}}</a></td>
                                                </td>
                                                </tr>
                                                @endif
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
    
        $('#datatable2').dataTable();
    
        $('#datatable3').dataTable();
        });
        </script>
@stop