<div class="card" style="min-width: max-content;">
    <div class="card-header">
    </div>
        <div class="card-body">
    <div class="row ">
        <div class="col-md-2">
        <table class="table table-bordered">
        <thead class="thead-primary">
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <tr>
                <td>Piscina</td>
                <td><select class="form-control" name="" id="">
                @foreach($pools as $pool)
                <option value="{{$pool->pool_id}}">{{$pool->name}}</option>
                @endforeach  
                    </select>
                </td>
            </tr>
            <tr>
                <td>Fecha de Siembra</td>
                <td><input class="form-control" type="date" name="" id="" value="2019-05-01"></td>
            </tr>
            <tr>
                <td>Hectareas</td>
                <td><input class="form-control" type="button" value="4.2"></td>
            </tr>
            <tr>
                <td>Precio Ponderado</td>
                <td><input class="form-control" type="text" value="1.4$"></td>
            </tr>
            <tr>
                <td>Densidad Sembrada:  Larvas x HA</td>
                <td><input class="form-control" type="text" value="229.812"></td>
            </tr>
            <tr>
                <td>Precio larva (millar) $</td>
                <td><input class="form-control" type="text"></td>
            </tr>
            <tr>
                <td>Costo Larva Piscina</td>
                <td><input class="form-control" type="text" value="4160$"></td>
            </tr>
            <tr>
                <td>Días corrida</td>
                <td><input class="form-control" type="text" value=""></td>
            </tr>
            <tr>
                <td>Peso cosechado en gr</td>
                <td><input class="form-control" type="text"></td>
            </tr>
            <tr>
                <td>Incremento g (semanal)</td>
                <td><input class="form-control" type="text" value="1,99"></td>
            </tr>
            <tr>
                <td>Biomasa lbs/ha</td>
                <td><input class="form-control" type="text" value="7268"></td>
            </tr>
            <tr>
                <td>Biomasa total x piscina</td>
                <td><input class="form-control" type="text" value="30961"></td>
            </tr>
            <tr>
                <td>Días / Ha </td>
                <td><input class="form-control" type="text" value="391"></td>
            </tr>
            <tr>
                <td>FCA</td>
                <td><input class="form-control" type="text" value="140"></td>
            </tr>
            <tr>
                <td>Costo Fijo (Cost/Ha/día)</td>
                <td><input class="form-control" type="text" value="$42,0"></td>
            </tr>
            <tr>
                <td>Costo FIJO Total / ha (-bal-lar)</td>
                <td><input class="form-control" type="text" value="3330$"></td>
            </tr>
            <tr>
                <td>Costo Balanceado / ha</td>
                <td><input class="form-control" type="text" value="5500$"></td>
            </tr>
            <tr>
                <td>Costo Larva x ha</td>
                <td><input class="form-control" type="text" value="977$"></td>
            </tr>
            <tr>
                <td>Costo Total x ha</td>
                <td><input class="form-control" type="text" value="9873$"></td>
            </tr>
            <tr>
                <td>Costo Total Piscina</td>
                <td><input class="form-control" type="text" value="41905$"></td>
            </tr>
            <tr>
                <td>Costo/Libra de camarón</td>
                <td><input class="form-control" type="text" value="1,35$"></td>
            </tr>
            <tr>
                <td>Precio de Venta x KILO</td>
                <td><input class="form-control" type="text" value=""></td>
            </tr>
            <tr>
                <td>Precio de Venta x LIBRA</td>
                <td><input class="form-control" type="text" value="2,02$"></td>
            </tr>
            <tr>
                <td>Ingreso x ha</td>
                <td><input class="form-control" type="text" value="14660$"></td>
            </tr>
            <tr>
                <td>INGRESO TOTAL CORRIDA</td>
                <td><input class="form-control" type="text" value="62494$"></td>
            </tr>
            <tr>
                <td>Utilidad x ha</td>
                <td><input class="form-control" type="text" value="4863$"></td>
            </tr>
            <tr>
                <td>Utilidad x piscina</td>
                <td><input class="form-control" type="text" value="20586$"></td>
            </tr>
            <tr>
                <td>UP/Ha/día</td>
                <td><input class="form-control" type="text" value="20586$"></td>
            </tr>
            <tr>
                <td>UP/Ha/día</td>
                <td><input class="form-control" type="text" value="53,7$"></td>
            </tr>
            <tr>
                <td>Rentabilidad %</td>
                <td><input class="form-control" type="text" value="49,13%"></td>
            </tr>
            <tr>
                <td>Utilidad x libra</td>
                <td><input class="form-control" type="text" value="0,67$"></td>
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