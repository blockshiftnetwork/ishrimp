@extends('spark::layouts.app')

@section('content')
<cultivation>
 <div class="spark-screen container" style="min-height: fit-content; height: 100%; width: 100%;">
            <div style="height: 100%;">
                <!-- Tabs -->
@section('Cultivo_options')
<ul class="nav flex-column mb-4 ">
    <li class="nav-item">
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

       <div style="height: 100%; width: 100%;">
                        <div class="tab-content">
                            <!-- Profile -->
                            <div role="tabcard" class="tab-pane active " id="balanced">
                                @include('spark::cultivation.balanced')
                            </div>
                          
                        </div>
                    </div>
            </div>
  </div>
        </div>
</cultivation>
@endsection