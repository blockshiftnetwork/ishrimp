

            <div class="card card-default card-table">
                <div class="card-header">

                    {{__('Visíón General')}}
                </div>

                <div class="card-body">
        <div class="bootstrap-table">
            <div class="fixed-table-toolbar p_list_tbl_tbar">
                <div class="columns columns-left pull-left">
                    <div class="page_list"></div>
                </div>
                <div class="columns columns-right btn-group pull-right">
                    <button class="btn btn-default" type="button" name="refresh" title="Refrescar">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
                <div class="pull-right search mb-2">
                    <input class="form-control" type="text" placeholder="Buscar"></div>
                </div>
                <div class="fixed-table-container">
                    <div class="fixed-table-header">
                        <table>
                            </table>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading" style="top: 37px; display: none;">Cargando,por favor espere...</div>
        <table id="ponds-snap-tbl" class="table table-striped table-hover bg-white" style="width:99.9%;">
            <thead class="thead-primary">
                <tr>
                    <th style="">
                        <div class="th-inner sortable">Nombre Piscina</div>
                        <div class="fht-cell"></div>
                    </th>
                    <th style="">
                            <div class="th-inner sortable">DOC (Días)</div>
                            <div class="fht-cell"></div></th><th style="">
                                <div class="th-inner sortable">ABW</div><div class="fht-cell">
                                    </div>
                                </th>
                                <th style="">
                                    <div class="th-inner sortable">AWG</div>
                                    <div class="fht-cell"></div></th><th style="">
                                        <div class="th-inner sortable">Balanceado<br>acumulado (Kg)</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style=""><div class="th-inner sortable">DO<br>(mg / L)</div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    <th style=""><div class="th-inner sortable">Ratio <br> Conversion<br></div>
                                        <div class="fht-cell"></div>
                                    </th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @php
                                                $doc = 0;
                                                $awc = 0;
                                                $awg = 0.0;
                                                $ba = 0.00;
                                                $do = 0;
                                                $rc =0;
                                            @endphp
                                    @foreach ($pools as $item)
                                        <tr>
                                           
                                            <td><a class="text-muted" href="">{{$item->name}}</a></td>
                                            <td><a class="text-muted" href="">{{$doc}}</a></td>
                                            <td><a class="text-muted" href="">{{$awc}}</a></td>
                                            <td><a class="text-muted" href="">{{$awg}}</a></td>
                                            <td><a class="text-muted" href="">{{$ba}}</a></td>
                                            <td><a class="text-muted" href="">{{$do}}</a></td>
                                            <td><a class="text-muted" href="">{{$rc}}</a></td>
                                        </tr>
                                    @endforeach
                                    
                                  </tbody>
                                </table>
                            </div>
                            <div class="fixed-table-pagination" style="display: none;">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

