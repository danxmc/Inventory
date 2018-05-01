@extends('layouts.admin')
@section('css')
@stop
@section('content')
<div class="row">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    
                        <!-- Nav tabs -->
                        <ul class="list-inline tabs-bordered margin-b-20" role="tablist">
<li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="ion-ios-person"></i> Usuarios</a></li>
<li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab"><i class="ion-plus-circled"></i> Añadir</a></li>
                        </ul>
                        <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="list">
                            <header class="panel-heading">
                                <h2 class="panel-title">Usuarios Registrados</h2>
                            </header>
                            <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>RFC</th>
                                                    <th>Nombre</th>
                                                    <th>Posición</th>
                                                    <th>Departamento</th>
                                                    <th>Administrador</th>
                                                    <th>Dar de Baja</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($usuarios as $usuario)
                                            <tr>
                                                <td>{{$usuario->id}}</td>
                                                <td><a href="/usuario{{$usuario->id}}">{{$usuario->rfc}}</a></td>
                                                <td>{{$usuario->name}}</td>
                                                <td>{{$usuario->position}}</td>
                                                <td><a href="/departamento{{$usuario->departamento->id}}">{{$usuario->departamento->name}}</a></td>
                                                <td>
                                                @if(!is_null($usuario->proyecto))
                                                {{$usuario->proyecto->name}}
                                                @else
                                                NA
                                                @endif
                                                </td>
                                                <td><form method="POST" action="/usuario/delete" onSubmit="return confirm('¿Seguro de dar de baja?')">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$usuario->id}}">
                                                <button type="submit" class="btn btn-info btn-circle btn-icon ">
                                                <i class="fa fa-trash"></i></button>
                                                </form>
                                                </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                        </div>
                   
                    
<div role="tabpanel" class="tab-pane" id="new">
    <form class="form-horizontal" method="POST" action="/usuario/nuevo">
    @csrf
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Nombre Completo</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="name" name="name" >
            </div>
        </div>
        
        <div class="form-group">
            <label for="position" class="col-sm-3 control-label">Puesto</label>
            <div class="col-sm-7">
                <input required type="text" class="form-control" id="position" name="position">
            </div>
        </div>
         <div class="form-group">
            <label for="about" class="col-sm-3 control-label">RFC</label>
            <div class="col-sm-7">
                <input required required type="text" class="form-control" name="rfc" maxlenght="9" minlenght="9">
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
        <hr>
        
        <h4>Información Personal</h4>
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
            <label for="gender" class="col-sm-3 control-label">Sexo</label>
            <div class="col-sm-7">
            
                <div>
                <label>
                <input required type="radio"  name="gender" value="M">Hombre
                </label>
                </div>
                <div>
                <label>
                <input required type="radio"  name="gender" value="F">Mujer
                </label>
                </div>
                <div>
                <label>
                <input required type="radio"  name="gender" value="O">Otro
            </label>
            </div></di
            v>
        </div>
         <div class="form-group">
             <label for="bd" class="col-sm-3 control-label"> Fecha Nacimiento</label>
            <div class="col-sm-7">
                <input required type="date" class="form-control" id="bd" name="birth_date">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-7">
                <button type="submit" class="btn btn-lg btn-primary rounded">Añadir Usuario</button>
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