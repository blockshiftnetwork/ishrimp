<div class="card" style="min-width: max-content;">
    <div class="card-header">
    </div>
        <div class="card-body">
    <div class="row ">
        <div class="col-md-2">
        <table id="table-left" class="table table-bordered">
        <thead class="thead-primary">
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <tr>
                <td>Piscina</td>
                <td><select class="form-control" name="" id="c1">
                @foreach($pools as $pool)
                <option value="{{$pool->pool_id}}">{{$pool->name}}</option>
                @endforeach  
                    </select>
                </td>
            </tr>
            <tr>
                <td>Fecha de Siembra</td>
                <td><input class="form-control" type="date" name="" id="c2" readonly></td>
            </tr>
            <tr>
                <td>Hectareas</td>
                <td><input class="form-control" type="text" id="c3" readonly></td>
            </tr>
            <tr>
                <td>Precio Ponderado</td>
                <td><input class="form-control" type="text" id="c4" readonly></td>
            </tr>
            <tr>
                <td>Densidad Sembrada:  Larvas x HA</td>
                <td><input class="form-control" type="text" id="c5" readonly></td>
            </tr>
            <tr>
                <td>Precio larva (millar) $</td>
                <td><input class="form-control" type="text" id="c6"></td>
            </tr>
            <tr>
                <td>Costo Larva Piscina</td>
                <td><input class="form-control" type="text" id="c7" readonly></td>
            </tr>
            <tr>
                <td>Días corrida</td>
                <td><input class="form-control" type="text" id="c8" value=""></td>
            </tr>
            <tr>
                <td>Peso cosechado en gr</td>
                <td><input class="form-control" type="text" id="c9" ></td>
            </tr>
            <tr>
                <td>Incremento g (semanal)</td>
                <td><input class="form-control" type="text" id="c10" readonly></td>
            </tr>
             <tr>
                <td>% Supervivencia</td>
                <td><input class="form-control" type="text" id="c11" value="64,3"></td>
            </tr>
            <tr>
                <td>Biomasa lbs/ha</td>
                <td><input class="form-control" type="text" id="c12" readonly></td>
            </tr>
            <tr>
                <td>Biomasa total x piscina</td>
                <td><input class="form-control" type="text" id="c13" value="30961" readonly></td>
            </tr>
            <tr>
                <td>Días / Ha </td>
                <td><input class="form-control" type="text" id="c14" value="391"readonly></td>
            </tr>
            <tr>
                <td>FCA</td>
                <td><input class="form-control" type="text" id="c15" value="140" readonly></td>
            </tr>
            <tr>
                <td>Costo Fijo (Cost/Ha/día)</td>
                <td><input class="form-control" type="text" id="c16" value="$42,0"></td>
            </tr>
            <tr>
                <td>Costo FIJO Total / ha (-bal-lar)</td>
                <td><input class="form-control" type="text" id="c17" value="3330$" readonly></td>
            </tr>
            <tr>
                <td>Costo Balanceado / ha</td>
                <td><input class="form-control" type="text" id="c18" value="5500$" readonly></td>
            </tr>
            <tr>
                <td>Costo Larva x ha</td>
                <td><input class="form-control" type="text" id="c19" value="977$" readonly></td>
            </tr>
            <tr>
                <td>Costo Total x ha</td>
                <td><input class="form-control" type="text" id="c20" value="9873$" readonly></td>
            </tr>
            <tr>
                <td>Costo Total Piscina</td>
                <td><input class="form-control" type="text" id="c21" value="41905$" readonly></td>
            </tr>
            <tr>
                <td>Costo/Libra de camarón</td>
                <td><input class="form-control" type="text" id="c22" value="1,35$" readonly></td>
            </tr>
            <tr>
                <td>Precio de Venta x KILO</td>
                <td><input class="form-control" type="text" id="c23" value="" readonly></td>
            </tr>
            <tr>
                <td>Precio de Venta x LIBRA</td>
                <td><input class="form-control" type="text" id="c24" value="2,02$" readonly></td>
            </tr>
            <tr>
                <td>Ingreso x ha</td>
                <td><input class="form-control" type="text" id="c25" value="14660$" readonly></td>
            </tr>
            <tr>
                <td>INGRESO TOTAL CORRIDA</td>
                <td><input class="form-control" type="text" id="c26" value="62494$" readonly></td>
            </tr>
            <tr>
                <td>Utilidad x ha</td>
                <td><input class="form-control" type="text" id="c27" value="4863$" readonly></td>
            </tr>
            <tr>
                <td>Utilidad x piscina</td>
                <td><input class="form-control" type="text" id="c28" value="20586$" readonly></td>
            </tr>
            <tr>
                <td>UP/Ha/día</td>
                <td><input class="form-control" type="text" id="c29" value="20586$" readonly></td>
            </tr>
            <tr>
                <td>Rentabilidad %</td>
                <td><input class="form-control" type="text" id="c30" value="49,13%" readonly></td>
            </tr>
            <tr>
                <td>Utilidad x libra</td>
                <td><input class="form-control" type="text" id="c31" value="0,67$" readonly></td>
            </tr>
        </tbody>
    </table>
        </div>
        <div class="col-md-5 offset-1">
                <table class="table table-bordered">
                        <thead class="thead-primary">
                            <th>Producto</th>
                            <th>$/Saco</th>
                            <th>Saco Kg</th>
                            <th>$/Kg</th>
                            <th>Kilos Aplicados</th>
                            <th>Precio Pond.</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>NATURE WELLNESS 38% # 3</td>
                                <td><input class="form-control" type="text" value="$33,30"> </td>
                                <td><input class="form-control" type="text" value="25"> </td>
                                <td><input class="form-control" type="text" value="$1,33"></td>
                                <td><input class="form-control" type="text" value="1865"> </td>
                                <td> <input class="form-control" type="text" value="$ 2.484,18"> </td>
                            </tr>
                            <tr>
                                    <td>NATURE WELLNESS 38% # 3</td>
                                    <td><input class="form-control" type="text" value="$33,30"> </td>
                                    <td><input class="form-control" type="text" value="25"> </td>
                                    <td> <input class="form-control" type="text" value="$1,33"></td>
                                    <td><input class="form-control" type="text" value="1865"> </td>
                                    <td> <input class="form-control" type="text" value="$ 2.484,18"> </td>
                                </tr>
                                <tr>
                                        <td>NATURE WELLNESS 38% # 3</td>
                                        <td><input class="form-control" type="text" value="$33,30"> </td>
                                        <td><input class="form-control" type="text" value="25"> </td>
                                        <td> <input class="form-control" type="text" value="$1,33"></td>
                                        <td><input class="form-control" type="text" value="1865"> </td>
                                        <td> <input class="form-control" type="text" value="$ 2.484,18"> </td>
                                    </tr>
                        </tbody>

            </table>
            <div class="col-md-12">
                    <table class="table table-bordered">
                           
                            <tbody>
                                <tr>
                                    <td>Costo Total Balanceado</td>
                                    <td><input class="form-control" type="text" value="$33,30"></td>
                                  
                                </tr>
                                <tr>
                                        <td>NATURE WELLNESS 38% # 3</td>
                                        <td><input class="form-control" type="text" value="$33,30"> </td>
                                      
                                    </tr>
                                    <tr>
                                            <td>NATURE WELLNESS 38% # 3</td>
                                            <td><input class="form-control" type="text" value="$33,30"></td>
                                        </tr>
                            </tbody>
    
                </table>
            </div>
        </div>
       
    </div>
   
    </div>
        <div class="card-footer">

        </div>
    
</div>