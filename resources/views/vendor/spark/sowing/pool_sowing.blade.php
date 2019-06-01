<div class="card">
    <div class="card-header"><span class="font-weight-bold" style="line-height: 2.3em; vertical-align: -webkit-baseline-middle;">Sembrar</span><div class="float-right search ">
       </div></div>
    <div class="card-body" style="padding-top: 0px;">
        <section class="section">

            <table class="bg-white" id="balanced_tbl"
            data-toggle="table"
            data-classes="table table-striped table-hover table-borderless"
            data-pagination="true"
            data-locale="es-ES"
            data-search="true">
                <thead class="thead-primary">
                    <tr>
                        <th data-sortable="true" data-field="name" data-align="center">Piscina</th>
                            <th data-align="center">Larvas Sembradas</th>
                            <th data-align="center">Tipo de Larvas</th>
                            <th data-align="center">Fecha de Siembra</th>
                            <th data-align="center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="results" aria-live="polite" aria-relevant="all">
                @foreach ($pools_sowed as $sowed)
                    <tr>
                        <td>{{$sowed->pool_name}}</td>
                        <td>{{$sowed->planted_larvae}}</td>
                        <td>{{$sowed->larvae_type}}</td>
                        <td>{{$sowed->planted_at}}</td>
                        <td class="text-center">
                        <div class="actions btn btn-group-sm">
                            <button id="#edit" data-toggle="modal"
                                data-target="#editSowingPoolModal"
                                data-id="{{$sowed->id}}"
                                data-pool_id="{{$sowed->pool_id}}"
                                data-planted_larvae="{{$sowed->planted_larvae}}"
                                data-larvae_type="{{$sowed->larvae_type}}"
                                data-planted_at="{{$sowed->planted_at}}"
                                class="btn btn-success btn-xs mr-4">
                                    <i class="fa fa-edit"></i></button>
                                    <button data-toggle="modal"
                                    data-target="#deleteSowingPoolModal"
                                    data-id="{{$sowed->id}}"
                                    class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash-o"></i></button>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>
            <div class="btn-tools-bar">
                <button type="button" id="addfood" class="btn btn-primary ml-1 mt-3" data-toggle="modal"
                data-target="#addSowingPoolModal"><i class="fa fa-plus" aria-hidden="true"></i>
                Sembrar</button>
            </div>
        </section>
        </div>
</div>
<!-- Modals Pools Sowing -->
@include('spark::modals.sowing.sowingPoolModal')