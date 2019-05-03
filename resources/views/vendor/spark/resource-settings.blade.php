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
                @section('resource_options')
                <ul class="nav flex-column mb-4">
                    <li class="nav-item ">
                        <a id="resource" class="nav-link active" href="#resources" aria-controls="resource" role="tab" data-toggle="tab">
                            <i class="fa fa-eyedropper icon"></i>
                            {{__('Resources')}}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a id="tab_inventory" class="nav-link" href="#inventory" aria-controls="inventory" role="tab" data-toggle="tab">
                            <i class="fa fa-eyedropper icon"></i>
                            {{__('Inventory')}}
                        </a>
                    </li>
                </ul>
              
                @endsection

                <!-- Tab Cards -->
                <div class="col-12">
                    <div class="tab-content">
                        <div role="tabcard" class="tab-pane active" id="resources">
                            @include('spark::resource.resource')
                        </div>
                        <div role="tabcard" class="tab-pane" id="inventory">
                            @include('spark::resource.inventory')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
<script>

    $(function(){
      var act =  getParameterByName('inventory');
      var config =  getParameterByName('tab');
      if(act === '1'){
        $('#tab_inventory').tab('show');
      }
      if(config == '4'){
        $('#resource-tab').removeClass('active');
        $('#link-recources').removeClass('active')
        $('#link-lab').addClass('active');
        $('#labs').addClass('active');
        $('#labs').tab('show');
      }
      console.log(act);
    });

    function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }
      // provider actios
        $('#editProviderModal').on('shown.bs.modal',function(event){
         var button = $(event.relatedTarget);
         var modal = $(this);
         var id = button.data('id');
         var name = button.data('name');
         var phone = button.data('phone');
         var email = button.data('email')
         var address = button.data('address');
         modal.find('.modal-body #name').val(name);
         modal.find('.modal-body #phone').val(phone);
         modal.find('.modal-body #email').val(email);
         modal.find('.modal-body #address').val(address);
         modal.find('.modal-body #id').val(id);
        })

        $('#deleteProviderModal').on('shown.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            modal.find('.modal-body #id').val(id);
           })

    // resources actions
    $('#editResourceModal').on('shown.bs.modal',function(event){
         var button = $(event.relatedTarget);
         var modal = $(this);
         var id = button.data('id');
         console.log(id);
         var name = button.data('name');
         var category_id = button.data('category_id');
         var provider_id = button.data('provider_id')
         modal.find('.modal-body #name').val(name);
         modal.find('.modal-body #provider_id').val(provider_id);
         modal.find('.modal-body #category_id').val(category_id);
         modal.find('.modal-body #id').val(id);
        })

        $('#deleteResourceModal').on('shown.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            modal.find('.modal-body #id').val(id);
           })

      // presentation actions
      $('#editPresentationModal').on('shown.bs.modal',function(event){
         var button = $(event.relatedTarget);
         var modal = $(this);
         var id = button.data('id');
         console.log(id);
         var name = button.data('name');
         var quantity = button.data('quantity');
         var price = button.data('price');
         var unity = button.data('unity')
         var resource_id = button.data('resource_id')
         modal.find('.modal-body #name').val(name);
         modal.find('.modal-body #quantity').val(quantity);
         modal.find('.modal-body #price').val(price);
         modal.find('.modal-body #unity').val(unity);
         modal.find('.modal-body #resource_id').val(resource_id);
         modal.find('.modal-body #id').val(id);
        })

        $('#deletePresentationModal').on('shown.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            modal.find('.modal-body #id').val(id);
           })

     // laboratories actions
     $('#editLabModal').on('shown.bs.modal',function(event){
         var button = $(event.relatedTarget);
         var modal = $(this);
         var id = button.data('id');
         var name = button.data('name');
         var phone = button.data('phone');
         var email = button.data('email');
         var address = button.data('address')
         modal.find('.modal-body #name').val(name);
         modal.find('.modal-body #phone').val(phone);
         modal.find('.modal-body #email').val(email);
         modal.find('.modal-body #address').val(address);
         modal.find('.modal-body #id').val(id);
        })

        $('#deleteLabModal').on('shown.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            modal.find('.modal-body #id').val(id);
           })
              //Inventory actions
 $('#editInventoryModal').on('shown.bs.modal',function(event){
         var button = $(event.relatedTarget);
         var modal = $(this);
         var id = button.data('id');
         var team_id = button.data('team_id');
         var resource_id = button.data('resource_id');
         var quantity = button.data('quantity')
         var presentation_id = button.data('presentation_id');
         var present_input = modal.find('.modal-body #presentation_id');
         console.log('presentation',present_input)
         $.ajax({
            url: "presentation/" + resource_id,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                var resp = response.data;
                 present_input.empty();
                 present_input.append('<option value="" selected>Presentación</option>');
                for (var i = 0; i < resp.length; i++) {
                    modal.find('.modal-body #presentation_id').append('<option value="' + resp[i].id + '">' + resp[i].name + '</option>');
                }
                
                present_input.val(presentation_id);
            }
        });

         modal.find('.modal-body #id').val(id);
         modal.find('.modal-body #team_id').val(team_id);
         modal.find('.modal-body #resource_id').val(resource_id);
         modal.find('.modal-body #quantity').val(quantity);
         
        
        })

        $('#deleteInventoryModal').on('shown.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            modal.find('.modal-body #id').val(id);
           })

    function select(event) {
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
    };

            //modify of search field
        $( document ).ready(function() {
           
        $resource_tab = $("#resource-tab > div.mid_container > section > div.bootstrap-table > div.fixed-table-toolbar > div > input").detach();
        $presentations_tab = $("#feed_table > div.bootstrap-table > div.fixed-table-toolbar > div > input").detach();
        $providers_tab = $("#providers > div.mid_container > section > div.bootstrap-table > div.fixed-table-toolbar > div > input").detach();
        $lab_tab = $("#labs > div.mid_container > section > div.bootstrap-table > div.fixed-table-toolbar > div > input").detach();
           
        $("#resource-tab > div.mid_container > section > div.bootstrap-table > div.fixed-table-toolbarr").hide();
        $("#feed_table > div.bootstrap-table > div.fixed-table-toolbar > div > input").hide();
        $("#providers > div.mid_container > section > div.bootstrap-table > div.fixed-table-toolbar > div > input").hide();
        $("#labs > div.mid_container > section > div.bootstrap-table > div.fixed-table-toolbar > div > input").hide();
        
        $("#pond-detail-pills > div").append($resource_tab);
        $("#pond-detail-pills > div").append($presentations_tab);
        $("#pond-detail-pills > div").append($providers_tab);
        $("#pond-detail-pills > div").append($lab_tab);  
            
     });

        //console.log('es'+active);
         </script>
@endsection