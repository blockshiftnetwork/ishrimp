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
                                            <th class="" scope="col">
                                                <div class="tablesorter-header-inner">Nombre del Recurso</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Proveedor</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Tipo</div>
                                            </th>
                                            <th class="">
                                                    <div class="tablesorter-header-inner">Presentación</div>
                                                </th>

                                                <th class="">
                                                        <div class="tablesorter-header-inner">Cantidad</div>
                                                </th>
                                                <th class="">
                                                    <div class="tablesorter-header-inner">precio</div>
                                            </th>
                                            <th class="">
                                                <div class="tablesorter-header-inner">Acciones</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="results" aria-live="polite" aria-relevant="all">
                                        <tr class="scrl_tr" role="row">
                                            <td class="filter_row">
                                                <span class="tank_filter">Lorica 2 - Gisis</span>

                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">Alimento</span>

                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">proveedor 1</span>
                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">gris</span>
                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">25 kg</span>
                                            </td>
                                            <td class="filter_row">
                                                <span class="tank_filter">25</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="actions btn btn-group-sm">
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                               
                            </div>
                        </section>
                    </div>
                    <div class="modal fade" id="addResourceModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Recurso</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-group" action="" method="post">
                                       <div class="form-group"> 
                                            <label for="category_id">Tipo de recurso</label>
                                            <select class="form-control" name="category_id" id="category_id" required>
                                                <option value="" selected>Tipo de Recurso</option>
                                                <option value="1">Insumo</option>
                                                <option value="1">Balanceado</option>
                                            </select>
                                       </div>
                                            <div class="form-group">
                                            <select class="form-control" name="present_id" id="present_id" required>
                                                    <option value="" selected>Presentación</option>
                                                    <option value="1">25 kg</option>
                                                    <option value="1">50 kg</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nombre del Recurso</label>
                                            <input class="form-control" type="text" name="name" id="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Cantidad</label>
                                            <input class="form-control" type="number" name="quantity" id="quantity" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="category_id">Proveedor</label>
                                                <select class="form-control" name="provider_id" id="provider_id" required>
                                                    <option value="" selected>Tipo de Recurso</option>
                                                    <option value="1">Insumo</option>
                                                    <option value="1">Balanceado</option>
                                                </select>
                                            </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{__('Close')}}</button>
                                    <button type="button" class="btn btn-primary">{{__('Save')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                              
                            </div>
                        </section>
                    </div>
                    <div class="modal fade" id="addProviderModal" tabindex="-1" role="dialog"
                        aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Proveedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-group" action="{{route('provider.store')}}" method="post">
                                    {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name">Nombre del Proveedor</label>
                                            <input class="form-control" type="text" name="name" id="name" required="">
                                        </div>
                                        <div class="form-group">
                                                <label for="Phone">Número de teléfono</label>
                                                <input class="form-control" type="tel" name="phone" id="phone" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="Phone">Email</label>
                                                    <input class="form-control" type="email" name="email" id="email" required>
                                                </div>
                                                <div class="form-group">
                                                        <label for="Phone">Dirección</label>
                                                        <input class="form-control" type="text" name="address" id="address" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                                                                </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{__('Close')}}</button>
                                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                                </div>
            
                            </div>
                        </div>
                    </div>

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
                                                    <a href="" class="btn btn-success btn-xs mr-4">
                                                        <i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                              
                            </div>
                        </section>
                    </div>
                    <div class="modal fade" id="addLabModal" tabindex="-1" role="dialog"
                        aria-labelledby="SellersModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SellersModalLabel">Agregar Laboratorio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-group" action="" method="post">
                                        <div class="form-group">
                                            <label for="name">Nombre del Laboratorio</label>
                                            <input class="form-control" type="text" name="name" id="name" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="name">Teléfono</label>
                                                <input class="form-control" type="tel" name="phone" id="phone" required>
                                            </div>
                                            <div class="form-group">
                                                    <label for="name">Email</label>
                                                    <input class="form-control" type="email" name="email" id="email" required>
                                                </div>
                                                <div class="form-group">
                                                        <label for="name">Dirección</label>
                                                        <input class="form-control" type="text" name="address" id="address" required>
                                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{__('Close')}}</button>
                                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>