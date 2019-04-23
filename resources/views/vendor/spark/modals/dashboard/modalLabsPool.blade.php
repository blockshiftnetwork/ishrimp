<div class="modal fade" id="editlabPoolModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Parametros del Día</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('updateDaylyParam','param_id')}}" method="post">
            @method('PATCH')
            {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="param_id" name="id">
                    <div class="form-group">
                        <label for="param_pool_id">Piscina</label>
                        <select class="form-control" name="pool_id" id="param_pool_id"  required>
                            <option value="" selected>Seleccione</option>
                            @foreach($pools as $pool)
                            <option value="{{$pool->pool_id}}">{{$pool->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="laboratory_id">Laboratorio</label>
                        <select class="form-control" name="laboratory_id" id="laboratory_id"  required>
                            <option value="" selected>Seleccione</option>
                            @foreach($laboratories as $lab)
                            <option value="{{$lab->id}}">{{$lab->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ph">ph</label>
                        <input class="form-control" type="number" name="ph" id="ph"  required>
                    </div>
                    <div class="form-group">
                        <label for="ppt">ppt</label>
                        <input class="form-control" type="number" name="ppt" id="ppt"  required>
                    </div>
                    <div class="form-group">
                        <label for="ppm">ppm</label>
                        <input class="form-control" type="number" name="ppm" id="ppm" required>
                    </div>
                    <div class="form-group">
                        <label for="co3">co3</label>
                        <input class="form-control" type="number" name="co3" id="co3" required>
                    </div>
                    <div class="form-group">
                        <label for="hco3">hco3</label>
                        <input class="form-control" type="number" name="hco3" id="hco3" required>
                    </div>
                    <div class="form-group">
                        <label for="ppm_d">ppm-d</label>
                        <input class="form-control" type="number" name="ppm_d" id="ppm_d" required>
                    </div>
                    <div class="form-group">
                        <label for="ppm_a">ppm-a</label>
                        <input class="form-control" type="number" name="ppm_a" id="ppm_a" required>
                    </div>
                    <div class="form-group">
                        <label for="ppm_h">ppm-h</label>
                        <input class="form-control" type="number" name="ppm_h" id="ppm_h" required>
                    </div>
                    <div class="form-group">
                        <label for="temperature">temperatura</label>
                        <input class="form-control" type="number" name="temperature" id="temperature" required>
                    </div>
                    <div class="form-group">
                        <label for="yellow_colonies">Colonias Amarillas</label>
                        <input class="form-control" type="number" name="yellow_colonies" id="yellow_colonies" required>
                    </div>
                    <div class="form-group">
                        <label for="green_colonies">Colonias Verdes</label>
                        <input class="form-control" type="number" name="green_colonies" id="green_colonies" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Fecha</label>
                        <input class="form-control" type="text" name="date" id="param_date" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Hora</label>
                        <input class="form-control" type="text" name="hour" id="param_hour" required>
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
<div class="modal modal-danger fade" id="deletelabPoolModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">{{__('Delete Confirmation')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <form action="{{route('destroyDaylyParam','param_id')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        ¿Está seguro de querer eliminar este registro?
                    </p>
                    <input type="hidden" name="id" id="parame_id" >

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">{{__('No, Cancel')}}</button>
                    <button type="submit" class="btn btn-warning">{{__('Yes, Delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>