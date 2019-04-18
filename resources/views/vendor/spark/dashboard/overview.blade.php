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
                            data-field="ratio" data-align="center">Factor de <br> Conversión (Lb)<br></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $doc = 0;
                        $abw = 0;
                        $awg = 0.0;
                        $ba = 0.00;
                        $do = 0;
                        $rc =0;
                        @endphp
                        @foreach ($pools as $item)
                        <tr>

                            <td><a class="text-muted" href="">{{$item->name}}</a></td>
                            <td><a class="text-muted" href="">{{$item->days}}</a></td>
                            <td><a class="text-muted" href="">{{$item->abw}}</a></td>
                            <td><a class="text-muted" href="">{{$item->awg}}</a></td>
                            <td><a class="text-muted" href="">{{$item->balanced}}</a></td>
                            <td><a class="text-muted" href="">{{$item->do}}</a></td>
                            <td><a class="text-muted" href="">
                                        @if ($item->abw == 0 || $item->survival == 0)
                                                                    0
                                        @else
                                    {{round(($item->balanced*2.2)/((($item->abw/1000)*2.2)*($item->survival/100)*($item->planted_larvae)),3)}}
                                @endif


                            </a></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
    </div>
</div>