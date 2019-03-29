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
         modal.find('.modal-body #planted_at').val(planted_at);
         modal.find('.modal-body #id').val(id);
        })

        $('#deleteSowingPoolModal').on('shown.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            modal.find('.modal-body #id').val(id);
           })

 
</script>
@endsection