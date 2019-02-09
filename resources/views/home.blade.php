@extends('spark::layouts.app')


@section('content')
    <home :user="user" :teams="teams" inline-template>
        <div class="spark-screen container">
            <div class="row">
                <!-- Tabs -->
                @section('overview_options')
                <ul class="nav flex-column mb-4 ">
                        <li class="nav-item">
                                <a class="nav-link" href="#dashboard" aria-controls="dashboard" role="tab" data-toggle="tab">
                                    <i class="fa fa-dashboard icon"></i>
                                    {{__('Dashboard')}}
                                </a>
                            </li>
                            <li class="nav-item ">
                                    <a class="nav-link" href="" aria-controls="Inventario" role="tab" data-toggle="tab">
                                        <i class="fa fa-map icon"></i>
                                        {{__('Maps')}}
                                    </a>
                                </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="" aria-controls="Inventario" role="tab" data-toggle="tab">
                                <i class="fa fa-dashboard icon"></i>
                                {{__('Inventario')}}
                            </a>
                        </li>


                            <li class="nav-item ">
                                <a class="nav-link" href="" aria-controls="pools" role="tab" data-toggle="tab">
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
                <div class="col-md-9">
                        <div class="tab-content">
                            <!-- Profile -->
                            <div role="tabcard" class="tab-pane active" id="dashboard">
                                @include('spark::dashboard.overview')
                            </div>


                        </div>
                    </div>
            </div>
        </div>
    </home>
@endsection

