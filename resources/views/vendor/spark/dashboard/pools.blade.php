<div class="dsh_board_main_body_cont">
    <div class="col-lg-12 border pondsDetailsTop nav nav-bar bg-white">
        <input type="hidden" class="pondId" value="1258">
        <input type="hidden" class="grp_doc" value="2018-11-22">
        <input type="hidden" class="grp_hoc" value="-0001-11-30">
        <input type="hidden" id="doc_tank" name="doc_tank" value="2018-11-22">
        <input type="hidden" id="hoc_tank" name="hoc_tank" value="2019-02-12">
        <input type="hidden" class="harv_timestamp" value="current">
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
                        <li class="searchlist_li"><a href="javascript: void(0)" a="1258" class="pond-dropdown">Piscina
                                2</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)" a="1259" class="pond-dropdown">Piscina
                                3</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)" a="1260" class="pond-dropdown">Piscina
                                4</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)" a="1261" class="pond-dropdown">Piscina
                                5</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)" a="1262" class="pond-dropdown">Piscina
                                6</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)" a="1263" class="pond-dropdown">Piscina
                                7</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)" a="1264" class="pond-dropdown">Piscina
                                8</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)" a="1265" class="pond-dropdown">Piscina
                                9</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)" a="1266" class="pond-dropdown">Piscina
                                10</a></li>
                        <li class="searchlist_li"><a href="javascript: void(0)" a="1267" class="pond-dropdown">Piscina
                                11</a></li>
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
                <li role="presentation" class="active"><a href="#graphs_pill" aria-controls="graphs_section" role="tab"
                        data-toggle="tab">Gráficos</a></li>
                <li role="presentation"><a href="#feed_chart_pill" aria-controls="feed_chart_section" role="tab"
                        data-toggle="tab">Alimentación</a></li>
                <li role="presentation"><a href="#inputs_pill" aria-controls="inputs_section" role="tab"
                        data-toggle="tab">Entradas</a></li>
                <li role="presentation"><a href="#abw_pill" aria-controls="abw_section" role="tab"
                        data-toggle="tab">ABW</a></li>
                <li role="presentation"><a href="#lab_pill" aria-controls="lab_section" role="tab"
                        data-toggle="tab">Pruebas de Laboratorio</a></li>
            </ul>
            <div class="tab-content">
                <div style="padding-top:10px" role="tabpanel" class="tab-pane active" id="graphs_pill">


                </div>
                <div role="tabpanel" class="tab-pane" id="feed_chart_pill">
                    <div class="fixed-table-container">
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
                                                    <a href="javascript:void(0)" id=""
                                                    a="Optiline 35% #5 - Gisis" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash-o" ></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" rowspan="1">58</td>
                                        <td class="text-center" rowspan="1">20-Jan 19</td>
                                        <td class="text-center">Optiline 35% #5 - Gisis</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                        <a href="javascript:void(0)" id=""
                                                        a="Optiline 35% #5 - Gisis" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o" ></i></a>
                                                </div>
                                            </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" rowspan="1">58</td>
                                        <td class="text-center" rowspan="1">19-Jan 19</td>
                                        <td class="text-center">Optiline 35% #5 - Gisis</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                        <a href="javascript:void(0)" id=""
                                                        a="Optiline 35% #5 - Gisis" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o" ></i></a>
                                                </div>
                                            </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" rowspan="1">57</td>
                                        <td class="text-center" rowspan="1">14-Jan 19</td>
                                        <td class="text-center">Optiline 35% #5 - Gisis</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">5075</td>
                                        <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                        <a href="javascript:void(0)" id=""
                                                        a="Optiline 35% #5 - Gisis" class="btn btn-xs btn-danger">
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
                <div role="tabpanel" class="tab-pane" id="inputs_pill">

                </div>
                <div role="tabpanel" class="tab-pane" id="abw_pill">

                </div>
                <div role="tabpanel" class="tab-pane" id="lab_pill">

                </div>
            </div>
        </div>
    </div>

</div>
