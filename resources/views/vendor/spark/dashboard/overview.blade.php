<div class="card card-default card-table">
    <div class="card-header">

        {{__('Visión General')}}
    </div>

    <div class="card-body">
            <div class="table-toolbar">
                <div class="pull-right search mb-2">
                    <input class="form-control" type="text" placeholder="Buscar"></div>
            </div>
            <div class="table-container">
                <table id="ponds-snap-tbl" class="table table-striped table-hover bg-white" style="width:99.9%;">
                    <thead class="thead-primary">
                        <tr>
                            <th>
                                <div class="th-inner sortable">Nombre Piscina</div>

                            </th>
                            <th>
                                <div class="th-inner sortable">DOC (Días)</div>

                            </th>
                            <th>
                                <div class="th-inner sortable">ABW</div>

                            </th>
                            <th>
                                <div class="th-inner sortable">AWG</div>

                            </th>
                            <th>
                                <div class="th-inner sortable">Balanceado<br>acumulado (Kg)</div>

                            </th>
                            <th>
                                <div class="th-inner sortable">DO<br>(mg / L)</div>

                            </th>
                            <th>
                                <div class="th-inner sortable">Ratio <br> Conversion<br></div>

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

                <div class="fixed-table-pagination" style="display: none;">
                </div>
            </div>
    </div>
</div>