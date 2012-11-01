<div class="card card-default card-table">
    <div class="card-header">

        {{__('Visión General')}}
    </div>

    <div class="card-body">
            <div class="table-container">
                <table id="ponds-snap-tbl"
                class="bg-white"
                data-toggle="table"
                data-classes="table table-striped table-hover table-borderless"
                data-pagination="true"
                data-page-size="10"
                data-locale="es-ES"
                data-search="true">
                    <thead class="thead-primary">
                        <tr>
                            <th
                            data-sortable="true"
                            data-field="name" data-align="center">Nombre Piscina</th>
                            <th
                            data-sortable="true"
                            data-field="doc" data-align="center">DOC (Días)</th>
                            <th
                            data-sortable="true"
                            data-field="abw" data-align="center">ABW</th>
                            <th
                            data-sortable="true"
                            data-field="awg" data-align="center">AWG</th>
                            <th
                            data-sortable="true"
                            data-field="balaced" data-align="center">Balanceado<br>acumulado (Kg)</th>
                            <th
                            data-sortable="true"
                            data-field="do" data-align="center">DO<br>(mg / L)</th>
                            <th
                            data-sortable="true"
                            data-field="ratio" data-align="center">Ratio <br> Conversion<br></th>
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
    </div>
</div>