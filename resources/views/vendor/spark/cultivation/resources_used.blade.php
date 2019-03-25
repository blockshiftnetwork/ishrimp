
<div>
    <div id="alert" class="alert alert-success alert-dismissible fade in">
                <strong>Success!</strong> Insumos Agregados con exito
                <button class="btn btn-sm btn-success" data-dismiss="alert" aria-label="close">Continuar</button>

    </div>
    <div class="card card-default">
        <div class="card-header">
            <h5>Insumos y Minerales</h5>
        </div>
        <div class="card-body p-0">
            
                <div class="container p-0 m-0">
                    <div class="row bg-primary text-light m-0" style="width: 100%">
                        <div class="col-12">
                            <div class="form-inline py-2">
                                <label class="mr-2">Fecha</label>
                                <input type="text" class="form-control " id="dateRs" name="date">
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-2">
                                   
                        <table class="table" id="medicine-table" class="bg-white">
                            <thead>   
                                <th>Nombre piscina</th>
                                <th>Recurso</th>
                                <th>Variedad</th>
                                <th>Cantidad</th>
                                <th></th>
                                <th>Nota</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr id="0">
                                  
                                <td>
                                    <select id="pool_id" name="pool_id" class="form-control" required="">
                                        <option value="">Seleccione</option>
                                        @foreach ($pools as $pool)
                                        <option value="{{$pool->id}}">{{$pool->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="resource_id" name="resource_id" class="form-control" required="" onchange="select(event)">
                                        <option value="">Seleccione</option>
                                        @foreach ($resources as $resource)
                                        <option value="{{$resource->id}}">{{$resource->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="presentation_id" name="presentation_id"  class="form-control" required="">
                                        <option value="">Seleccione</option>
                                        
                                    </select>
                                </td>
                                <td>
                                    <input id="quantity" name="quantity" class="form-control" type="text" required="">
                                </td>
                                <td>
                                
                                </td>
                                <td>
                                    <textarea id="note" name="note" class="form-control" cols="30" rows="1" style="max-height: 38px; min-height: 38px;"></textarea>
                                </td>
                                <td>
                                    <span class="btn btn-light btn-duplicate" style="border-radius: 50px; border: 1px solid #ccc;"><b>+</b></span>
                                </td>
                            
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row m-0 p-2">
                            <div class="col-12">
                                <button  onclick="saveDataResourceUsed()" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                    </div>
                  
                
                    <div class="row m-0 p-2">
                        <p><strong>* NA: No Aplica * Kg: Kilo gramos * L: Litros * Rs: Rupias</strong></p>
                    </div>
                </div>
         
        </div>
    </div>
</div>
<form id="data" style="display: none">
        {{ csrf_field() }}
        <input id="pool_id_s" name="pool_id" type="hide" required="">
        <input id="resource_id_s" name="resource_id" type="hide" required="">
        <input id="presentation_id_s" name="presentation_id" type="hide" required="">
        <input id="quantity_s" name="quantity" class="form-control" type="hide" required="">
        <input id="note_s" name="note" class="form-control" type="hide" required="">

</form>
