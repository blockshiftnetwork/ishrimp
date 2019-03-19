@extends('spark::layouts.app')

@section('content')
<div>
    <div class="spark-screen container" style="min-height: fit-content; height: 100%; width: 100%;">
        <div style="height: 100%;">
            <!-- Tabs -->
            @section('Cultivo_options')
            <ul class="nav flex-column mb-4 ">
            <!--<li class="nav-item">
                    <a class="nav-link" href="#balanced" aria-controls="balanced" role="tab" data-toggle="tab">
                        <i class="flaticon-bagofflour space"></i>
                        {{__('Balanced')}}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#pools" aria-controls="pools" role="tab" data-toggle="tab">
                            <i class="fa fa-spinner icon"></i>
                        {{__('Comprobar comedero')}}
                    </a>
                </li> -->
                <li class="nav-item ">
                    <a class="nav-link" href="#balanced" aria-controls="pools" role="tab" data-toggle="tab">
                            <i class="fa fa-eyedropper icon"></i>
                        {{ __('Insumos y Minerales') }}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#abw" aria-controls="pools" role="tab" data-toggle="tab">
                            <i class="fa fa-balance-scale icon"></i>
                        {{ __('ABW') }}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#pools" aria-controls="pools" role="tab" data-toggle="tab">
                            <i class="fa fa-bar-chart icon"></i>
                        {{ __('Parametros Diarios') }}
                    </a>
                </li>
            </ul>
            @endsection

            <div style="height: 100%; width: 100%;">
                <div class="tab-content">
                    <!-- Profile -->
                    <div role="tabcard" class="tab-pane active " id="balanced">
                        @include('spark::cultivation.resources_used')
                    </div>
                    <div role="tabcard" class="tab-pane" id="abw">
                        @include('spark::cultivation.abw')
                    </div>
                    <div role="tabcard" class="tab-pane" id="pools">
                        @include('spark::cultivation.dayly-parameters')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection