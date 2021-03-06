@php
$valid = false;
@endphp
@foreach($inventory as $item )
@if(!is_null($item->inventory_resource_id))
@php
$valid = true;
@endphp
@endif
@endforeach

<div class="card">
<div class="card-header">
    <span class="font-weight-bold" style="line-height: 2.3em; vertical-align: -webkit-baseline-middle;">Inventario para la Siembra</span>
    <div class="float-right search "></div>
</div>
<div class="card-body" style="padding-top: 0;">
    <section class="section">
        <div class=" " id="feed_table" style="overflow: hidden;">
            <div  class="btn-tools-bar">

            </div>
           
                <table class="bg-white" id="balanced_tbl"
                class="bg-white"
                data-toggle="table"
                data-classes="table table-striped table-hover table-borderless"
                data-pagination="true"
                data-locale="es-ES"
                data-search="true">
                @if($valid)
                    <thead class="thead-primary">
                        <tr>
                            <th data-align="center">Nombre del Recurso</th>
                            <th data-align="center">Presentación</th>
                            <th data-align="center">Cantidad Sembrada</th>
                            <th data-align="center">Existencia en inventario</th>
                            <th data-align="center">Última Actualización</th>
                            <th data-align="center">Acciones</th>
                         
                        </tr>
                        
                    </thead>
                    @else
                    <thead class="thead-primary">
                        <tr>
                            <th data-align="center">Nombre del Recurso</th>
                            <th data-align="center">Presentación</th>
                            <th data-align="center">Cantidad Sembrada</th>
                            <th data-align="center">Existencia en inventario</th>
                            <th data-align="center"></th>
                            <th data-align="center"></th>
                        </tr>
                    </thead>
                    @endif
                    <tbody>
                    @foreach($inventory as $item )
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->presentation_name}}</td>
                            <td>{{$item->qty_used_in_pools}}</td>
                            <td>{{$item->existence_qty}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>
                    @if(!is_null($item->inventory_resource_id))
                   
                    
                            <div class="actions btn btn-group-sm">
                                <button id="#edit" data-toggle="modal"
                                data-target="#editInventoryModal"
                                    data-id="{{$item->inventory_resource_id}}"
                                    data-resource_id="{{$item->resource_id}}"
                                    data-quantity="{{$item->ir_quantity}}"
                                    data-presentation_id="{{$item->presentation_id}}"
                                    data-team_id="{{$item->team_id}}"
                                    class="btn btn-success btn-xs mr-4">
                                    <i class="fa fa-edit"></i></button>
                                    <button data-toggle="modal"
                                    data-target="#deleteInventoryModal"
                                    data-id="{{$item->inventory_resource_id}}"
                                                        class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></button>
                                                </div>
                    @endif
                            </td>
                        </tr>
                     @endforeach
                    </tbody>
                </table>
                <button type="button" id="addBalanced" class="btn btn-primary ml-1 mb-2" data-toggle="modal"
                    data-target="#addInventoryModal"><i class="fa fa-plus" aria-hidden="true"></i> Añadir al Inventario</button>
            <div class="footer">
                <div class="row">
                    <div class="one col-md-6">
                        <span class="font-weight-bold">* NA: No Aplica * Kg: Kilo gramos * L: Litros * Rs: Rupias</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</div>
   <!-- Modals Sowing Balanced -->
@include('spark::modals.resource.inventoryModal')