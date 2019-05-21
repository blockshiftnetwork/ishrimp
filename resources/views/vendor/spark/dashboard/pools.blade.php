<div class="dsh_board_main_body_cont">
    <div class="col-lg-12 border pondsDetailsTop nav nav-bar py-3" style="background:#4396ce !important; color: #fff;">
        <div class="col-lg-4 right_border ">
        @if(count($pools) > 0)
            <select id="select_pool">
                @foreach($pools as $pool)
                <option data-tokens="{{$pool->pool_id}}" value="{{$pool->pool_id}}">{{$pool->name}}</option>
                @endforeach
            </select>
            @else
			<a class="text-weight-bold text-danger btn btn-inline btn-light" href="/home?tab=2">Debe agregar piscinas</a>
			@endif
        </div>
        <div class="col-lg-4 right_border">
            <p class="my-1">PLs Sembrados: <br><b class="pond_pls">NA</b></p>
        </div>
        <div class="col-lg-2 right_border">
            <p class="my-1">Días: <br><b class="pond_doc">NA</b></p>
        </div>
        <div class="col-lg-2 right_border">

            <p class="my-1">Extensión: <br><b class="pond_wsa">NA</b></p>
        </div>
    </div>

    <!-- Ponds information top header end -->
    <div class="mid_container top_space">
        <div role="tabpanel" id="pond-detail-pills">
            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-tabs" role="tablist">
                <li role="presentation" class=" nav-item"><a class="btn btn-light active" href="#graphs_pill"
                        aria-controls="graphs_section" role="tab" data-toggle="tab">Gráficos</a></li>
                <li role="presentation"><a class="btn btn-light" href="#balanced_table_chart"
                        aria-controls="feed_chart_section" role="tab" data-toggle="tab">Alimentación</a></li>
                <li role="presentation"><a class="btn btn-light" href="#inputs_pill" aria-controls="inputs_section"
                        role="tab" data-toggle="tab">Insumos</a></li>
                <li role="presentation"><a class="btn btn-light" href="#abw_pill" aria-controls="abw_section" role="tab"
                        data-toggle="tab">Peso Promedio</a></li>
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
                    <!--<div class="col-6">
                        <div class="card">
                            <h4 class="card-title">
                                PM Balanceado por Hora
                            </h4>
                            <canvas id="myChart3" width="700" height="600"></canvas>
                        </div>
                    </div>-->

                    <div class="col-6">
                        <div class="card">
                            <h4 class="card-title">
                                Oxígeno vs Temperatura
                            </h4>
                            <canvas id="myChart4" width="700" height="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <!-- tab table  -->
            <div role="tabpanel" class="tab-pane" id="balanced_table_chart">
                <div class="fixed-table-container">
                    <table id="table_staticstic_balanced" class="bg-white"></table>

                    <div class="footer_feed_cont">
                        <div class="row" style="margin:0 auto;">
                             <div class="two col-md-2"></div>
                            <div class="two col-md-4 list-group">
                                <li id="totalBalanced" class="list-group-item text-center"></li>
                                <li class="list-group-item text-center">Total de Balanceado</li>
                            </div>
                            <div class="three col-md-4 list-group">
                                <li id="maxBalanced" class="list-group-item text-center"></li>
                                <li class="list-group-item text-center">Mayor Cantidad Usada</li>
                            </div>
                            <div class="two col-md-2"></div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- inputs -->
            <div role="tabpanel" class="tab-pane" id="inputs_pill">
                <!--<div class="fixed-table-header">
                    <h4 class="text-title mt-4">Medicamentos y Minerales</h4>
                </div> -->

                <table id="table_statistic_resource" class="bg-white">
                </table>

                <!-- <div class="fixed-table-header">
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
                        </table> -->
            </div>
            <!-- abw -->
            <div role="tabpanel" class="tab-pane" id="abw_pill">
                <table id="table_statistic_abw" class="bg-white" >
                </table>
            </div>
            <!-- Labs -->
            <div role="tabpanel" class="tab-pane" id="lab_pill">
                <!--<div class="fixed-table-header">
                    <h4 class="text-title mt-4">Pruebas de laboratorio</h4>
                </div> -->
                <table id="statistic_table_param" class="bg-white">
                </table>
            </div>
        </div>
    </div>
    
</div>