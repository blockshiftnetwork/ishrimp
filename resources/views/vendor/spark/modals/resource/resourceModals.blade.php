<!--add Modal-->
<div class="modal fade" id="addResourceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Recurso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="category_id">Tipo de recurso</label>
                        <select class="form-control" name="category_id" id="category_id" required>
                            <option value="" selected>Tipo de Recurso</option>
                            <option value="1">Insumo</option>
                            <option value="1">Balanceado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="present_id" id="present_id" required>
                            <option value="" selected>Presentación</option>
                            <option value="1">25 kg</option>
                            <option value="1">50 kg</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre del Recurso</label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Cantidad</label>
                        <input class="form-control" type="number" name="quantity" id="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Proveedor</label>
                        <select class="form-control" name="provider_id" id="provider_id" required>
                            <option value="" selected>Tipo de Recurso</option>
                            <option value="1">Insumo</option>
                            <option value="1">Balanceado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="button" class="btn btn-primary">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit modal -->
<div class="modal fade" id="editResourceModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Recurso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="" method="post">
                <div class="modal-body">
                    @method('PATCH')
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="category_id">Tipo de recurso</label>
                        <select class="form-control" name="category_id" id="category_id" required>
                            <option value="" selected>Tipo de Recurso</option>
                            <option value="1">Insumo</option>
                            <option value="1">Balanceado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="present_id" id="present_id" required>
                            <option value="" selected>Presentación</option>
                            <option value="1">25 kg</option>
                            <option value="1">50 kg</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre del Recurso</label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Cantidad</label>
                        <input class="form-control" type="number" name="quantity" id="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Proveedor</label>
                        <select class="form-control" name="provider_id" id="provider_id" required>
                            <option value="" selected>Tipo de Recurso</option>
                            <option value="1">Insumo</option>
                            <option value="1">Balanceado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="button" class="btn btn-primary">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal modal-danger fade" id="deleteResourceModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">{{__('Delete Confirmation')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <form action="" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        ¿Está seguro de querer eliminar este recurso?
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