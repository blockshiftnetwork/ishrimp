@extends('spark::layouts.app')

@section('content')
<div>
    <div class="spark-screen container" style="min-height: fit-content; height: 100%; width: 100%;">
        <div style="height: 100%;">
            <!-- Tabs -->
            @section('Cultivo_options')
            <ul class="nav flex-column mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#resources_used" aria-controls="medicine" role="tab" data-toggle="tab">
                        <i class="fa fa-eyedropper icon"></i>
                        {{__('Resources Used')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#dayly-parameters" aria-controls="dayly-parameters" role="tab"
                        data-toggle="tab">
                        <i class="fa fa-bar-chart icon"></i>
                        {{__('Parámetros Diarios')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#abw" aria-controls="abw" role="tab"
                        data-toggle="tab">
                        <i class="fa fa-bar-chart icon"></i>
                        {{__('ABW')}}
                    </a>
                </li>
            </ul>
            
            @endsection

            <div style="height: 100%; width: 100%;">
                <div class="tab-content">
                    <div role="tabcard" class="tab-pane active " id="resources_used">
                        @include('spark::cultivation.resources_used')
                    </div>
                    <div role="tabcard" class="tab-pane" id="dayly-parameters">
                        @include('spark::cultivation.dayly-parameters')
                    </div>
                    <div role="tabcard" class="tab-pane" id="abw">
                        @include('spark::cultivation.abw')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('cultivation-scripts')
<script>
$(document).ready(function() {
    var j = 0;
    $('#dateField').flatpickr({
        altInput: true,
        altFormat: 'F j, Y',
        dateFormat: 'Y-m-d'
    });

    $('#medicine-table').on('click', '.btn-duplicate', function() {
        let current_row = $(this).parent().parent(),
            new_row = current_row.clone(),
            table_body = current_row.parent();

        $(this).off('click');
        $(this).removeClass('btn-duplicate');
        $(this).addClass('btn-delete');
        $(this).html('<b>-</b>');

        table_body.append(new_row.attr('id',++j));
    });

    $('#medicine-table').on('click', '.btn-delete', function() {
        $(this).parent().parent().remove();
    })

    $('.btn-abw').popover({title: "Muestras", html: true, placement: "bottom"});
    $('#tbl_abw').on('click', '.btn-abw', function(event) {
         var tr = $(this).parent().parent();
         var tag = $(event.target).parent();
        $(tag).popover('toggle');
        
        $('.popover-body').append('<div id="cal-pop" class="row cal-content"></div>');
        $('.cal-content').append('<div class="col-md-6 mx-auto"><input id="new-abw" class="form-control" placeholder="ABW" type="text"></div>');
        $('.cal-content').append('<div class="col-md-6 mx-auto"><input id="sample" class="form-control" placeholder="muestra" type="text"></div>');
        $('.popover-body').append('<div id="btn-gr" class="row mt-2"><button id="cal-abw" class="btn btn-success mx-auto">calcular</button><button id="close-pop" class="btn btn-danger mx-auto">cancelar</button></div>');
        $('#btn-gr').on('click', '#cal-abw', function() {
        let inputs = tr.find('input');
        let lastAbw = $(inputs[7]);
        let abw =  $(inputs[8]);
        let wg = $(inputs[9]);
        let newAbw = $('#new-abw')[0].value;
        let sample = $('#sample')[0].value;
        abw.val((newAbw/sample).toFixed(2));
        wg.val((abw.val() - lastAbw.val()).toFixed(2));
        $('.btn-abw').popover('hide');
    });

    $('#btn-gr').on('click', '#close-pop', function() {
        $('.btn-abw').popover('hide');
    });

    })    
});

function showPopover(){

}
function select(event){
    var id = event.target.value;
    var presentation = $(event.target).parent().next().children();
    $(presentation[0]).empty();
    $(presentation[0]).append('<option value="" selected>Seleccione</option>');
    $.ajax({
        url: "presentation/"+id,
        type: 'GET',
        dataType: 'json',
        success: function(response){
         var resp = response.data;
          for(var i = 0; i<resp.length; i++){
            $(presentation[0]).append('<option value="'+ resp[i].id +'">'+resp[i].name+'</option>');
          }
        }
    });

   
};

function saveData(){

   $(this).addClass('disabled');

    var table = $('#medicine-table');
    var exitsData = false;
    var timeout = null;

    table.find('tr').each(function(){
        //Find inputs
        $(this).find('.form-control').each(function(){
            textVal = this.value;
            inputName = $(this).attr("name");
            $('#'+inputName+'_s').val(textVal);
           exitsData= true;

        });
        //if exits inputs inside tr
        if(exitsData){
            var form = $('#data').serialize();
            $.post("{{route('cultivation.store')}}",form,function(resp){
              console.log(resp);
             }).done(function(){
               clearTimeout(timeout);
               timeout = setTimeout(function(){
                $('#alert').addClass('show');
                $('#alert').on('closed.bs.alert',function(){
                    location.reload();
                });
               }, 2000)
             }).fail(function(resp){
                console.log('error',resp);
             });
             
        }
    })
   
}
    function calabw(){
      
        console.log('cal');
        console.log($('#tbl_abw').bootstrapTable('getSelections'))
  
    }
   
</script>

@endsection
