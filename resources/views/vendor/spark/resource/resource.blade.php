<div class="dsh_board_main_body_cont">
    <div class="col-lg-12 pondsDetailsTop nav nav-bar bg-white">
        <div class="mid_container top_space">
            <div role="tabpanel" id="pond-detail-pills">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-tabs" role="tablist" style="float: left;">
                <li role="Balanceado" id="bal"><a id="link-Balanceado active" class="btn btn-light active" href="#balanceado-tab" aria-controls="resource_section"
                            role="tab" data-toggle="tab">Balanceado</a></li>
                <li role="supply" id="sup"><a class="btn btn-light " href="#supply-tab"
                            aria-controls="supply" role="tab" data-toggle="tab">Insumos</a></li>
                    <!--<li role="resource" id="res"><a id="link-recources" class="btn btn-light " href="#resource-tab" aria-controls="resource_section"
                            role="tab" data-toggle="tab">Recursos</a></li>
                    <li role="presentation" id="pres"><a class="btn btn-light " href="#presentation"
                            aria-controls="presentation_section" role="tab" data-toggle="tab">Presentaciones</a></li>-->
                   
                    <li role="providers" id="prov"><a class="btn btn-light" href="#providers" aria-controls="providers_section"
                            role="tab" data-toggle="tab">Proveedores</a></li>
                    <li role="labs" id="lab"><a id="link-lab" class="btn btn-light" href="#labs" aria-controls="labs_section"
                            role="tab" data-toggle="tab">Laboratorios</a></li>
                </ul>
                <div id="s_bal" class="search" style="float: right; display: none;"></div>
                <div id="s_res" class="search" style="float: right; display: none;"></div>
                <div id="s_pres" class="search"  style="float: right; display: none;"></div>
                <div id="s_prov" class="search"  style="float: right; display: none;"></div>
                <div id="s_labs" class="search"  style="float: right; display: none;"></div>
            </div>
            <div class="tab-content">
            <!--Balanceado-->
            <div role="tabpanel" class="tab-pane active" id="balanceado-tab">
                    <div class="mid_container">
                        <section class="section">
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
                                    @foreach ($balanceds as $balanced)
                                        <tr>
                                            <td>{{$balanced->resource_name}}</td>
                                            <td >{{$balanced->resource_name}}</td>
                                            <td>{{$balanced->quantity}} {{$balanced->unity}}</td>
                                            <td>{{$balanced->price}}</td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <button id="#edit" data-toggle="modal"
                                                        data-target="#editBalancedModal"
                                                        data-id="{{$balanced->id}}"
                                                        data-resource_id="{{$balanced->resource_id}}"
                                                        data-name ="{{$balanced->resource_name}}"
                                                        data-quantity="{{$balanced->quantity}}"
                                                        data-price="{{$balanced->price}}"
                                                        data-unity="{{$balanced->unity}}"
                                                        class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></button>
                                                    <button 
                                                    data-toggle="modal"
                                                    data-target="#deleteBalancedModal"
                                                    data-id="{{$balanced->id}}"
                                                    class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="btn-tools-bar">
                                        <div class="btn-tools-bar">
                                                <button type="button" id="addfood" class="btn btn-primary ml-1 mt-3" data-toggle="modal"
                                                    data-target="#addBalancedModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                                    Añadir Recurso</button>
                                        </div>
                        </section>
                    </div>
                    <!-- Modals resources -->
                    @include('spark::modals.resource.balancedModals')
                </div>
                <!-- Supplies -->
                <div role="tabpanel" class="tab-pane" id="supply-tab">
                        <div class="mid_container">
                            <section class="section">
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
                                        @foreach ($supplies as $supply)
                                            <tr>
                                                <td>{{$supply->resource_name}}</td>
                                                <td >{{$supply->resource_name}}</td>
                                                <td>{{$supply->quantity}} {{$supply->unity}}</td>
                                                <td>{{$supply->price}}</td>
                                                <td class="text-center">
                                                    <div class="actions btn btn-group-sm">
                                                        <button id="#edit" data-toggle="modal"
                                                            data-target="#editSupplyModal"
                                                            data-id="{{$supply->id}}"
                                                            data-resource_id="{{$supply->resource_id}}"
                                                            data-name ="{{$supply->resource_name}}"
                                                            data-quantity="{{$supply->quantity}}"
                                                            data-price="{{$supply->price}}"
                                                            data-unity="{{$supply->unity}}"
                                                            class="btn btn-success btn-xs mr-4">
                                                            <i class="fa fa-edit"></i></button>
                                                        <button 
                                                        data-toggle="modal"
                                                        data-target="#deleteSupplyModal"
                                                        data-id="{{$supply->id}}"
                                                        class="btn btn-xs btn-danger">
                                                            <i class="fa fa-trash-o"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="btn-tools-bar">
                                            <div class="btn-tools-bar">
                                                    <button type="button" id="addfood" class="btn btn-primary ml-1 mt-3" data-toggle="modal"
                                                        data-target="#addSupplyModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                                        Añadir Recurso</button>
                                            </div>
                            </section>
                        </div>
                        <!-- Modals resources -->
                        @include('spark::modals.resource.supplyModal')
                    </div>
                    
                <!-- tab resource-->
                <div role="tabpanel" class="tab-pane" id="resource-tab">
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
                                            <td>{{$resource->resource_name}}</td>
                                            <td>{{$resource->provider_name ?? 'No Establecido'}}</td>
                                            <td>{{$resource->category_name}}</td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <button id="#edit" data-toggle="modal"
                                                        data-target="#editResourceModal"
                                                        data-id="{{$resource->id}}"
                                                        data-name="{{$resource->resource_name}}"
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