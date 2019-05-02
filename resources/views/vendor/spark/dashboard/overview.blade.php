<div class="card card-default card-table">
    <div class="card-header">

       <span class="font-weight-bold" style="line-height: 2.3em;vertical-align: -webkit-baseline-middle;"> {{__('Visión General')}}</span>
       <div class="float-right search ">
       </div>
    </div>

    <div class="card-body" style="padding-top: 0;">
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
                            <th
                            data-sortable="true"
                            data-field="action" data-align="center">Acciones</th>
                        
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

                            <td><a class="text-muted" href="javascript:void(0)">{{$item->name}}</a></td>
                            <td><a class="text-muted" href="javascript:void(0)">{{$item->days}}</a></td>
                            <td><a class="text-muted" href="javascript:void(0)">{{$item->abw}}</a></td>
                            <td><a class="text-muted" href="javascript:void(0)">{{$item->awg}}</a></td>
                            <td><a class="text-muted" href="javascript:void(0)">{{$item->balanced}}</a></td>
                            <td><a class="text-muted" href="javascript:void(0)">{{$item->do}}</a></td>
                            <td><a class="text-muted" href="javascript:void(0)">
                                        @if ($item->abw == 0 || $item->survival == 0 || $item->planted_larvae  == 0)
                                                                    0
                                        @else
                                    {{round(($item->balanced*2.2)/((($item->abw/1000)*2.2)*($item->survival/100)*($item->planted_larvae)),3)}}
                                @endif


                            </a></td>
                            <td>
                            <a
                            data-toggle="modal"
                            data-target="#deletePoolModal"
                            data-id="{{$item->pool_id}}" href="javascript:void(0)" class="remove-pool btn btn-xs btn-danger">
                            <i class="fa fa-trash-o"></i></a>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <script>
    $(document).ready(function(){
       /* $(".btnDetach").click(function(){
            $holder = $(".detach").detach();
        });
        $(".btnAttach").click(function(){
            $(".menu").append($holder);
        });*/
        console.log('habla perro');

    });
            </script>
    </div>
</div>