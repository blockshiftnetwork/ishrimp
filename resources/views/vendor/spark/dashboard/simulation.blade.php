<div id="simulation" class="card" style="min-width: max-content;">
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
                            <td>Densidad Sembrada: Larvas x HA</td>
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
                            <td><input class="form-control" type="text" id="c8"></td>
                        </tr>
                        <tr>
                            <td>Peso cosechado en gr</td>
                            <td><input class="form-control" type="text" id="c9"></td>
                        </tr>
                        <tr>
                            <td>Incremento g (semanal)</td>
                            <td><input class="form-control" type="text" id="c10" readonly></td>
                        </tr>
                        <tr>
                            <td>% Supervivencia</td>
                            <td><input class="form-control" type="text" id="c11"></td>
                        </tr>
                        <tr>
                            <td>Biomasa lbs/ha</td>
                            <td><input class="form-control" type="text" id="c12" readonly></td>
                        </tr>
                        <tr>
                            <td>Biomasa total x piscina</td>
                            <td><input class="form-control" type="text" id="c13" readonly></td>
                        </tr>
                        <tr>
                            <td>Días / Ha </td>
                            <td><input class="form-control" type="text" id="c14" readonly></td>
                        </tr>
                        <tr>
                            <td>FCA</td>
                            <td><input class="form-control" type="text" id="c15" readonly></td>
                        </tr>
                        <tr>
                            <td>Costo Fijo (Cost/Ha/día)</td>
                            <td><input class="form-control" type="text" id="c16"></td>
                        </tr>
                        <tr>
                            <td>Costo FIJO Total / ha (-bal-lar)</td>
                            <td><input class="form-control" type="text" id="c17" readonly></td>
                        </tr>
                        <tr>
                            <td>Costo Balanceado / ha</td>
                            <td><input class="form-control" type="text" id="c18" readonly></td>
                        </tr>
                        <tr>
                            <td>Costo Larva x ha</td>
                            <td><input class="form-control" type="text" id="c19" readonly></td>
                        </tr>
                        <tr>
                            <td>Costo Total x ha</td>
                            <td><input class="form-control" type="text" id="c20" readonly></td>
                        </tr>
                        <tr>
                            <td>Costo Total Piscina</td>
                            <td><input class="form-control" type="text" id="c21" readonly></td>
                        </tr>
                        <tr>
                            <td>Costo/Libra de camarón</td>
                            <td><input class="form-control" type="text" id="c22" readonly></td>
                        </tr>
                        <tr>
                            <td>Precio de Venta x KILO</td>
                            <td><input class="form-control" type="text" id="c23" ></td>
                        </tr>
                        <tr>
                            <td>Precio de Venta x LIBRA</td>
                            <td><input class="form-control" type="text" id="c24" readonly></td>
                        </tr>
                        <tr>
                            <td>Ingreso x ha</td>
                            <td><input class="form-control" type="text" id="c25" readonly></td>
                        </tr>
                        <tr>
                            <td>INGRESO TOTAL CORRIDA</td>
                            <td><input class="form-control" type="text" id="c26" readonly></td>
                        </tr>
                        <tr>
                            <td>Utilidad x ha</td>
                            <td><input class="form-control" type="text" id="c27" readonly></td>
                        </tr>
                        <tr>
                            <td>Utilidad x piscina</td>
                            <td><input class="form-control" type="text" id="c28" readonly></td>
                        </tr>
                        <tr>
                            <td>UP/Ha/día</td>
                            <td><input class="form-control" type="text" id="c29" readonly></td>
                        </tr>
                        <tr>
                            <td>Rentabilidad %</td>
                            <td><input class="form-control" type="text" id="c30" readonly></td>
                        </tr>
                        <tr>
                            <td>Utilidad x libra</td>
                            <td><input class="form-control" type="text" id="c31" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-5 offset-4 position-fixed">
                <table id="table-balanced" class="table table-bordered">
                    <thead class="thead-primary">
                        <th>Producto</th>
                        <th>$/Saco</th>
                        <th>Saco Kg</th>
                        <th>$/Kg</th>
                        <th>Kilos Aplicados</th>
                        <th>Precio Pond.</th>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
                <div class="row">
                <div class="col-md-6">
                    <table id="table-total" class="table table-bordered">

                        <tbody>
                            <tr>
                                <td>Costo Total Balanceado</td>
                                <td><input id="t1" class="form-control" type="text" readonly></td>

                            </tr>
                            <tr>
                                <td>Costo Balanceado x Ha</td>
                                <td><input id="t2" class="form-control" type="text" readonly> </td>

                            </tr>
                            <tr>
                                <td>Total Kilos Alimento</td>
                                <td><input id="t3" class="form-control" type="text" readonly ></td>
                            </tr>
                            <tr>
                                <td>Total Libras Alimento</td>
                                <td><input id="t4" class="form-control" type="text" readonly ></td>
                            </tr>
                            <tr>
                                <td>Total Libras Cosechadas</td>
                                <td><input id="t5" class="form-control" type="text" readonly ></td>
                            </tr>
                            <tr>
                                <td>FCA</td>
                                <td><input id="t6" class="form-control" type="text" readonly></td>
                            </tr>
                        </tbody>

                    </table>
                    
                </div>
                <div class="col-md-4">
                    <div class="form-group w-75">
                            <label for="p1">Precio Ponderado</label>
                            <input class="form-control" type="text" name="p1" id="p1" readonly>
                    </div>
                    <div class="btn-group-md">
                        <button id="pdf" class="btn btn-info btn-lg"> Generar PDF</button>
                    </div>

            </div>                
            </div>

        </div>

    </div>

</div>