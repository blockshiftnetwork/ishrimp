@extends('spark::layouts.app')


@section('content')
    <home :user="user" :teams="teams" inline-template>
        <div class="spark-screen container" style="min-height: fit-content; height: 100%; width: 100%;">
            <div style="height: 100%;">
                <!-- Tabs -->
                @section('overview_options')
                <ul class="nav flex-column mb-4 ">
                        <li class="nav-item">
                                <a class="nav-link" href="#dashboard" aria-controls="dashboard" role="tab" data-toggle="tab">
                                    <i class="fa fa-dashboard icon"></i>
                                    {{__('Visión General')}}
                                </a>
                            </li>
                            <li class="nav-item ">
                                    <a class="nav-link" href="#maps" aria-controls="maps" role="tab" data-toggle="tab">
                                        <i class="fa fa-map icon"></i>
                                        {{__('Mapas')}}
                                    </a>
                                </li>


                            <li class="nav-item ">
                                <a class="nav-link" href="#pools" aria-controls="pools" role="tab" data-toggle="tab">
                                        <i class="fa fa-spinner icon"></i>
                                    {{__('Piscinas')}}
                                </a>
                            </li>


                        <li class="nav-item ">
                            <a class="nav-link" href="" aria-controls="param" role="tab" data-toggle="tab">
                                    <i class="fa fa-bar-chart icon"></i>
                                {{__('Parametros Diarios')}}
                            </a>
                        </li>

                    </ul>
                @endsection

                <!-- Tab cards -->
                <div style="height: 100%; width: 100%;">
                        <div class="tab-content">
                            <!-- Profile -->
                            <div role="tabcard" class="tab-pane active " id="dashboard">
                                @include('spark::dashboard.overview')
                            </div>
                            <div role="tabcard" class="tab-pane " id="maps" style="height: 100%; width: 100%;">
                                    @include('spark::dashboard.maps')
                                </div>
                                <div role="tabcard" class="tab-pane " id="pools" style="height: 100%; width: 100%;">
                                    @include('spark::dashboard.pools')
                                </div>
                        </div>
                    </div>
            </div>
        </div>
    </home>
@endsection

