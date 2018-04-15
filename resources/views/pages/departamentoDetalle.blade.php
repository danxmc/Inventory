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
                        <li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="ion-ios-person"></i>Usuarios</a></li>
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
                                                    <td><a href="/usuario{{$usuario->id}}">{{$usuario->name}}</td>
                                                    <td>
                                                    @if(!is_null($usuario->proyecto))
                                                {{$usuario->proyecto->name}}
                                                @else
                                                NA
                                                @endif
                                                </td>
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