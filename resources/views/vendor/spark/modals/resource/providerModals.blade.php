<!--add Modal-->
<div class="modal fade" id="addProviderModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('provider.store')}}" method="post">
            <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nombre del Proveedor</label>
                        <input class="form-control" type="text" name="name" id="name" required="">
                    </div>
                    <div class="form-group">
                        <label for="Phone">Número de teléfono</label>
                        <input class="form-control" type="tel" name="phone" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Email</label>
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Dirección</label>
                        <input class="form-control" type="text" name="address" id="address" required>
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
<div class="modal fade" id="editProviderModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('provider.update','provider')}}" method="post">

                <div class="modal-body">
                    @method('PATCH')
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id" required="">
                    <div class="form-group">
                        <label for="name">Nombre del Proveedor</label>
                        <input class="form-control" type="text" name="name" id="name" required="">
                    </div>
                    <div class="form-group">
                        <label for="Phone">Número de teléfono</label>
                        <input class="form-control" type="tel" name="phone" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Email</label>
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Dirección</label>
                        <input class="form-control" type="text" name="address" id="address" required>
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
<div class="modal modal-danger fade" id="deleteProviderModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">{{__('Delete Confirmation')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <form action="{{route('provider.destroy','provider')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        ¿Está seguro de querer eliminar este proveedor?
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