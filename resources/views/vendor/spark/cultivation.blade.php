@extends('spark::layouts.app')

@section('content')
<cultivation>
    <div class="spark-screen container" style="min-height: fit-content; height: 100%; width: 100%;">
        <div style="height: 100%;">
            <!-- Tabs -->
            @section('Cultivo_options')
            <ul class="nav flex-column mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#resources_used" aria-controls="medicine" role="tab" data-toggle="tab">
                        <i class="fa fa-eyedropper icon"></i>
                        {{__('Resources Used')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#dayly-parameters" aria-controls="dayly-parameters" role="tab"
                        data-toggle="tab">
                        <i class="fa fa-bar-chart icon"></i>
                        {{__('Parámetros Diarios')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#abw" aria-controls="abw" role="tab"
                        data-toggle="tab">
                        <i class="fa fa-bar-chart icon"></i>
                        {{__('ABW')}}
                    </a>
                </li>
            </ul>
            @endsection

            <div style="height: 100%; width: 100%;">
                <div class="tab-content">
                    <div role="tabcard" class="tab-pane active " id="resources_used">
                        @include('spark::cultivation.resources_used')
                    </div>
                    <div role="tabcard" class="tab-pane" id="dayly-parameters">
                        @include('spark::cultivation.dayly-parameters')
                    </div>
                    <div role="tabcard" class="tab-pane" id="abw">
                        @include('spark::cultivation.abw')
                    </div>
                </div>
            </div>
        </div>
    </div>
</cultivation>
@endsection
