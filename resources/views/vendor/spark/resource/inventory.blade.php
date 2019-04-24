
<div class="card">
<div class="card-header">
Inventario para la Siembra
</div>
<div class="card-body">
    <section class="section">
        <div class=" " id="feed_table" style="overflow: hidden;">
            <div  class="btn-tools-bar">
                <button type="button" id="addBalanced" class="btn btn-info ml-5" data-toggle="modal"
                    data-target="#addInventoryModal"><i class="fa fa-plus" aria-hidden="true"></i> Añadir al Inventario</button>
            </div>
                <table class="bg-white" id="balanced_tbl"
                class="bg-white"
                data-toggle="table"
                data-classes="table table-striped table-hover table-borderless"
                data-pagination="true"
                data-locale="es-ES"
                data-search="true">
                    <thead class="thead-primary">
                        <tr>
                            <th data-align="center">Nombre del Recurso</th>
                            <th data-align="center">Presentación</th>
                            <th data-align="center">Última Cantidad Comprada</th>
                            <th data-align="center">Última Actualización</th>
                            <th data-align="center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($inventory as $item )
                        <tr>
                            <td>{{$item->resource_name}}</td>
                            <td>{{$item->presentation_name}}</td>
                            <td>{{($item->presentation_quantity * $item->quantity) - $item->used_quatity}} {{$item->presentation_unity}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>
                            <div class="actions btn btn-group-sm">
                                <button id="#edit" data-toggle="modal"
                                data-target="#editInventoryModal"
                                    data-id="{{$item->id}}"
                                    data-resource_id="{{$item->resource_id}}"
                                    data-quantity="{{$item->quantity}}"
                                    data-presentation_id="{{$item->presentation_id}}"
                                    data-team_id="{{$item->team_id}}"
                                    class="btn btn-success btn-xs mr-4">
                                    <i class="fa fa-edit"></i></button>
                                    <button data-toggle="modal"
                                    data-target="#deleteInventoryModal"
                                    data-id="{{$item->id}}"
                                                        class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></button>
                                                </div>
                            </td>
                        </tr>
                     @endforeach
                    </tbody>
                </table>

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