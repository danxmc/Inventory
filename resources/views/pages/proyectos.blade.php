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
<li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="ion-ios-person"></i> Proyectos</a></li>
<li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab"><i class="ion-plus-circled"></i> Añadir</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="list">
<div class="col-md-12">
                                <div class="panel">
                                    <header class="panel-heading">
                                        <h2 class="panel-title">Proyectos Registrados</h2>
                                    </header>
                                    <div class="panel-body">
                                        <table id="datatable" class="table table-striped dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Fecha Fin</th>
                                                    <th>Departamento</th>
                                                    <th>Responsable</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($proyectos as $key=>$proyecto)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$proyecto->name}}</td>
                                                <td>{{$proyecto->start_date}}</td>
                                                <td>{{$proyecto->end_date}}</td>
                                                <td>{{$proyecto->departamento->name}}</td>
                                                <td>{{$proyecto->manager->rfc}}</td>
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
    <form class="form-horizontal" method="POST" action="/proyecto/nuevo">
    @csrf
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Nombre</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="name" name="name" >
            </div>
        </div>
        
        <div class="form-group">
            <label for="start_date" class="col-sm-3 control-label">Fecha Inicio</label>
            <div class="col-sm-7">
                <input required type="date" class="form-control" id="start_date" name="start_date">
            </div>
        </div>
        <div class="form-group">
            <label for="end_date" class="col-sm-3 control-label">Fecha Fin</label>
            <div class="col-sm-7">
                <input required type="date" class="form-control" id="end_date" name="end_date">
            </div>
        </div>
        <div class="form-group">
            <label for="about" class="col-sm-3 control-label">Departamento</label>
            <div class="col-sm-7">
                <select required class="form-control" name="departamento">
                <option disabled selected style="display:none">Asigne un departamento</option>
                    @foreach($departamentos as $departamento)
                    <option value="{{$departamento->id}}">{{$departamento->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="about" class="col-sm-3 control-label">Responsable</label>
            <div class="col-sm-7">
                <select required class="form-control" name="Responsable">
                <option disabled selected style="display:none">Asigne un Responsable</option>
                    @foreach($Responsables as $Responsable)
                    <option value="{{$Responsable->id}}">{{$Responsable->name}}</option>
                    @endforeach
                </select>
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