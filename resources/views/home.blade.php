@extends('spark::layouts.app')

@section('content')
    <home :user="user" :teams="teams" inline-template>
        <div class="spark-screen " style="min-height: fit-content; height: 100%; width: 100%;">
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
                                <a id="tab_maps" class="nav-link" href="#maps" aria-controls="maps" role="tab" data-toggle="tab">
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
                            <a class="nav-link" href="#simulations" aria-controls="simulations" role="tab" data-toggle="tab">
                                    <i class="fa fa-spinner icon"></i>
                                {{__('Simulaciónes')}}
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
                            <div role="tabcard" class="tab-pane " id="simulations" style="height: 100%; width: 100%;">
                                    @include('spark::dashboard.simulation')
                            </div>
                        </div>
                    </div>
            </div>
           
        </div>
       
    </home>
    @include('spark::modals.dashboard.modalCreatePool')
    @include('spark::modals.dashboard.modalPool')
    @include('spark::modals.dashboard.modalResourcesUsed')
    @include('spark::modals.dashboard.modalBalancedPool')
    @include('spark::modals.dashboard.modalAbwPool')
    @include('spark::modals.dashboard.modalLabsPool')

@endsection

@section('custom-scripts')
<script src="{{ asset('js/gmaps.js') }}"> </script>
<script src="{{ asset('js/pools_summary.js') }}"> </script>
<script type="text/javascript" src="{{asset('js/simulation.js')}}"></script>
<script>
    $(function () {
        var j = 0;
        var t = new Date();
        console.log(t.getHours(), t.getMinutes());
        var timeout = null;
        $('#used_date').flatpickr({
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d',
            maxDate: "today",
            defaultDate: ["today"]
        });
        $('#balanced_date').flatpickr({
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d',
            maxDate: "today",
            defaultDate: ["today"]
        });
        $('#param_date').flatpickr({
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d',
            maxDate: "today",
            defaultDate: ["today"]
        });
        $('#param_hour').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            defaultDate: t.getHours()+':'+t.getMinutes()
        });
        $('#abw_date').flatpickr({
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d',
            maxDate: "today",
            defaultDate: ["today"]
        });
        $('#abw_hour').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            defaultDate: t.getHours()+':'+t.getMinutes()
        });
    $('#select_pool').selectpicker({
        'liveSearch': true,
    });    

     var tab =  getParameterByName('tab');
    if(tab === '2'){
        $('#tab_maps').tab('show');
      } 
});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

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