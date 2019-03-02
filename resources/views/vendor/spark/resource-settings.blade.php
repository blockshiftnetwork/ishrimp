@extends('spark::layouts.app')


@section('content')
    <spark-settings :user="user" :teams="teams" inline-template>
        <div class="spark-screen container">
            <div class="row">
                <!-- Tabs -->
                @section('resource_options')
                <ul class="nav flex-column mb-4">
                    <li class="nav-item ">
                        <a class="nav-link active" href="#resource" aria-controls="resource" role="tab" data-toggle="tab">
                            <i class="fa fa-eyedropper icon"></i>
                            {{__('resource')}}
                        </a>
                    </li>
                </ul>
              
                @endsection

                <!-- Tab Cards -->
                <div class="col-12">
                    <div class="tab-content">
                        <div role="tabcard" class="tab-pane active" id="medicine">
                            @include('spark::resource.resource')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </spark-settings>
@endsection
