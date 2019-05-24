<div class="btn-group-md mb-3">
<a
    data-toggle="modal"
    data-target="#createPoolModal"
    href="javascript:void(0)" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Agregar Piscina
    </a>
</div>


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
                            data-field="doc" data-align="center">Días</th>
                            <th
                            data-sortable="true"
                            data-field="abw" data-align="center">Peso Promedio</th>
                            <th
                            data-sortable="true"
                            data-field="awg" data-align="center">Incremento en Gramos</th>
                            <th
                            data-sortable="true"
                            data-field="balaced" data-align="center">Balanceado<br>acumulado (Kg)</th>
                            <th
                            data-sortable="true"
                            data-field="do" data-align="center">Oxígeno<br>(mg / L)</th>
                            <th
                            data-sortable="true"
                            data-field="ratio" data-align="center">Factor de <br> Conversión (Lb)<br></th>
                              <th
                            data-sortable="true"
                            data-field="size" data-align="center">Área<br></th>
                             <th
                            data-sortable="true"
                            data-field="survival" data-align="center">% Sobrevivencia<br></th>
                            <th
                            data-sortable="true"
                            data-field="lbxHa" data-align="center">Libras x Ha<br></th>
                            <th
                            data-sortable="true"
                            data-field="action" data-align="center">Acciones</th>
                        
                        </tr>
                    </thead>
                    <tbody>
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
                            <td><a class="text-muted" href="javascript:void(0)">{{$item->size}}</a></td>
                            <td><a class="text-muted" href="javascript:void(0)">{{$item->survival}}</a></td>
                            <td><a class="text-muted" href="javascript:void(0)">
                                        @if ($item->size == 0)
                                                0
                                        @else
                                    {{round(($item->planted_larvae*(($item->abw/1000)*2.2))/($item->size),3)}}
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
    </div>
</div>