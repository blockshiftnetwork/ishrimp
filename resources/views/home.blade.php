@extends('spark::layouts.app')

@section('content')
    <home :user="user" :teams="teams" inline-template>
        <div class="spark-screen container" style="min-height: fit-content; height: 100%; width: 100%;">
            <div style="height: 100%;">
                <!-- Tabs -->
                @section('overview_options')
                <ul class="nav flex-column mb-4 ">
                        <li class="nav-item">
                            <a class="nav-link active" href="#dashboard" aria-controls="dashboard" role="tab" data-toggle="tab">
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
                    </ul>
                @endsection

                <!-- Tab cards -->
                <div style="height: 100%; width: 100%;">
                        <div class="tab-content">
                            <div role="tabcard" class="tab-pane active " id="dashboard">
                                @include('spark::dashboard.overview')
                            </div>
                            <div role="tabcard" class="tab-pane " id="maps" style="height:-webkit-fill-available; width: 100%;">
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
    @include('spark::modals.dashboard.modalPool')
    @include('spark::modals.dashboard.modalResourcesUsed')
    @include('spark::modals.dashboard.modalBalancedPool')

@endsection

@section('custom-scripts')
<script src="{{ asset('js/gmaps.js') }}"> </script>
<script src="{{ asset('js/pools_summary.js') }}"> </script>
<script>
    $(function () {
    $('#select_pool').selectpicker({
        'liveSearch': true,
    });    
});

function selectpresentation(event) {
        let id = event.target.value;
        let presentation = $(event.target).parent().next().next().children().next()
        console.log(presentation);
        $(presentation[0]).empty();
        $(presentation[0]).append('<option value="" selected>Presentación</option>');
        $.ajax({
            url: "presentation/" + id,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                var resp = response.data;
                for (var i = 0; i < resp.length; i++) {
                    $(presentation[0]).append('<option value="' + resp[i].id + '">' + resp[i].name + '</option>');
                }
            }
        });
    }
    $('#deletePoolModal').on('shown.bs.modal',function(event){
        console.log('show')
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            modal.find('.modal-body #pool_id').val(id);
           })
</script>
@endsection