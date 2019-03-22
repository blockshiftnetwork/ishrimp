<div class="dsh_board_main_body_cont">
    <div class="col-lg-12 border pondsDetailsTop nav nav-bar bg-white">
        <div class="mid_container top_space">
            <div role="tabpanel" id="pond-detail-pills">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-tabs" role="tablist">
                    <li role="resource" class=" nav-item"><a class="btn btn-light nav-link active" href="#resource"
                            aria-controls="resource_section" role="tab" data-toggle="tab">Recursos</a></li>
                    <li role="presentation" class=" nav-item"><a class="btn btn-light nav-link" href="#presentation"
                            aria-controls="resource_section" role="tab" data-toggle="tab">Presentaciones</a></li>
                   
                    <li role="providers"><a class="btn btn-light" href="#providers" aria-controls="providers_section"
                            role="tab" data-toggle="tab">Proveedores</a></li>
                    <li role="labs"><a class="btn btn-light" href="#labs" aria-controls="labs_section"
                            role="tab" data-toggle="tab">Laboratorios</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <!-- tab resource-->
                <div role="tabpanel" class="tab-pane active" id="resource">
                    <div class="mid_container">
                        <section class="section">
                                <div class="btn-tools-bar">
                                    <button type="button" id="addfood" class="btn btn-info ml-5" data-toggle="modal"
                                        data-target="#addResourceModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir Recurso</button>
                                </div>
                                <table class="bg-white"
                                    data-toggle="table"
                                    data-classes="table table-striped table-hover table-borderless"
                                    data-pagination="true"
                                    data-search="true"
                                    style="width:99.9%;">
                                    <thead class="thead-primary">

                                        <tr>
                                            <th data-sortable="true"
                                                data-field="name">Nombre del Recurso</th>
                                            <th class="">Proveedor</th>
                                            <th class="">Tipo</th>
                                            <th class="">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="results" aria-live="polite" aria-relevant="all">
                                    @foreach ($resources as $resource)
                                        <tr>
                                            <td>{{$resource->name}}</td>
                                            <td>{{$resource->provider_name}}</td>
                                            <td>{{$resource->category_name}}</td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <button id="#edit" data-toggle="modal"
                                                        data-target="#editResourceModal"
                                                        data-id="{{$resource->id}}"
                                                        data-name="{{$resource->name}}"
                                                        data-provider_id="{{$resource->provider_id}}"
                                                        data-category_id="{{$resource->category_id}}"
                                                        class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></button>
                                                    <button data-toggle="modal"
                                                        data-target="#deleteResourceModal"
                                                        data-id="{{$resource->id}}"
                                                        class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </section>
                    </div>
                    <!-- Modals resources -->
                    @include('spark::modals.resource.ResourceModals')
                </div>
                 <!-- tab presentation-->
                <div role="tabpanel" class="tab-pane" id="presentation">
                    <div class="mid_container">
                        <section class="section">
                            <div class=" " id="feed_table" style="overflow: hidden;">
                                <div class="btn-tools-bar">
                                    <button type="button" id="addfood" class="btn btn-info ml-5" data-toggle="modal"
                                        data-target="#addPresentationModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir presentación</button>
                                </div>
                                <table class="bg-white"
                                    data-toggle="table"
                                    data-classes="table table-striped table-hover table-borderless"
                                    data-pagination="true"
                                    data-search="true">
                                    <thead class="thead-primary">

                                        <tr>
                                            <th data-sortable="true"
                                                data-field="name" >Nombre de recurso</th>
                                            <th class="">Presentación</th>
                                            <th class="">Cantidad</th>
                                            <th class="">Precio</th>
                                            <th class="">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="results" aria-live="polite" aria-relevant="all">
                                    @foreach ($presentations as $presentation)
                                        <tr>
                                            <td>{{$presentation->resource_name}}</td>
                                            <td >{{$presentation->name}}</td>
                                            <td>{{$presentation->quantity}} {{$presentation->unity}}</td>
                                            <td>{{$presentation->price}}</td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <button id="#edit" data-toggle="modal"
                                                        data-target="#editPresentationModal"
                                                        data-id="{{$presentation->id}}"
                                                        data-resource_id="{{$presentation->resource_id}}"
                                                        data-name ="{{$presentation->name}}"
                                                        data-quantity="{{$presentation->quantity}}"
                                                        data-price="{{$presentation->price}}"
                                                        data-unity="{{$presentation->unity}}"
                                                        class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></button>
                                                    <button 
                                                    data-toggle="modal"
                                                    data-target="#deletePresentationModal"
                                                    data-id="{{$presentation->id}}"
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
                    <!-- Modals presentation -->
                    @include('spark::modals.resource.presentationModals')
                </div>
                <!-- tab providers  -->
                <div role="tabpanel" class="tab-pane" id="providers">
                    <div class="mid_container">
                        <section class="section">
                                <div class="btn-tools-bar">
                                    <button type="button" id="addProvider" class="btn btn-info ml-5" data-toggle="modal"
                                        data-target="#addProviderModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir Proveedor</button>
                                </div>
                                <table class="bg-white" id="provider_table"
                                    data-toggle="table"
                                    data-classes="table table-striped table-hover table-borderless"
                                    data-pagination="true"
                                    data-search="true">
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
                        </section>
                    </div>
                    <!-- Modals Providers -->
                    @include('spark::modals.resource.providerModals')

                </div>
                <!-- laboratories -->
                <div role="tabpanel" class="tab-pane" id="labs">
                    <div class="mid_container">
                        <section class="section">
                                <div class="btn-tools-bar">
                                    <button type="button" id="addLab" class="btn btn-info ml-5" data-toggle="modal"
                                        data-target="#addLabModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir Laboratorio</button>
                                </div>
                                <table class="bg-white" id="Labs-table"
                                    data-toggle="table"
                                    data-classes="table table-striped table-hover table-borderless"
                                    data-pagination="true"
                                    data-search="true">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>Nombre del Laboratorio</th>
                                            <th>Teléfono</th>
                                            <th>Email</th>
                                            <th>Dirección</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="results" aria-live="polite" aria-relevant="all">
                                    @foreach($laboratories as $laboratory)
                                        <tr class="scrl_tr" role="row">
                                            <td>{{$laboratory->name}}</td>
                                            <td>{{$laboratory->phone}}</td>
                                            <td>{{$laboratory->email}}</td>
                                            <td>{{$laboratory->address}}</td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <button id="#editLab" data-toggle="modal"
                                                        data-target="#editLabModal"
                                                        data-id="{{$laboratory->id}}"
                                                        data-name="{{$laboratory->name}}"
                                                        data-phone="{{$laboratory->phone}}"
                                                        data-email="{{$laboratory->email}}"
                                                        data-address="{{$laboratory->address}}"
                                                        class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></button>
                                                    <button data-toggle="modal"
                                                    data-target="#deleteLabModal"
                                                    data-id="{{$laboratory->id}}"
                                                        class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </section>
                    </div>
                    <!-- Modals Labs -->
                    @include('spark::modals.resource.labModals')

                </div>

            </div>
        </div>
    </div>

</div>