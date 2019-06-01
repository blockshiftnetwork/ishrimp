
<div>
    <div class="card card-default">
        <div class="card-header">
            <h5 style="margin:0;">Proyecciones</h5>
        </div>
        <div class="card-body p-0">
            
                <div class="container p-0 m-0">
                    <div class="row bg-primary text-light m-0" style="height: max-content;width: initial;background: rgb(67, 150, 206) !important;padding: 10px;">
                        <div class="col-md-4 mx-4">
                        <select id="pool" name="pool_id" class="form-control" required="">
                            @foreach($pools as $pool)
                            <option value="{{$pool->id}}">{{$pool->name}}</option>
                            @endforeach
                       
                        </select>
                         </div>

                        <div class="col-md-4">
                        <select id="parameter_id" name="parameter_id" class="form-control" required="">
                            <option value="">Parametro</option>
                            <option value="1" >Peso Promedio</option>
                            <option value="2" >Balanceado</option>
                            <option value="3" >Sobrevivencia</option>

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
                                    <input id="week" name="week" class="form-control w-50 mx-auto" type="hidden" value ="1" required="">

                                </td>
                                <td>
                                    <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">
                                    <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">

                                </td>
                             
                            </tr>
                              <tr >
                                  
                                <td>
                                    <span>semana 2</span>
                                    <input id="week" name="week" class="form-control w-50 mx-auto" type="hidden" value ="2" required="">

                                </td>
                                <td>
                                    <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">
                                    <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">

                                </td>
                             
                            </tr>
                              <tr >
                                  
                                <td>
                                    <span>semana 3</span>
                                    <input id="week" name="week" class="form-control w-50 mx-auto" type="hidden" value ="3" required="">

                                </td>
                                <td>
                                    <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">
                                    <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">

                                </td>
                             
                            </tr>
                              <tr>
                                  
                              <td>
                                    <span>semana 4</span>
                                    <input id="week" name="week" class="form-control w-50 mx-auto" type="hidden" value ="4" required="">

                                </td>
                                <td>
                                    <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">
                                    <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">

                                </td>
                             
                            </tr>
                              <tr>
                                  
                               <td>
                                    <span>semana 5</span>
                                    <input id="week" name="week" class="form-control w-50" type="hidden" value ="5" required="">

                                </td>
                                <td>
                                    <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">
                                    <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">

                                </td>
                             
                            </tr>
                            <tr>
                                  
                                  <td>
                                       <span>semana 6</span>
                                       <input id="week" name="week" class="form-control w-50" type="hidden" value ="6" required="">
   
                                   </td>
                                   <td>
                                        <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">
                                       <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">
   
                                   </td>
                                
                               </tr>
                               <tr>
                                  
                                  <td>
                                       <span>semana 7</span>
                                       <input id="week" name="week" class="form-control w-50" type="hidden" value ="7" required="">
   
                                   </td>
                                   <td>
                                        <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">

                                       <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">
   
                                   </td>
                                
                               </tr>
                               <tr>
                                  
                                  <td>
                                       <span>semana 8</span>
                                       <input id="week" name="week" class="form-control w-50" type="hidden" value ="8" required="">
   
                                   </td>
                                   <td>
                                        <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">

                                       <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">
   
                                   </td>
                                
                               </tr>
                               <tr>
                                  
                                  <td>
                                       <span>semana 9</span>
                                       <input id="week" name="week" class="form-control w-50" type="hidden" value ="9" required="">
   
                                   </td>
                                   <td>
                                        <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">

                                       <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">
   
                                   </td>
                                
                               </tr>
                               <tr>
                                  
                                  <td>
                                       <span>semana 10</span>
                                       <input id="week" name="week" class="form-control w-50" type="hidden" value ="11" required="">
   
                                   </td>
                                   <td>
                                        <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">

                                       <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">
   
                                   </td>
                                
                               </tr>
                               <tr>
                                  
                                  <td>
                                       <span>semana 12</span>
                                       <input id="week" name="week" class="form-control w-50" type="hidden" value ="12" required="">
   
                                   </td>
                                   <td>
                                        <input id="id_proyection" name="id" type="hidden" class="form-control projection-id">

                                       <input id="theoretical" name="theoretical" class="form-control w-50 mx-auto val-theoretical" type="number" required="">
   
                                   </td>
                                
                               </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row m-0 p-2">
                            <div class="col-12">
                                <button  id="btn-projections" onclick="saveDataProjections()" class="btn btn-primary">Guardar</button>
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
<form id="projection-data" style="display: none">
        {{ csrf_field() }}
        <input id="id_proyection_s" name="id" type="hide">
        <input id="pool_s" name="pool_id" type="hide" required="">
        <input id="parameter_id_s" name="parameter" type="hide" required="">
        <input id="week_s" name="week" type="hide" required="">
        <input id="theoretical_s" name="theoretical" class="form-control" type="hide" required="">
</form>
