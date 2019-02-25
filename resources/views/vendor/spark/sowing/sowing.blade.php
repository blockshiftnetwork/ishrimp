@extends('spark::layouts.app')

@section('content')

@section('Sowing_options')
<!--<ul class="nav flex-column mb-4 ">
    <li class="nav-item">
            <a class="nav-link" href="#balanced" aria-controls="balanced" role="tab" data-toggle="tab">
                <i class="flaticon-bagofflour space"></i>
                {{__('Balanced')}}
            </a>
        </li>
        <li class="nav-item ">
                <a class="nav-link" href="#maps" aria-controls="maps" role="tab" data-toggle="tab">
                    <i class="fa fa-map icon"></i>
                    {{__('Balanceado piscina')}}
                </a>
            </li>


        <li class="nav-item ">
            <a class="nav-link" href="#pools" aria-controls="pools" role="tab" data-toggle="tab">
                    <i class="fa fa-spinner icon"></i>
                {{__('Comprobar comedero')}}
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="#pools" aria-controls="pools" role="tab" data-toggle="tab">
                    <i class="fa fa-spinner icon"></i>
                {{__('Medicina')}}
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="#pools" aria-controls="pools" role="tab" data-toggle="tab">
                    <i class="fa fa-spinner icon"></i>
                {{__('ABW')}}
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="#pools" aria-controls="pools" role="tab" data-toggle="tab">
                    <i class="fa fa-spinner icon"></i>
                {{__('Pruebas de laboratorio')}}
            </a>
        </li>


</ul>-->
@endsection
<div class="mid_container">	
    <section class="section">
        <div class=" " id="feed_table" style="overflow: hidden;">
    <div class="pull-left search mb-2">
        <input class="form-control" type="text" placeholder="Buscar">
     </div>
    <div class="pull-right search mb-2">
        <button type="button" id="addfood" class="btn btn-info ml-5" data-toggle="modal" data-target="#addSowingModal"><i class="fa fa-plus" aria-hidden="true"></i>  Añadir Alimento</button>
     </div>
            <form class="feeding_form">
                <table  class="table table-striped table-hover bg-white text-center" id="feedSch_tbl"  style="width:99.9%;">
                    <thead class="thead-primary">
                        <tr>
                        <th class=""  scope="col">
                            <div class="tablesorter-header-inner">Nombre del Recurso</div>
                        </th>
                        <th class="" >
                                <div class="tablesorter-header-inner">Cantidad de Siembra</div>
                            </th>
                            <th class="" >
                                    <div class="tablesorter-header-inner">Última Cantidad Comprada</div>
                                </th>
                            <th class="" >
                                    <div class="tablesorter-header-inner">Última Actualización</div>
                                </th>
                            <th class="" >
                                    <div class="tablesorter-header-inner">Acciones</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="results" aria-live="polite" aria-relevant="all">
                            <tr class="scrl_tr" role="row">
                                    <td class="filter_row">
                                        <span class="tank_filter">Lorica 2 - Gisis</span>
                                        <input type="hidden" name="feedingTankId[]" value="1258">
                                    </td>
                                    <td class="filter_row">
                                        <span class="tank_filter">2010 Kg</span>
                                        <input type="hidden" name="feedingTankId[]" value="1258">
                                    </td>
                                    <td class="filter_row">
                                        <span class="tank_filter">0 Kg</span>
                                        <input type="hidden" name="feedingTankId[]" value="1258">
                                    </td>
                                    <td class="filter_row">
                                        <span class="tank_filter">29-Jan 19 9:28 PM</span>
                                        <input type="hidden" name="feedingTankId[]" value="1258">
                                    </td>
                                        <td class="text-center">
                                            <div class="actions btn btn-group-sm">
                                                <a href="" class="btn btn-success btn-xs mr-4">
                                                    <i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash-o" ></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                   <tr class="scrl_tr" role="row">
                                    <td class="filter_row"><span class="tank_filter">Lorica 4 - Gisis</span>
                                        <input type="hidden" name="feedingTankId[]" value="1262">
                                    </td>
                                    <td class="filter_row">
                                        <span class="tank_filter">2850 Kg</span>
                                        <input type="hidden" name="feedingTankId[]" value="1258">
                                    </td>
                                    <td class="filter_row">
                                        <span class="tank_filter">0 Kg</span>
                                        <input type="hidden" name="feedingTankId[]" value="1258">
                                    </td>
                                    <td class="filter_row">
                                        <span class="tank_filter">29-Jan 19 9:30 PM</span>
                                        <input type="hidden" name="feedingTankId[]" value="1258">
                                    </td>
                                   <td class="text-center">
                                            <div class="actions btn btn-group-sm">
                                                <a href="" class="btn btn-success btn-xs mr-4">
                                                    <i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash-o" ></i></a>
                                            </div>
                                        </td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </form>
                        <div class="footer_feed_cont">
                                <div class="row">
                                    <div class="one col-md-6">
                                        <span class="font-weight-bold">* NA: No Aplica * Kg: Kilo gramos * L: Litros * Rs: Rupias</span>
                                    </div>   
                                </div>
                        </div>
                    </div>
    </section>
    <!-- <div class="row mx-auto">
        <div class="btn btn-group btn-group-md mx-auto">
            <button type="button" id="saveFeeding" class="btn btn-success ml-5 mr-5">Guardar</button>
            <button type="button" class="btn btn-danger cancel mr-5">Cancelar</button>						
        </div>
    </div>
    <div id="sowing" class="card bg-white" style="z-index: 999; position: absolute; top: 60%">
<div class="card-body">
   <div class="row mx-auto"> 
    <form class="form-group" role="form" role="form" method="POST" action="{{route('pools_sowing.store')}}">
    {{ csrf_field() }}
        <div class="col-md-12  mx-auto">
        <label for="pool_id">Piscina</label>
        <input class="form-control mb-9" type="text" name="pool_id" placeholder="nombre" id="pool_id">
        <label for="planted_larvae">Hectareas</label>
        <input class="form-control mb-2" type="text" name="planted_larvae" placeholder="Area" id="planted_larvae">
        <input class="form-control mb-2" type="text" name="larvae_type" placeholder="coordenadas" id="larvae_type">
         <input class="form-control mb-2" type="text" name="planted_at" placeholder="coordenadas" id="planted_at">
    </div>
   
           <button id="savePool" class="btn btn-success btn-block" type="submit">Guardar</button>
   
</form>
</div>
</div>
</div>  -->
<div class="modal fade" id="addSowingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@section('scripts')

@endsection
<script type="text/javascript">
    $('#addSowingModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>

@endsection