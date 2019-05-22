
<div>
    <div class="card card-default">
        <div class="card-header">
            <h5 style="margin:0;">Proyecciones</h5>
        </div>
        <div class="card-body p-0">
            
                <div class="container p-0 m-0">
                    <div class="row bg-primary text-light m-0" style="height: max-content;width: initial;background: rgb(67, 150, 206) !important;padding: 10px;">
                        <div class="col-md-4 mx-4">
                        <select id="pool_id" name="pool_id" class="form-control" required="">
                            <option value="">Piscina</option>
                            <option value="Peso Promedio" >Piscina 1</option>
                            <option value="Peso Promedio" >Piscina 2</option>
                            <option value="Peso Promedio" >Piscina 3</option>
                       
                        </select>
                         </div>

                        <div class="col-md-4">
                        <select id="pool_id" name="pool_id" class="form-control" required="">
                            <option value="">Parametro</option>
                            <option value="Peso Promedio" >Peso Promedio</option>
                            <option value="Peso Promedio" >Balanceado</option>
                            <option value="Peso Promedio" >Sobrevivencia</option>

                        </select>
                        </div>
                    </div>
                    <div class="row m-0 p-2">
                                   
                        <table class="bg-white mx-auto table table-bordered w-50 text-center" id="projection-table">
                            <thead class="thead-primary">   
                                <th>Semana</th>
                                <th>Teorico</th>
                            </thead>
                            <tbody>
                                <tr>
                                  
                                <td>
                                    <span>semana 1</span>
                                    <input id="quantity" name="quantity" class="form-control w-50 mx-auto" type="hidden" value ="1" required="">

                                </td>
                                <td>
                                    <input id="quantity" name="quantity" class="form-control w-50 mx-auto" type="number" required="">

                                </td>
                             
                            </tr>
                              <tr >
                                  
                                <td>
                                    <span>semana 2</span>
                                    <input id="quantity" name="quantity" class="form-control w-50 mx-auto" type="hidden" value ="2" required="">

                                </td>
                                <td>
                                    <input id="quantity" name="quantity" class="form-control w-50 mx-auto" type="number" required="">

                                </td>
                             
                            </tr>
                              <tr >
                                  
                                <td>
                                    <span>semana 3</span>
                                    <input id="quantity" name="quantity" class="form-control w-50 mx-auto" type="hidden" value ="2" required="">

                                </td>
                                <td>
                                    <input id="quantity" name="quantity" class="form-control w-50 mx-auto" type="number" required="">

                                </td>
                             
                            </tr>
                              <tr>
                                  
                              <td>
                                    <span>semana 4</span>
                                    <input id="quantity" name="quantity" class="form-control w-50 mx-auto" type="hidden" value ="4" required="">

                                </td>
                                <td>
                                    <input id="quantity" name="quantity" class="form-control w-50 mx-auto" type="number" required="">

                                </td>
                             
                            </tr>
                              <tr>
                                  
                               <td>
                                    <span>semana 4</span>
                                    <input id="quantity" name="quantity" class="form-control w-50" type="hidden" value ="4" required="">

                                </td>
                                <td>
                                    <input id="quantity" name="quantity" class="form-control w-50 mx-auto" type="number" required="">

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
