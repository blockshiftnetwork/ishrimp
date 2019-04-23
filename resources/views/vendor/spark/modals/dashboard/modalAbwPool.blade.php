<div class="modal fade" id="editAbwPoolModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar ABW</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('updateDaylyABW','abw_id')}}" method="post">
            @method('PATCH')
            {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="abw_id" name="id">
                    <div class="form-group">
                        <label for="resource_id">Piscina</label>
                        <select class="form-control" name="pool_id" id="abw_pool_id"  required>
                            <option value="" selected>Seleccione</option>
                            @foreach($pools as $pool)
                            <option value="{{$pool->pool_id}}">{{$pool->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pool_abw">abw</label>
                        <input class="form-control" type="number" name="abw" id="pool_abw" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="pool_abw">awg</label>
                        <input class="form-control" type="number" name="wg" id="pool_awg" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="pool_survival">Superviviencia</label>
                        <input class="form-control" type="number" name="survival_percent" id="pool_survival" required>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Fecha</label>
                        <input class="form-control" type="text" name="abw_date" id="abw_date" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Fecha</label>
                        <input class="form-control" type="text" name="abw_hour" id="abw_hour" required>
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
<div class="modal modal-danger fade" id="deleteAbwPoolModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">{{__('Delete Confirmation')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <form action="{{route('destroyDaylyABW','abw_id')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        ¿Está seguro de querer eliminar este registro?
                    </p>
                    <input type="hidden" name="id" id="abwe_id" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">{{__('No, Cancel')}}</button>
                    <button type="submit" class="btn btn-warning">{{__('Yes, Delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>