@extends('spark::layouts.app')

@section('content')

@section('Cultivo_options')
<ul class="nav flex-column mb-4 ">
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


</ul>
@endsection
<div class="mid_container">	
        <div class="input-append date mb-2">
       <input type="text" class="datapicker">
       <span class="add-on"><i class="fa fa-calendar"></i></span>
        </div>
    <section class="section">
        <div class=" " id="feed_table" style="overflow: hidden;">
            <form class="feeding_form">
                <table  class="table table-striped table-hover bg-white" id="feedSch_tbl"  style="width:99.9%;">
                    <thead class="thead-primary">
                        <tr>
                        <th class=""  scope="col">
                            <div class="tablesorter-header-inner">Nombre piscina</div>
                        </th>
                        <th class="" >
                                <div class="tablesorter-header-inner">Nombre del Alimento</div>
                            </th>
                            <th class="" >
                                    <div class="tablesorter-header-inner">Cantidad</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="results" aria-live="polite" aria-relevant="all">
                            <tr class="scrl_tr" role="row">
                                    <td class="filter_row">
                                        <span class="tank_filter">Piscina 2</span>
                                        <input type="hidden" name="feedingTankId[]" value="1258">
                                    </td>
                                    <td>
                                    <select class="feeding_scrl_slt" name="feedingFeed[]">
                                        <option value="643">Lorica 1-Gisis</option>
                                        <option value="644">Lorica 2-Gisis</option>
                                        <option value="645">Lorica 3-Gisis</option>
                                        <option value="646">Lorica 4-Gisis</option>
                                        </td>
                                        <td class="filter_row">
                                                <input type="text" name="feedingTankId[]" placeholder="Kg" value="">
                                        </td>
                                    </tr>
                                   <tr class="scrl_tr" role="row">
                                    <td class="filter_row"><span class="tank_filter">Piscina 6</span>
                                        <input type="hidden" name="feedingTankId[]" value="1262">
                                    </td>
                                    <td>
                                        <select class="feeding_scrl_slt" name="feedingFeed[]">
                                            <option value="643">Lorica 1-Gisis</option>
                                            <option value="644">Lorica 2-Gisis</option>
                                            <option value="645">Lorica 3-Gisis</option>
                                            <option value="646">Lorica 4-Gisis</option>
                                        
                                    </td>
                                    <td class="filter_row">
                                            <input type="text" name="feedingTankId[]" placeholder="Kg" value="">
                                        </td>
                                    
                                </tr>
                            
                            </tbody>
                        </table>
                    </form>
                </div>
    </section>
    <div class="row mx-auto">
        <div class="btn btn-group btn-group-md mx-auto">
            <button type="button" id="saveFeeding" class="btn btn-success ml-5 mr-5">Guardar</button>
            <button type="button" class="btn btn-danger cancel mr-5">Cancelar</button>						
        </div>
    </div>	
    	
</div>

@endsection