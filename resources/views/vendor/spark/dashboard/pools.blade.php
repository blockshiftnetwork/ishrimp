<div class="dsh_board_main_body_cont">
    <div class="col-lg-12 border pondsDetailsTop nav nav-bar bg-white">
        <div class="col-lg-3 right_border ">
            <li class="dropdown ponds-dropdown ui search dropdown">
                <a href="#" class="dropdown-toggle toggle-dropdown ponds_pondname" data-toggle="dropdown" role="button"
                    aria-expanded="false"><span class="pond-name">Piscina 2</span><span class="caret"></span></a>
                <div class="dropdown-menu pond_menu_li ">
                    <input type="text" class="form-control" id="search_pond" name="search"
                        placeholder="Buscar Piscina ..." style="width: 98%;margin: 0 1%;">
                    <ul class="menu-dropdown search-list" role="menu"
                        style="margin: 5px 0 0;line-height: 30px; width: 100%;">
                        <li class="nodata" style="display:none;">No se encontraron coincidencias</li>
                        <li class="searchlist_li"><a href="javascript: void(0)"  class="pond-dropdown">Piscina 2</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)"  class="pond-dropdown">Piscina 3</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)" class="pond-dropdown">Piscina 4</a></li>
                    </ul>
                </div>
            </li>
        </div>
        <div class="col-lg-2 right_border">
            <p>DOC : <br><b class="pond_doc">83 Dias</b></p>
        </div>
        <div class="col-lg-2 right_border">
            <p>PLs Sembrados : <br><b class="pond_pls">751900</b></p>
        </div>
        <div class="col-lg-2 right_border">

            <p>Extensión :  <br><b class="pond_wsa">4.26 hectareas</b></p>
        </div>
        <div class="col-lg-3">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle toggle-dropdown ponds_pondname" data-toggle="dropdown" role="button"
                    aria-expanded="false"><span class="button_name">Cultivo Actual</span> <span
                        class="caret"></span></a>
                <ul class="dropdown-menu menu-dropdown harvest-dropdown" role="menu">
                    <li><a href="javascript:void(0)" id="current" class="harvests">Cultivo Actual</a></li>
                </ul>
            </li>
        </div>
    </div>

    <!-- Ponds information top header end -->
    <div class="mid_container top_space">
        <div role="tabpanel" id="pond-detail-pills">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a class="btn btn-light" href="#graphs_pill" aria-controls="graphs_section" role="tab"
                        data-toggle="tab">Gráficos</a></li>
                <li role="presentation"><a class="btn btn-light"  href="#feed_chart_pill" aria-controls="feed_chart_section" role="tab"
                        data-toggle="tab">Alimentación</a></li>
                <li role="presentation"><a class="btn btn-light"  href="#inputs_pill" aria-controls="inputs_section" role="tab"
                        data-toggle="tab">Entradas</a></li>
                <li role="presentation"><a class="btn btn-light"  href="#abw_pill" aria-controls="abw_section" role="tab"
                        data-toggle="tab">ABW</a></li>
                <li role="presentation"><a class="btn btn-light"  href="#lab_pill" aria-controls="lab_section" role="tab"
                        data-toggle="tab">Pruebas de Laboratorio</a></li>
            </ul>
        </div>
            <div class="tab-content">
                <!-- tab charts-->
                <div role="tabpanel" class="tab-pane active" id="graphs_pill">
                    <div class="row mt-5" >
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
                        <div class="row mt-5" >
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
                        <div class="fixed-table-header">
                            <table>
                            </table>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading" style="top: 37px; display: none;">Cargando,por favor
                                espere...</div>
                            <table id="ponds-snap-tbl" class="table table-striped table-hover bg-white"
                                style="width:99.9%;">
                                <thead class="thead-primary">
                                    <tr>

                                        <th style="">
                                            <div class="th-inner sortable text-center">Días</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Fecha del Evento</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Nombre del Balanceado</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Total del Día<br>(Kg)</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Consumo Neto<br> Kg)</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Acciones</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="text-center"  rowspan="1">60</td>
                                        <td class="text-center" rowspan="1">21-Jan 19</td>
                                        <td class="text-center">Optiline 35% #5 - Gisis</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">
                                            <div class="actions btn btn-group-sm">
                                                <a href="" class="btn btn-success btn-xs mr-4">
                                                    <i class="fa fa-edit"></i></a>
                                                    <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash-o" ></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" rowspan="1">58</td>
                                        <td class="text-center" rowspan="1">20-Jan 19</td>
                                        <td class="text-center">Optiline 35% </td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                        <a href="javascript:void(0)"  class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o" ></i></a>
                                                </div>
                                            </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" rowspan="1">58</td>
                                        <td class="text-center" rowspan="1">19-Jan 19</td>
                                        <td class="text-center">Optiline 35% </td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o" ></i></a>
                                                </div>
                                            </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" rowspan="1">57</td>
                                        <td class="text-center" rowspan="1">14-Jan 19</td>
                                        <td class="text-center">Optiline 35% </td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o" ></i></a>
                                                </div>
                                            </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="fixed-table-pagination" style="display: none;">
                        </div>
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
                                                    <li class="list-group-item" >Total de Alimento</li>
                                                </div>
                                                <div class="three col-md-2 list-group">
                                                    <li  class="list-group-item"><b>5075 Kgs</b></li>
                                                    <li  class="list-group-item">Mayor alimentar</li>
                                                </div>
                                        </div>

                            </div>
                    </div>

                </div>
                <!-- inputs -->
                <div role="tabpanel" class="tab-pane" id="inputs_pill">

                        <div class="fixed-table-container mt-5">
                        <div class="fixed-table-header">
                                <h4 class="text-title mt-4">Medicamentos y Minerales</h4>
                                <div class="pull-right search mb-2">
                                        <input class="form-control" type="text" placeholder="Buscar">
                                    </div>
                                    </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading" style="top: 37px; display: none;">Cargando,por favor
                                espere...</div>
                            <table id="ponds-snap-tbl" class="table table-striped table-hover bg-white"
                                style="width:99.9%;">
                                <thead class="thead-primary">
                                    <tr>

                                        <th style="">
                                            <div class="th-inner sortable text-center">Nombre del Recurso</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Tipo de Recurso</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Cantidad en Inventario</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Fecha del Evento<br>(Kg)</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Notas</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Acciones</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="text-center"  rowspan="1">cal</td>
                                        <td class="text-center" rowspan="1">Médicina</td>
                                        <td class="text-center">250 kg</td>
                                        <td class="text-center">30-Jan 19</td>
                                        <td class="text-center">None</td>
                                        <td class="text-center">
                                            <div class="actions btn btn-group-sm">
                                                <a href="" class="btn btn-success btn-xs mr-4">
                                                    <i class="fa fa-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash-o" ></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                            <td class="text-center"  rowspan="1">cal</td>
                                            <td class="text-center" rowspan="1">Médicina</td>
                                            <td class="text-center">250 kg</td>
                                            <td class="text-center">30-Jan 19</td>
                                            <td class="text-center">None</td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                    <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o" ></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                                <td class="text-center"  rowspan="1">cal</td>
                                                <td class="text-center" rowspan="1">Médicina</td>
                                                <td class="text-center">250 kg</td>
                                                <td class="text-center">30-Jan 19</td>
                                                <td class="text-center">None</td>
                                                <td class="text-center">
                                                    <div class="actions btn btn-group-sm">
                                                        <a href="" class="btn btn-success btn-xs mr-4">
                                                            <i class="fa fa-edit"></i></a>
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                            <i class="fa fa-trash-o" ></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                    <td class="text-center"  rowspan="1">cal</td>
                                                    <td class="text-center" rowspan="1">Médicina</td>
                                                    <td class="text-center">250 kg</td>
                                                    <td class="text-center">30-Jan 19</td>
                                                    <td class="text-center">None</td>
                                                    <td class="text-center">
                                                        <div class="actions btn btn-group-sm">
                                                            <a href="" class="btn btn-success btn-xs mr-4">
                                                                <i class="fa fa-edit"></i></a>
                                                            <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                                <i class="fa fa-trash-o" ></i></a>
                                                        </div>
                                                    </td>
                                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="fixed-table-pagination" style="display: none;">
                        </div>
                    </div>


                    <div class="fixed-table-container mt-5">
                            <div class="fixed-table-header">
                                    <h4 class="text-title mt-4">Otras entradas</h4>
                                    <div class="pull-right search mb-2">
                                            <input class="form-control" type="text" placeholder="Buscar">
                                        </div>
                                    </div>
                            <div class="fixed-table-body">
                                <div class="fixed-table-loading" style="top: 37px; display: none;">Cargando,por favor
                                    espere...</div>
                                <table id="ponds-snap-tbl" class="table table-striped table-hover bg-white"
                                    style="width:99.9%;">
                                    <thead class="thead-primary">
                                        <tr>

                                            <th style="">
                                                <div class="th-inner sortable text-center">Nombre del Recurso</div>
                                                <div class="fht-cell"></div>
                                            </th>
                                            <th style="">
                                                <div class="th-inner sortable text-center">Tipo de Recurso</div>
                                                <div class="fht-cell">
                                                </div>
                                            </th>
                                            <th style="">
                                                <div class="th-inner sortable text-center">Cantidad en Inventario</div>
                                                <div class="fht-cell"></div>
                                            </th>
                                            <th style="">
                                                <div class="th-inner sortable text-center">Fecha del Evento<br>(Kg)</div>
                                                <div class="fht-cell"></div>
                                            </th>
                                            <th style="">
                                                <div class="th-inner sortable text-center">Notas</div>
                                                <div class="fht-cell"></div>
                                            </th>
                                            <th style="">
                                                <div class="th-inner sortable text-center">Acciones</div>
                                                <div class="fht-cell"></div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="text-center"  rowspan="1">cal</td>
                                            <td class="text-center" rowspan="1">Médicina</td>
                                            <td class="text-center">250 kg</td>
                                            <td class="text-center">30-Jan 19</td>
                                            <td class="text-center">None</td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                    <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o" ></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                                <td class="text-center"  rowspan="1">cal</td>
                                                <td class="text-center" rowspan="1">Médicina</td>
                                                <td class="text-center">250 kg</td>
                                                <td class="text-center">30-Jan 19</td>
                                                <td class="text-center">None</td>
                                                <td class="text-center">
                                                    <div class="actions btn btn-group-sm">
                                                        <a href="" class="btn btn-success btn-xs mr-4">
                                                            <i class="fa fa-edit"></i></a>
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                            <i class="fa fa-trash-o" ></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                    <td class="text-center"  rowspan="1">cal</td>
                                                    <td class="text-center" rowspan="1">Médicina</td>
                                                    <td class="text-center">250 kg</td>
                                                    <td class="text-center">30-Jan 19</td>
                                                    <td class="text-center">None</td>
                                                    <td class="text-center">
                                                        <div class="actions btn btn-group-sm">
                                                            <a href="" class="btn btn-success btn-xs mr-4">
                                                                <i class="fa fa-edit"></i></a>
                                                            <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                                <i class="fa fa-trash-o" ></i></a>
                                                        </div>
                                                    </td>
                                                </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="fixed-table-pagination" style="display: none;">
                            </div>
                        </div>

                </div>
                <!-- abw -->
                <div role="tabpanel" class="tab-pane" id="abw_pill">
                        <div class="fixed-table-container mt-5">

                                <div class="fixed-table-header">

                                    </div>

                                <div class="fixed-table-body">
                                    <div class="fixed-table-loading" style="top: 37px; display: none;">Cargando,por favor
                                        espere...</div>
                                    <table id="ponds-snap-tbl" class="table table-striped table-hover bg-white"
                                        style="width:99.9%;">
                                        <thead class="thead-primary">
                                            <tr>

                                                <th style="">
                                                    <div class="th-inner sortable text-center">Muestras (g)</div>
                                                    <div class="fht-cell"></div>
                                                </th>
                                                <th style="">
                                                    <div class="th-inner sortable text-center">ABW (g)</div>
                                                    <div class="fht-cell">
                                                    </div>
                                                </th>
                                                <th style="">
                                                    <div class="th-inner sortable text-center">AGW (g)</div>
                                                    <div class="fht-cell"></div>
                                                </th>
                                                <th style="">
                                                    <div class="th-inner sortable text-center">Tasa Balanceado (Kg)</div>
                                                    <div class="fht-cell"></div>
                                                </th>
                                                <th style="">
                                                    <div class="th-inner sortable text-center">Bio-masa (Kg)</div>
                                                    <div class="fht-cell"></div>
                                                </th>
                                                <th style="">
                                                        <div class="th-inner sortable text-center">Supervivencia (%)</div>
                                                        <div class="fht-cell"></div>
                                                    </th>

                                                        <th style="">
                                                                <div class="th-inner sortable text-center">FCR</div>
                                                                <div class="fht-cell"></div>
                                                            </th>
                                                            <th style="">
                                                                    <div class="th-inner sortable text-center">Fecha del Evento</div>
                                                                    <div class="fht-cell"></div>
                                                                </th>
                                                <th style="">
                                                    <div class="th-inner sortable text-center">Acciones</div>
                                                    <div class="fht-cell"></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td class="text-center"  rowspan="1">0</td>
                                                <td class="text-center" rowspan="1">13.45</td>
                                                <td class="text-center">1.64</td>
                                                <td class="text-center">0</td>
                                                <td class="text-center">0</td>
                                                <td class="text-center">70</td>
                                                <td class="text-center">0</td>
                                                <td class="text-center">28-Juan 19</td>
                                                <td class="text-center">
                                                    <div class="actions btn btn-group-sm">
                                                        <a href="" class="btn btn-success btn-xs mr-4">
                                                            <i class="fa fa-edit"></i></a>
                                                            <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                            <i class="fa fa-trash-o" ></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                    <td class="text-center"  rowspan="1">0</td>
                                                    <td class="text-center" rowspan="1">13.45</td>
                                                    <td class="text-center">1.64</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">70</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">28-Juan 19</td>
                                                    <td class="text-center">
                                                        <div class="actions btn btn-group-sm">
                                                            <a href="" class="btn btn-success btn-xs mr-4">
                                                                <i class="fa fa-edit"></i></a>
                                                                <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                                <i class="fa fa-trash-o" ></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                        <td class="text-center"  rowspan="1">0</td>
                                                        <td class="text-center" rowspan="1">13.45</td>
                                                        <td class="text-center">1.64</td>
                                                        <td class="text-center">0</td>
                                                        <td class="text-center">0</td>
                                                        <td class="text-center">70</td>
                                                        <td class="text-center">0</td>
                                                        <td class="text-center">28-Juan 19</td>
                                                        <td class="text-center">
                                                            <div class="actions btn btn-group-sm">
                                                                <a href="" class="btn btn-success btn-xs mr-4">
                                                                    <i class="fa fa-edit"></i></a>
                                                                    <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                                    <i class="fa fa-trash-o" ></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                            <td class="text-center"  rowspan="1">0</td>
                                                            <td class="text-center" rowspan="1">13.45</td>
                                                            <td class="text-center">1.64</td>
                                                            <td class="text-center">0</td>
                                                            <td class="text-center">0</td>
                                                            <td class="text-center">70</td>
                                                            <td class="text-center">0</td>
                                                            <td class="text-center">28-Juan 19</td>
                                                            <td class="text-center">
                                                                <div class="actions btn btn-group-sm">
                                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                                        <i class="fa fa-edit"></i></a>
                                                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                                        <i class="fa fa-trash-o" ></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="fixed-table-pagination" style="display: none;">
                                </div>
                            </div>
                </div>
                <!-- Labs -->
                <div role="tabpanel" class="tab-pane" id="lab_pill">
                         <div class="fixed-table-container mt-5">
                            <div class="fixed-table-header">
                                    <h4 class="text-title mt-4">Otras entradas</h4>
                                    <div class="pull-right search mb-2">
                                            <input class="form-control" type="text" placeholder="Buscar">
                                        </div>
                                    </div>
                            <div class="fixed-table-body">
                                <div class="fixed-table-loading" style="top: 37px; display: none;">Cargando,por favor
                                    espere...</div>
                                <table id="ponds-snap-tbl" class="table table-striped table-hover bg-white"
                                    style="width:99.9%;">
                                    <thead class="thead-primary">
                                        <th style="">
                                            <div class="th-inner sortable text-center">factor de conversión</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">Salinidad (PPT)</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">DO</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">CO3</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center">HCO3</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                        <th style="">
                                                <div class="th-inner sortable text-center">total</div>
                                                <div class="fht-cell"></div>
                                            </th>

                                                <th style="">
                                                        <div class="th-inner sortable text-center">Dureza (PPM)</div>
                                                        <div class="fht-cell"></div>
                                                    </th>
                                                    <th style="">
                                                            <div class="th-inner sortable text-center">Amoníaco (NH4 +)</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="">
                                                            <div class="th-inner sortable text-center">Hierro</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="">
                                                            <div class="th-inner sortable text-center">Colonias verdes</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="">
                                                            <div class="th-inner sortable text-center">Colonias amarillas</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="">
                                                            <div class="th-inner sortable text-center">Fecha de la prueba</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                        <th style="">
                                            <div class="th-inner sortable text-center" >Acciones</div>
                                            <div class="fht-cell"></div>
                                        </th>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="text-center"  rowspan="1">0</td>
                                            <td class="text-center" rowspan="1">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">30-Jan 19</td>
                                            
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm" style="width: max-content;">
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                    <a href="javascript:void(0)" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o" ></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="fixed-table-pagination" style="display: none;">
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>

