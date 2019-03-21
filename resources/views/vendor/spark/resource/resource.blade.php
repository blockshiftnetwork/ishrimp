<div class="dsh_board_main_body_cont">
    <div class="col-lg-12 border pondsDetailsTop nav nav-bar bg-white">
        <div class="mid_container top_space">
            <div role="tabpanel" id="pond-detail-pills">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-tabs" role="tablist">
                    <li role="presentation" class=" nav-item"><a class="btn btn-light nav-link active" href="#resource"
                            aria-controls="resource_section" role="tab" data-toggle="tab">Recursos</a></li>
                    <li role="presentation"><a class="btn btn-light" href="#providers" aria-controls="providers_section"
                            role="tab" data-toggle="tab">Proveedores</a></li>
                    <li role="presentation"><a class="btn btn-light" href="#labs" aria-controls="labs_section"
                            role="tab" data-toggle="tab">Laboratorios</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <!-- tab resource-->
                <div role="tabpanel" class="tab-pane active" id="resource">
                    <div class="mid_container">
                        <section class="section">
                            <div class=" " id="feed_table" style="overflow: hidden;">
                                <div class="pull-left search mb-2">
                                    <input class="form-control" type="text" placeholder="Buscar">
                                </div>
                                <div class="pull-right search mb-2">
                                    <button type="button" id="addfood" class="btn btn-info ml-5" data-toggle="modal"
                                        data-target="#addResourceModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir Recurso</button>
                                </div>
                                <table class="table table-striped table-hover bg-white text-center" id="feedSch_tbl"
                                    style="width:99.9%;">
                                    <thead class="thead-primary">

                                        <tr>
                                            <th>Nombre del Recurso</th>
                                            <th class="">Proveedor</th>
                                            <th class="">Tipo</th>
                                            <th class="">Presentación</th>
                                            <th class="">Cantidad</th>
                                            <th class="">Precio</th>
                                            <th class="">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="results" aria-live="polite" aria-relevant="all">
                                    @foreach ($resources as $resource)
                                        <tr>
                                            <td>{{$resource->name}}</td>
                                            <td>{{$resource->provider_name}}</td>
                                            <td>{{$resource->category_name}}</td>
                                            <td >{{$resource->presentation_name}}</td>
                                            <td>{{$resource->quantity}}-{{$resource->unity}}</td>
                                            <td>{{$resource->price}}</td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <button id="#edit" data-toggle="modal"
                                                        data-target="#editResourceModal"
                                                        class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></button>
                                                    <button data-toggle="modal" data-target="#deleteResourceModal"
                                                        class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </section>
                    </div>
                    <!-- Modals resources -->
                    @include('spark::modals.resource.ResourceModals')
                </div>

                <!-- tab providers  -->
                <div role="tabpanel" class="tab-pane" id="providers">
                    <div class="mid_container">
                        <section class="section">
                            <div class=" " id="feed_table" style="overflow: hidden;">
                                <div class="pull-left search mb-2">
                                    <input class="form-control" type="text" placeholder="Buscar">
                                </div>
                                <div class="pull-right search mb-2">
                                    <button type="button" id="addProvider" class="btn btn-info ml-5" data-toggle="modal"
                                        data-target="#addProviderModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir Proveedor</button>
                                </div>
                                <table class="table table-striped table-hover bg-white text-center" id="provider_table"
                                    style="width:99.9%;">
                                    <thead class="thead-primary">
                                    
                                        <tr>
                                            <th class="" scope="col">
                                                <div class="tablesorter-header-inner">Nombre del Proveedor</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Teléfono</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Email</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Dirección</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Acciones</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="results" aria-live="polite" aria-relevant="all">
                                        @foreach ($providers as $provider)
                                        <tr class="scrl_tr" role="row">
                                            <td class="filter_row">
                                                <span class="tank_filter">{{$provider->name}}</span>
                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">{{$provider->phone}}</span>

                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">{{$provider->email}}</span>

                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">{{$provider->address}}</span>

                                            </td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <button id="#edit" data-id="{{$provider->id}}"
                                                        data-name="{{$provider->name}}"
                                                        data-phone="{{$provider->phone}}"
                                                        data-email="{{$provider->email}}"
                                                        data-address="{{$provider->address}}" data-toggle="modal"
                                                        data-target="#editProviderModal"
                                                        class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></button>
                                                    <button data-id="{{$provider->id}}" data-toggle="modal"
                                                        data-target="#deleteProviderModal"
                                                        class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </section>
                    </div>
                    <!-- Modals Providers -->
                    @include('spark::modals.resource.providerModals')

                </div>
                <!-- labs -->
                <div role="tabpanel" class="tab-pane" id="labs">
                    <div class="mid_container">
                        <section class="section">
                            <div class=" " id="feed_table" style="overflow: hidden;">
                                <div class="pull-left search mb-2">
                                    <input class="form-control" type="text" placeholder="Buscar">
                                </div>
                                <div class="pull-right search mb-2">
                                    <button type="button" id="addLab" class="btn btn-info ml-5" data-toggle="modal"
                                        data-target="#addLabModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir Laboratorio</button>
                                </div>
                                <table class="table table-striped table-hover bg-white text-center" id="Labs-table"
                                    style="width:99.9%;">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th class="" scope="col">
                                                <div class="tablesorter-header-inner">Nombre del Laboratorio</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Teléfono</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Email</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Dirección</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Acciones</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="results" aria-live="polite" aria-relevant="all">
                                        <tr class="scrl_tr" role="row">
                                            <td class="filter_row">
                                                <span class="tank_filter">Laboratorio 1</span>

                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">5434323343</span>

                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">laboratorio1@gmail.com</span>
                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">La dirección</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <button id="#editLab" data-toggle="modal"
                                                        data-target="#editLabModal" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></button>
                                                    <button data-toggle="modal" data-target="#deleteLabModal"
                                                        class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </section>
                    </div>
                    <!-- Modals Labs -->
                    @include('spark::modals.resource.labModals')

                </div>

            </div>
        </div>
    </div>

</div>