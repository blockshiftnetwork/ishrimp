<!--add Modal-->
<div class="modal fade" id="addSowingPoolModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sembrar Piscina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('pools_sowing.store')}}" method="post">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pool_id">Piscina</label>
                        <select class="form-control" name="pool_id" id="pool_id" required>
                            <option value="" selected>Piscina</option>
                            @foreach($pools as $pool)
                            <option value="{{$pool->id}}">{{$pool->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="planted_larvae">Larvas Sembradas</label>
                        <input class="form-control" type="number" name="planted_larvae" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="larvae_type">Tipo de Larva</label>
                        <input type="text" class="form-control" name="larvae_type" id="larvae_type" required >
                    </div>
                    <div class="form-group">
                        <label for="planted_at">Fecha de Siembra</label>
                        <input type="text" class="form-control" name="planted_at" id="planted_date" required >
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
<div class="modal fade" id="editSowingPoolModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Siembra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('pools_sowing.update','sowing_id')}}" method="post">
            @method('PATCH')
            {{ csrf_field() }}
                <div class="modal-body">
                <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="pool_id">Piscina</label>
                        <select class="form-control" name="pool_id" id="pool_id" required>
                            <option value="" selected>Piscina</option>
                            @foreach($pools as $pool)
                            <option value="{{$pool->id}}">{{$pool->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="planted_larvae">Larvas Sembradas</label>
                        <input class="form-control" type="number" name="planted_larvae" id="planted_larvae" required>
                    </div>
                    <div class="form-group">
                        <label for="larvae_type">Tipo de Larva</label>
                        <input type="text" class="form-control" name="larvae_type" id="larvae_type" required >
                    </div>
                    <div class="form-group">
                        <label for="planted_at">Fecha de Siembra</label>
                        <input type="text" class="form-control" name="planted_at" id="planted_at" required >
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
<div class="modal modal-danger fade" id="deleteSowingPoolModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">{{__('Delete Confirmation')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <form action="{{route('pools_sowing.destroy','sowing_id')}}" method="post">
                @method('delete')
                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        ¿Está seguro de querer eliminar esta siembra?
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

