@extends('spark::layouts.app')


@section('content')
@if(session()->has('message'))
        <div class="alert alert-success">
                {{ session()->get('message') }}
        </div>
@endif 
    <div>
        <div class="spark-screen container">
            <div class="row">
                <!-- Tabs -->
                @section('Sowing_options')
                <ul class="nav flex-column mb-4 ">
                    <li class="nav-item ">
                        <a class="nav-link active" href="#pool_sowing" aria-controls="pools" role="tab" data-toggle="tab">
                                <i class="fa fa-spinner icon"></i>
                                    {{__('Sembrar piscina')}}
                        </a>
                    </li>
                                           
                </ul>
                    @endsection

                <!-- Tab Cards -->
                <div class="col-12">
                    <div class="tab-content">
                    <div role="tabcard" class="tab-pane active" id="pool_sowing">
                            @include('spark::sowing.pool_sowing')
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('sowing-scripts')
<script> 
$(document).ready(function() {
    var j = 0;
    $('#planted_at').flatpickr({
        altInput: true,
        altFormat: 'F j, Y',
        dateFormat: 'Y-m-d'
    });
    $('#planted_at_update').flatpickr({
        altInput: true,
        altFormat: 'F j, Y',
        dateFormat: 'Y-m-d'
    });

    // sowed Pool  actions
 $('#editSowingPoolModal').on('shown.bs.modal',function(event){
         var button = $(event.relatedTarget);
         var modal = $(this);
         var id = button.data('id');
         var pool_id = button.data('pool_id');
         var planted_larvae = button.data('planted_larvae');
         var larvae_type = button.data('larvae_type')
         var planted_at = button.data('planted_at');
         modal.find('.modal-body #larvae_type').val(larvae_type);
         modal.find('.modal-body #pool_id').val(pool_id);
         modal.find('.modal-body #planted_larvae').val(planted_larvae);
         modal.find('.modal-body #planted_at_update').val(planted_at);
         modal.find('.modal-body #id').val(id);
        })

        $('#deleteSowingPoolModal').on('shown.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            modal.find('.modal-body #id').val(id);
           })
        
        //modify of search field
        
        $holders = $("#pool_sowing > div.card > div.card-body > section > div.bootstrap-table > div.fixed-table-toolbar > div > input").detach();
        $("#pool_sowing > div.card > div.card-body > section > div.bootstrap-table > div.fixed-table-toolbar").hide();
        $("#pool_sowing > div.card > div.card-header > div.search").append($holders);  

        //validation of modal
        $( "#name" ).change(function() {
         let planted = $( "#name" ).val()
         if (planted.length > 0 ) {
         $("#name").addClass('border border-success');
         $("#name").removeClass('border border-danger');
         $("#envi").attr("disabled", false);
         } else {
         $("#name").removeClass('border border-success');
         $("#name").addClass('border border-danger');
         $("#envi").attr("disabled", true);
         } 
        });

        $( ".flatpickr-input" ).change(function() {
         let planted = $( "#planted_at" ).val()
         if (planted.length > 0 ) {
         $(".flatpickr-input").addClass('border border-success');
         $(".flatpickr-input").removeClass('border border-danger');
         $("#envi").attr("disabled", false);
         } else {
         $(".flatpickr-input").removeClass('border border-success');
         $(".flatpickr-input").addClass('border border-danger');
         $("#envi").attr("disabled", true);
         } 
        });

        $( "#larvae_type" ).change(function() {
         let planted = $( "#larvae_type" ).val()
         if (planted.length > 0 ) {
         $("#larvae_type").addClass('border border-success');
         $("#larvae_type").removeClass('border border-danger');
         $("#envi").attr("disabled", false);
         } else {
         $("#larvae_type").removeClass('border border-success');
         $("#larvae_type").addClass('border border-danger');
         $("#envi").attr("disabled", true);
         } 
        });

        $('#envi').click(function() {

        let l_sowed = $( "#name" ).val()
        let l_type = $( "#larvae_type" ).val()
        let planted = $( "#planted_at" ).val()
        
        if (l_sowed == 0 || l_sowed == '') {
         $("#name").addClass('border border-danger');
         $("#envi").attr("disabled", true);
        }
        
        if (l_type == 0 || l_type == '') {
         $("#larvae_type").addClass('border border-danger');
         $("#envi").attr("disabled", true);
        }

        if (planted == 0 || planted == '') {
         $(".flatpickr-input").addClass('border border-danger');
         $("#envi").attr("disabled", true);
        }
        });


});

 
 
</script>
@endsection