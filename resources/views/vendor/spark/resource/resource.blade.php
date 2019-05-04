<div class="dsh_board_main_body_cont">
    <div class="col-lg-12 border pondsDetailsTop nav nav-bar bg-white">
        <div class="mid_container top_space">
            <div role="tabpanel" id="pond-detail-pills">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-tabs" role="tablist" style="float: left;">
                    <li role="resource"><a id="link-recources" class="btn btn-light active" href="#resource-tab" aria-controls="resource_section"
                            role="tab" data-toggle="tab">Recursos</a></li>
                    <li role="presentation"><a class="btn btn-light " href="#presentation"
                            aria-controls="presentation_section" role="tab" data-toggle="tab">Presentaciones</a></li>
                   
                    <li role="providers"><a class="btn btn-light" href="#providers" aria-controls="providers_section"
                            role="tab" data-toggle="tab">Proveedores</a></li>
                    <li role="labs"><a id="link-lab" class="btn btn-light" href="#labs" aria-controls="labs_section"
                            role="tab" data-toggle="tab">Laboratorios</a></li>
                </ul>
                <div class="search" style="float: right;"></div>
            </div>
            <div class="tab-content">
                <!-- tab resource-->
                <div role="tabpanel" class="tab-pane active" id="resource-tab">
                    <div class="mid_container">
                        <section class="section">
                                <table class="bg-white"
                                    data-toggle="table"
                                    data-classes="table table-striped table-hover table-borderless"
                                    data-pagination="true"
                                    data-locale="es-ES"
                                    data-search="true"
                                    style="width:99.9%;">
                                    <thead class="thead-primary">

                                        <tr>
                                            <th data-sortable="true" data-field="name" data-align="center">Nombre del Recurso</th>
                                            <th data-align="center">Proveedor</th>
                                            <th data-align="center">Tipo</th>
                                            <th data-align="center">Acciones</th>
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
                                <div class="btn-tools-bar">
                                    <button type="button" id="addfood" class="btn btn-primary ml-1 mt-3" data-toggle="modal"
                                        data-target="#addResourceModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir Recurso</button>
                                </div>
                        </section>
                    </div>
                    <!-- Modals resources -->
                    @include('spark::modals.resource.resourceModals')
                </div>
                 <!-- tab presentation-->
                <div role="tabpanel" class="tab-pane" id="presentation">
                    <div class="mid_container">
                        <section class="section">
                           <!-- <div class=" " id="feed_table" style="overflow: hidden;">-->
                                <table class="bg-white"
                                    data-toggle="table"
                                    data-classes="table table-striped table-hover table-borderless"
                                    data-pagination="true"
                                    data-locale="es-ES"
                                    data-search="true">
                                    <thead class="thead-primary">

                                        <tr>
                                            <th data-sortable="true"
                                                data-field="name" data-align="center" >Nombre de recurso</th>
                                            <th data-align="center">Presentación</th>
                                            <th data-align="center">Cantidad</th>
                                            <th data-align="center">Precio</th>
                                            <th data-align="center">Acciones</th>
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
                                <div class="btn-tools-bar">
                                    <button type="button" id="addfood" class="btn btn-primary ml-1 mt-3" data-toggle="modal"
                                        data-target="#addPresentationModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir presentación</button>
                                </div>
                            <!--</div> -->
                        </section>
                    </div>
                    <!-- Modals presentation -->
                    @include('spark::modals.resource.presentationModals')
                </div>
                <!-- tab providers  -->
                <div role="tabpanel" class="tab-pane" id="providers">
                    <div class="mid_container">
                        <section class="section">
                                <table class="bg-white" id="provider_table"
                                    data-toggle="table"
                                    data-classes="table table-striped table-hover table-borderless"
                                    data-pagination="true"
                                    data-locale="es-ES"
                                    data-search="true">
                                    <thead class="thead-primary">
                                    
                                        <tr>
                                            <th data-align="center">Nombre del Proveedor</th>
                                            <th data-align="center">Teléfono</th>
                                            <th data-align="center">Email</th>
                                            <th data-align="center">Dirección</th>
                                            <th data-align="center">Acciones</th>
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
                                <div class="btn-tools-bar">
                                    <button type="button" id="addProvider" class="btn btn-primary ml-1 mt-3" data-toggle="modal"
                                        data-target="#addProviderModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir Proveedor</button>
                                </div>
                        </section>
                    </div>
                    <!-- Modals Providers -->
                    @include('spark::modals.resource.providerModals')

                </div>
                <!-- laboratories -->
                <div role="tabpanel" class="tab-pane" id="labs">
                    <div class="mid_container">
                        <section class="section">
                                <table class="bg-white" id="Labs-table"
                                    data-toggle="table"
                                    data-classes="table table-striped table-hover table-borderless"
                                    data-pagination="true"
                                    data-locale="es-ES"
                                    data-search="true">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th data-align="center">Nombre del Laboratorio</th>
                                            <th data-align="center">Teléfono</th>
                                            <th data-align="center">Email</th>
                                            <th data-align="center">Dirección</th>
                                            <th data-align="center">Acciones</th>
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
                                <div class="btn-tools-bar">
                                    <button type="button" id="addLab" class="btn btn-primary ml-1 mt-3" data-toggle="modal"
                                        data-target="#addLabModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir Laboratorio</button>
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