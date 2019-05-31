<!-- modal balanced-->
<!--add Modal-->
<div class="modal fade" id="addBalancedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Balanceado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('resource.store')}}" method="post">
            {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="team_id" value="{{Auth::user()->current_team_id}}">

                        <input type="hidden" id="category_id" name="category_id" value="1">
                       
                    <div class="form-group">
                        <label for="name">Nombre del Recurso</label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label forr="provider_id">Proveedor</label>
                        <input id="provider_id" class="form-control" type="text" name="provider_id">
                    </div>
                     <div class="form-group">
                        <label for="note">Nota</label>
                        <textarea id="note" class="form-control" type="text" name="note" class="form-control"></textarea>
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
<div class="modal fade" id="editBalancedModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Balanced</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('resource.update','resource_id')}}" method="post">
                 @method('PATCH')
                 {{ csrf_field() }}
                 <div class="modal-body">
                    <input type="hidden" name="team_id" value="{{Auth::user()->current_team_id}}">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="category_id" name="category_id" value="1">
                       
                    <div class="form-group">
                        <label for="name">Nombre del Recurso</label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="provider_id">Proveedor</label>
                        <input id="provider_id" class="form-control" type="text" name="provider_id" class="form-control">
                    </div>
                     <div class="form-group">
                        <label for="note">Nota</label>
                        <textarea id="note" class="form-control" type="text" name="note" class="form-control"></textarea>
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
<div class="modal modal-danger fade" id="deleteBalancedModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">{{__('Delete Confirmation')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <form action="{{route('resource.destroy','resource_id')}}" method="post">
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