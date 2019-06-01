<div class="dsh_board_main_body_cont">
    <div class="col-lg-12 pondsDetailsTop nav nav-bar bg-white">
        <div class="mid_container top_space">
            <div role="tabpanel" id="pond-detail-pills">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-tabs" role="tablist" style="float: left;">
                    <li role="resource" id="bal"><a id="link-recources" class="btn btn-light active" href="#balanced-tab" aria-controls="resource_section"
                            role="tab" data-toggle="tab">Balanceados</a></li>
                    <li role="presentation" id="pres-b"><a class="btn btn-light " href="#presentation-b"
                            aria-controls="presentation_section" role="tab" data-toggle="tab">Presentaciones</a></li>
                   
                </ul>
                <div id="s_bal" class="search" style="float: right; display: none;"></div>
                <div id="s_pres_b" class="search"  style="float: right; display: none;"></div>

            </div>
            <div class="tab-content">
                <!-- tab resource-->
                <div role="tabpanel" class="tab-pane active" id="balanced-tab">
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
                                    @foreach ($balanceds as $resource)
                                        <tr>
                                            <td>{{$resource->name}}</td>
                                            <td>{{$resource->provider_id ?? 'No Establecido'}}</td>
                                            <td>{{$resource->category_name}}</td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <button id="#edit" data-toggle="modal"
                                                        data-target="#editBalancedModal"
                                                        data-id="{{$resource->id}}"
                                                        data-note="{{$resource->note}}"
                                                        data-name="{{$resource->name}}"
                                                        data-provider_id="{{$resource->provider_id}}"
                                                        data-category_id="{{$resource->category_id}}"
                                                        class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></button>
                                                    <button data-toggle="modal"
                                                        data-target="#deleteBalancedModal"
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
                                        data-target="#addBalancedModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir Recurso</button>
                                </div>
                        </section>
                    </div>
                    <!-- Modals resources -->
                    @include('spark::modals.resource.balancedModals')
                </div>
                 <!-- tab presentation-->
                <div role="tabpanel" class="tab-pane" id="presentation-b">
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
                                    @foreach ($presentations_b as $presentation)
                                        <tr>
                                            <td>{{$presentation->resource_name}}</td>
                                            <td >{{$presentation->name}}</td>
                                            <td>{{$presentation->quantity}} {{$presentation->unity}}</td>
                                            <td>{{$presentation->price}}</td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <button id="#edit" data-toggle="modal"
                                                        data-target="#editPresentationBModal"
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
                                                    data-target="#deletePresentationBModal"
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
                                        data-target="#addPresentationBModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Añadir presentación</button>
                                </div>
                            <!--</div> -->
                        </section>
                    </div>
                    <!-- Modals presentation -->
                    @include('spark::modals.resource.presentationBModals')
                </div>
              
            </div>
        </div>
    </div>

</div>