<!--add Modal-->
<div class="modal fade" id="addPresentationModal" tabindex="-1" role="dialog" aria-labelledby="presentationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="presentationModalLabel">Agregar Presentación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('storePresentation')}}" method="post">
                 {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="resource_id">Recurso</label>
                        <select class="form-control" name="resource_id" id="resource_id" required>
                            <option value="" selected>Seleccione un Recurso</option>
                            @foreach($supplies as $resource)
                            <option value="{{$resource->id}}">{{$resource->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre de la Presentación</label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input class="form-control" type="number" name="quantity" id="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Precio</label>
                        <input class="form-control" type="number" name="price" id="price" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Unidad</label>
                        <input class="form-control" type="text" name="unity" id="unity" required>
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
<div class="modal fade" id="editPresentationModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Presentación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('updatePresentation','presentation_id')}}" method="post">
                 @method('PATCH')
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="resource_id">Recurso</label>
                        <select class="form-control" name="resource_id" id="resource_id" required>
                            <option value="" selected>Seleccione un Recurso</option>
                            @foreach($supplies as $resource)
                            <option value="{{$resource->id}}">{{$resource->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre de la Presentación</label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Cantidad</label>
                        <input class="form-control" type="number" name="quantity" id="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Precio</label>
                        <input class="form-control" type="number" name="price" id="price" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Unidad</label>
                        <input class="form-control" type="text" name="unity" id="unity" required>
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
<div class="modal modal-danger fade" id="deletePresentationModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">{{__('Delete Confirmation')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <form action="{{route('destroyPresentation','presentation_id')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        ¿Está seguro de querer eliminar esta presentación?
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