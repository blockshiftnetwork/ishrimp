@extends('spark::layouts.app')


@section('content')
    <spark-settings :user="user" :teams="teams" inline-template>
        <div class="spark-screen container">
            <div class="row">
                <!-- Tabs -->
                @section('Cultivo_options')
                <ul class="nav flex-column mb-4">
                    <li class="nav-item">
                        <a class="nav-link" href="#medicine" aria-controls="medicine" role="tab" data-toggle="tab">
                            <i class="fa fa-eyedropper icon"></i>
                            {{__('Medicina')}}
                        </a>
                    </li>
                </ul>
                <ul class="nav flex-column mb-4">
                    <li class="nav-item">
                        <a class="nav-link" href="#dayly-parameters" aria-controls="dayly-parameters" role="tab" data-toggle="tab">
                            <i class="fa fa-bar-chart icon"></i>
                            {{__('Parámetros Diarios')}}
                        </a>
                    </li>
                </ul>
                @endsection

                <!-- Tab Cards -->
                <div class="col-12">
                    <div class="tab-content">
                        <div role="tabcard" class="tab-pane active" id="medicine">
                            @include('spark::culture.medicine')
                        </div>
                    </div>
                    <div class="tab-content">
                        <div role="tabcard" class="tab-pane" id="dayly-parameters">
                            @include('spark::culture.dayly-parameters')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </spark-settings>
@endsection
