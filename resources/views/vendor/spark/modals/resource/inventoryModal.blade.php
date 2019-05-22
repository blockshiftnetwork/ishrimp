<!--add Modal-->
<div class="modal fade" id="addInventoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('storeInventory')}}" method="post">
            {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="team_id" value="{{Auth::user()->current_team_id}}">
                    <div class="form-group">
                        <label for="resource_id">Recurso</label>
                        <select class="form-control" name="resource_id" id="resource_id" onchange="select(event)" required>
                            <option value="" selected>Recurso</option>
                            @foreach($resources as $resource)
                            <option value="{{$resource->id}}">{{$resource->resource_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input class="form-control" type="number" name="quantity" id="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="presentation_id">Presentación</label>
                        <select class="form-control" name="presentation_id" id="presentation_id" required>
                            <option value="" selected>Presentación</option>
                            
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit modal -->
<div class="modal fade" id="editInventoryModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('updateInventory','inventory_id')}}" method="post">
            @method('PATCH')
            {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="team_id" name="team_id" value="{{Auth::user()->current_team_id}}">
                    <input type="hidden" id="id" name="id">

                    <div class="form-group">
                        <label for="resource_id">Recurso</label>
                        <select class="form-control" name="resource_id" id="resource_id" onchange="select(event)" required>
                            <option value="" selected>Recurso</option>
                            @foreach($resources as $resource)
                            <option value="{{$resource->id}}">{{$resource->resource_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input class="form-control" type="number" name="quantity" id="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="presentation_id">Presentación</label>
                        <select class="form-control" name="presentation_id" id="presentation_id" required>
                            <option value="" selected>Presentación</option>
                           
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal modal-danger fade" id="deleteInventoryModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">{{__('Delete Confirmation')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <form action="{{route('destroyInventory','inventory_id')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        ¿Está seguro de querer eliminar este item del inventario ?
                    </p>
                    <input type="hidden" name="id" id="id" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">{{__('No, Cancel')}}</button>
                    <button type="submit" class="btn btn-warning">{{__('Yes, Delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>