<div class="modal fade" id="editbalancedPoolModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('updateUsed','used_id')}}" method="post">
            @method('PATCH')
            {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="balanced_id" name="id">
                    <div class="form-group">
                        <label for="resource_id">Piscina</label>
                        <select class="form-control" name="pool_id" id="balanced_pool_id"  required>
                            <option value="" selected>Seleccione</option>
                            @foreach($pools as $pool)
                            <option value="{{$pool->pool_id}}">{{$pool->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="resource_id">Recurso</label>
                        <select class="form-control" name="resource_id" id="balanced_resource_id" required>
                            <option value="" selected>Recurso</option>
                            @foreach($balanceds as $resource)
                            <option value="{{$resource->id}}">{{$resource->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="presentation_id">Presentación</label>
                        <select class="form-control" name="presentation_id" id="balanced_presentation_id" required>
                            <option value="" selected>Presentación</option>
                           
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input class="form-control" type="number" name="quantity" id="balanced_quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Nota</label>
                        <textArea class="form-control" name="note" id="balanced_note" required></textArea>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Fecha</label>
                        <input class="form-control" type="text" name="date" id="balanced_date" required>
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
<div class="modal modal-danger fade" id="deletebalancedPoolModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">{{__('Delete Confirmation')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <form action="{{route('destroyUsed','used_id')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        ¿Está seguro de querer eliminar este recurso?
                    </p>
                    <input type="hidden" name="id" id="balanced_id" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">{{__('No, Cancel')}}</button>
                    <button type="submit" class="btn btn-warning">{{__('Yes, Delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>