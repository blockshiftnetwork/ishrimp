
<div>
    <div class="card card-default">
        <div class="card-header">
            <h5 style="margin:0;">Proyecciones</h5>
        </div>
        <div class="card-body p-0">
            
                <div class="container p-0 m-0">
                    <div class="row bg-primary text-light ml-5" style="width: 50%; background: #4396ce !important;">
                        <select id="pool_id" name="pool_id" class="form-control" required="">
                            <option value="">Parametro</option>
                            <option value="Peso Promedio" >Peso Promedio</option>
                            <option value="Peso Promedio" >Balanceado</option>
                            <option value="Peso Promedio" >Sobrevivencia</option>

                        </select>
                    </div>
                    <div class="row m-0 p-2">
                                   
                        <table class="table table-bordered bg-white" id="projection-table">
                            <thead class="thead-primary">   
                                <th>Semana</th>
                                <th>Teorico</th>
                            </thead>
                            <tbody>
                                <tr id="0">
                                  
                                <td>
                                    <input id="quantity" name="quantity" class="form-control" type="text" required="">

                                </td>
                                <td>
                                    <input id="quantity" name="quantity" class="form-control" type="text" required="">

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
                                <button  id="btn_res_used" onclick="saveDataResourceUsed()" class="btn btn-primary">Guardar</button>
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
        <input id="note_s" name="note" class="form-control" type="hide">
        <input id="date_s" name="date" class="form-control" type="hide" required="">

</form>
