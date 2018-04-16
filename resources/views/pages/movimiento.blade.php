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
<li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="ion-ios-person"></i> Movimientos</a></li>
<li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab"><i class="ion-plus-circled"></i> Añadir</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="list">
<div class="col-md-12">
                                <div class="panel">
                                    <header class="panel-heading">
                                        <h2 class="panel-title">Movimientos Registrados</h2>
                                        
                                    </header>
                                    <div class="panel-body">
                                        <table id="datatable" class="table table-striped dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Movimiento</th>
                                                    <th>Fecha</th>
                                                    <th>Responsable</th>
                                                    <th>Departamento</th>
                                                    <th>SKU</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            @foreach($movimientos as $movimiento)
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
                                                <td><a href="/usuario{{$movimiento->usuario->id}}">{{$movimiento->usuario->name}}</a></td>
                                                <td><a href="/departamento{{$movimiento->usuario->departamento->id}}">{{$movimiento->usuario->departamento->name}}</a></td>
                                                <td><a href="/articulo{{$articulo->id}}">{{$articulo->sku}}</a></td>
                                                <td>{{$articulo->pivot->cantidad}}</td>
                                                <td>{{$articulo->price * $articulo->pivot->cantidad}}</td>
                                                
                                                </tr>
                                            @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
<div role="tabpanel" class="tab-pane" id="new">
    <form class="form-horizontal" method="POST" action="/movimiento/nuevo">
    @csrf
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Tipo de Movimiento</label>
            <div class="col-sm-7">
                <select class="form-control" name="type" onChange="showProveedor(this.value)" required>
                <option disabled selected value style="display:none">Seleccione Tipo</option>
                <option disabled>Entradas</option>
                <option value="1">Compra</option>
                <option value="2">Devolución</option>
                <option value="3">Regalo</option>
                <option disabled>Salidas</option>
                <option value="4">Prestamo</option>
                <option value="5">Extravío</option>
                <option value="6">Daño</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Usuario Responsable</label>
            <div class="col-sm-7">
                <select class="form-control" name="usuario" required>
                <option disabled selected value style="display:none">Asigne a un responsable</option>
                @foreach($usuarios as $usuario)
                <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="form-group" id="proveedorSection">
            
        </div>
        <hr>
        
        <div class="row col-md-offset-1 col-md-10">
        <h4>Artículos a mover</h4> 
        <div class="pull-right form-inline">
                <input id="items"  min="1" max="9" class="form-control" type="number" >
                <button type="button" onclick='addItem()' class="btn btn-lg btn-warning rounded">Añadir Artículo</button>
                </div>
        </div>
        <div id="ticketBody">
        </div>
                
        <div class="row">
            <h4 class="col-md-offset-4 col-md-4" id=total></h4>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-7">
                <button type="submit" class="btn btn-lg btn-primary rounded">Realizar Movimiento</button>
                <div class="pull-right">
                <button type="reset"  class="btn btn-lg btn-warning rounded">Limpiar</button>
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
        <script>
        function addItem(){
            let numberOfItems =  document.getElementById("items").value;
            let ticket = "";
            for (i=0; i<numberOfItems ; i++){
                ticket+="<div class='row form-group'><div class='col-md-3'><label class='control-label'>Producto</label><select name='articulo[]' onchange='getPrice(this.id, this.value)' required class='form-control producto' id='"+i+"prod '><option disabled  selected style='display:none'>Escoja Producto</option>@foreach($articulos as $articulo)<option value='{{$articulo->id}}'>{{$articulo->name}}</option>@endforeach</select></div><div class='col-md-3'><span class='precio' id='"+i+"price'></span></div><div class='col-md-3'><label class='control-label'>Cantidad</label><input class='form-control' name='cantidad[]' value='0' type='number'id='"+i+"cantidad' min='1' onchange='getTotal(this.value, this.id)' required></div><div class='col-md-3'><span>Total: </span><span>$</span><span class='totales' id='total"+i+"'></span></div></div>"
            }
            document.getElementById('ticketBody').innerHTML=ticket;
        }
        </script>
        <script>
        function getPrice(id, value){
            let ide = id;
            let spanId = ide.charAt(0)+"price";
            let url = "/producto/precio";
            $.ajax({
       type: "GET",
       url: url,
       data: "articulo="+value, // serializes the form's elements.
       success: function(data)
       {
           $('#'+spanId).text(""+data); // show response from the php script.
       }
     });
     $('.totales').each(function(){
    sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
});
$('#total').text("$"+sum);
            }
        function getTotal(value, id){
            let value1 = value;
            let id1 = id.charAt(0);

            let precioString = document.getElementById(''+id1+"price").innerHTML;
            let precio = precioString.substring(precioString.indexOf("$") + 1);

            let cantidad = value1;

            let total = cantidad * precio;

            
            $("#total"+id1).text(""+total);

            var sum = 0;
$('.totales').each(function(){
    sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
});
$('#total').text("$"+sum);
        }
function showProveedor(valor){
    let value = valor;
    if(value == 1){
        $("#proveedorSection").html('<label for="name" class="col-sm-3 control-label">Seleccione el proveedor</label><div class="col-sm-7"><select class="form-control" name="proveedor" required>@foreach($proveedores as $proveedor)<option value="{{$proveedor->id}}">{{$proveedor->name}}</option>@endforeach</select></div>');
    }else{
        $("#proveedorSection").html("");
    }
}
       
        </script>
@stop