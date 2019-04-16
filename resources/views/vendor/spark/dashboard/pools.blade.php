<div class="dsh_board_main_body_cont">
    <div class="col-lg-12 border pondsDetailsTop nav nav-bar bg-white">
        <div class="col-lg-3 right_border ">
          <select>
            @foreach($pools as $pool)
            <option data-tokens="{{$pool->pool_id}}">{{$pool->name}}</option>
            @endforeach
</select>

        </div>
        <div class="col-lg-2 right_border mx-1">
            <p>DOC : <br><b class="pond_doc">83 Dias</b></p>
        </div>
        <div class="col-lg-2 right_border">
            <p>PLs Sembrados : <br><b class="pond_pls">751900</b></p>
        </div>
        <div class="col-lg-2 right_border">

            <p>Extensión : <br><b class="pond_wsa">4.26 hectareas</b></p>
        </div>
        <div class="col-lg-3">
           
        </div>
    </div>

    <!-- Ponds information top header end -->
    <div class="mid_container top_space">
        <div role="tabpanel" id="pond-detail-pills">
            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-tabs" role="tablist">
                <li role="presentation" class=" nav-item"><a class="btn btn-light nav-link active" href="#graphs_pill"
                        aria-controls="graphs_section" role="tab" data-toggle="tab">Gráficos</a></li>
                <li role="presentation"><a class="btn btn-light" href="#feed_chart_pill"
                        aria-controls="feed_chart_section" role="tab" data-toggle="tab">Alimentación</a></li>
                <li role="presentation"><a class="btn btn-light" href="#inputs_pill" aria-controls="inputs_section"
                        role="tab" data-toggle="tab">Entradas</a></li>
                <li role="presentation"><a class="btn btn-light" href="#abw_pill" aria-controls="abw_section" role="tab"
                        data-toggle="tab">ABW</a></li>
                <li role="presentation"><a class="btn btn-light" href="#lab_pill" aria-controls="lab_section" role="tab"
                        data-toggle="tab">Pruebas de Laboratorio</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <!-- tab charts-->
            <div role="tabpanel" class="tab-pane active" id="graphs_pill">
                <div class="row mt-5">
                    <div class="col-6">
                        <div class="card">
                            <h4 class="card-title">
                                Crecimiento vs Biomasa
                            </h4>
                            <canvas id="myChart" width="700" height="600"></canvas>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="card">
                            <h4 class="card-title">
                                Balanceado
                            </h4>
                            <canvas id="myChart2" width="700" height="600"></canvas>
                        </div>

                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-6">
                        <div class="card">
                            <h4 class="card-title">
                                PM Balanceado por Hora
                            </h4>
                            <canvas id="myChart3" width="700" height="600"></canvas>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <h4 class="card-title">
                                pH vs DO vs Temp
                            </h4>
                            <canvas id="myChart4" width="700" height="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <!-- tab table  -->
            <div role="tabpanel" class="tab-pane" id="feed_chart_pill">
                <div class="fixed-table-container mt-5">
                    <table id="ponds-snap-tbl" class="bg-white"
                    data-toggle="table"
                    data-classes="table table-striped table-hover table-borderless"
                    data-pagination="true"
                    data-locale="es-ES"
                    data-search="true"
                    data-unique-id="true" style="width:99.9%;">
                        <thead class="thead-primary">
                            <tr>
                                <th data-field="days" data-sortable="true" data-align="center">Días</th>
                                <th data-field="event_date"data-align="center" >Fecha del Evento</th>
                                <th data-field="balanced" data-align="center">Nombre del Balanceado</th>
                                <th data-field="total_day" data-align="center">Total del Día<br>(Kg)</th>
                                <th data-field="cn" data-align="center">Consumo Neto<br> Kg)</th>
                                <th data-field="actions" data-align="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>60</td>
                                <td>21-Jan 19</td>
                                <td>Optiline 35% #5 - Gisis</td>
                                <td>5075</td>
                                <td>5075</td>
                                <td>
                                    <div class="actions btn btn-group-sm">
                                        <a href="" class="btn btn-success btn-xs mr-4">
                                            <i class="fa fa-edit"></i></a>
                                        <a href="" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash-o"></i></a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                    </table>

                    <div class="footer_feed_cont">
                        <div class="row">
                            <div class="one col-md-6">
                                <span>
                                    <i class="fa fa-square" style="color: #1065E6">
                                    </i> Nature Wellness 42% </span>
                                <span><i class="fa fa-square" style="color: #D3402A">
                                    </i> Nature Wellness 42%</span>
                                <span><i class="fa fa-square" style="color: #FFB708">
                                    </i> Nature Wellness 38% </span>
                                <span><i class="fa fa-square" style="color: #008299">
                                    </i> Nature Wellness 35% </span>
                                <span><i class="fa fa-square" style="color: #009856">
                                    </i> Lorica 2 - Gisis: 290.00 Kg</span><span>
                                    <i class="fa fa-square" style="color: #DC4FAD">
                                    </i> Lorica 4 - Gisis: 670.00 Kg</span><span>
                                    <i class="fa fa-square" style="color: #FF8F32">
                                    </i> Optiline 35% </span>
                                <span><i class="fa fa-square" style="color: #5DB2FF">
                                    </i> Optiline 35%</span>
                            </div>
                            <div class="two col-md-2 list-group">
                                <li class="list-group-item"><b>9240.00 Kgs</b></li>
                                <li class="list-group-item">Total de Alimento</li>
                            </div>
                            <div class="three col-md-2 list-group">
                                <li class="list-group-item"><b>5075 Kgs</b></li>
                                <li class="list-group-item">Mayor alimentar</li>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- inputs -->
            <div role="tabpanel" class="tab-pane" id="inputs_pill">
                    <div class="fixed-table-header">
                        <h4 class="text-title mt-4">Medicamentos y Minerales</h4>
                    </div>

                        <table id="ponds-snap-tbl" class="bg-white"
                            data-toggle="table"
                            data-classes="table table-striped table-hover table-borderless"
                            data-pagination="true"
                            data-locale="es-ES"
                            data-search="true">
                            <thead class="thead-primary">
                                <tr>
                                    <th data-field="name"  data-sortable="true" data-align="center">Nombre del Recurso</th>
                                    <th data-field="resource" data-align="center">Tipo de Recurso</th>
                                    <th data-field="quantity" data-align="center">Cantidad en Inventario </th>
                                    <th data-field="date" data-align="center">Fecha del Evento<br>(Kg)</th>
                                    <th data-field="note" data-align="center">Notas</th>
                                    <th data-align="center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>cal</td>
                                    <td>Médicina</td>
                                    <td>250 kg</td>
                                    <td>30-Jan 19</td>
                                    <td>None</td>
                                    <td>
                                        <div class="actions btn btn-group-sm">
                                            <a href="" class="btn btn-success btn-xs mr-4">
                                                <i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>cal</td>
                                    <td>Médicina</td>
                                    <td>250 kg</td>
                                    <td>30-Jan 19</td>
                                    <td>None</td>
                                    <td>
                                        <div class="actions btn btn-group-sm">
                                            <a href="" class="btn btn-success btn-xs mr-4">
                                                <i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>cal</td>
                                    <td>Médicina</td>
                                    <td>250 kg</td>
                                    <td>30-Jan 19</td>
                                    <td>None</td>
                                    <td>
                                        <div class="actions btn btn-group-sm">
                                            <a href="" class="btn btn-success btn-xs mr-4">
                                                <i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>cal</td>
                                    <td>Médicina</td>
                                    <td>250 kg</td>
                                    <td>30-Jan 19</td>
                                    <td>None</td>
                                    <td>
                                        <div class="actions btn btn-group-sm">
                                            <a href="" class="btn btn-success btn-xs mr-4">
                                                <i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                
                    <div class="fixed-table-header">
                        <h4 class="text-title mt-4">Otras entradas</h4>
                    </div>
                   
                      <table id="ponds-snap-tbl" class="table table-striped table-hover bg-white"
                            data-toggle="table"
                            data-classes="table table-striped table-hover table-borderless"
                            data-pagination="true"
                            data-locale="es-ES"
                            data-search="true">
                            <thead class="thead-primary">
                                <tr>
                                    <th data-align="center">Nombre del Recurso</th>
                                    <th data-align="center">Tipo de Recurso</th>
                                    <th data-align="center">Cantidad en Inventario</th>
                                    <th data-align="center">Fecha del Evento<br>(Kg)</th>
                                    <th data-align="center">Notas</th>
                                    <th data-align="center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>cal</td>
                                    <td>Médicina</td>
                                    <td>250 kg</td>
                                    <td>30-Jan 19</td>
                                    <td>None</td>
                                    <td>
                                        <div class="actions btn btn-group-sm">
                                            <a href="" class="btn btn-success btn-xs mr-4">
                                                <i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            

                            </tbody>
                        </table>
              </div>
            <!-- abw -->
            <div role="tabpanel" class="tab-pane" id="abw_pill">
                        <table id="ponds-snap-tbl" class="bg-white"
                            data-toggle="table"
                            data-classes="table table-striped table-hover table-borderless"
                            data-pagination="true"
                            data-locale="es-ES"
                            data-search="true"
                            style="width:99.9%;">
                            <thead class="thead-primary">
                                <tr>
                                    <th data-align="center">Muestras (g)</th>
                                    <th data-align="center">ABW (g)</th>
                                    <th data-align="center">AGW (g)</th>
                                    <th data-align="center">Tasa Balanceado (Kg)</th>
                                    <th data-align="center">Bio-masa (Kg)</th>
                                    <th data-align="center">Supervivencia (%)</th>
                                    <th data-align="center">FCR</th>
                                    <th data-align="center">Fecha del Evento</th>
                                    <th data-align="center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>0</td>
                                    <td>13.45</td>
                                    <td>1.64</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>70</td>
                                    <td>0</td>
                                    <td>28-Juan 19</td>
                                    <td>
                                        <div class="actions btn btn-group-sm">
                                            <a href="" class="btn btn-success btn-xs mr-4">
                                                <i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                   
                    <div class="fixed-table-pagination" style="display: none;">
                    </div>
            </div>
            <!-- Labs -->
            <div role="tabpanel" class="tab-pane" id="lab_pill">
                    <div class="fixed-table-header">
                        <h4 class="text-title mt-4">Otras entradas</h4>
                    </div>
                        <table id="ponds-snap-tbl" class="bg-white"
                            data-toggle="table"
                            data-classes="table table-striped table-hover table-borderless"
                            data-pagination="true"
                            data-locale="es-ES"
                            data-search="true">
                            <thead class="thead-primary">
                                <th data-align="center">factor de conversión</th>
                                <th data-align="center">Salinidad (PPT)</th>
                                <th data-align="center">DO</th>
                                <th data-align="center">CO3</th>
                                <th data-align="center">HCO3</th>
                                <th data-align="center">total</th>
                                <th data-align="center">Dureza (PPM)</th>
                                <th data-align="center">Amoníaco (NH4 +)</th>
                                <th data-align="center">Hierro</th>
                                <th data-align="center">Colonias verdes</th>
                                <th data-align="center">Colonias amarillas</th>
                                <th data-align="center">Fecha de la prueba</th>
                                <th data-align="center">Acciones</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>30-Jan 19</td>

                                    <td>
                                        <div class="actions btn btn-group-sm" style="width: max-content;">
                                            <a href="" class="btn btn-success btn-xs mr-4">
                                                <i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
        </div>
    </div>
</div>

</div>