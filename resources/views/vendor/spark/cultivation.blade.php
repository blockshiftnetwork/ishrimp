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
    $('#dateRs').flatpickr({
        altInput: true,
        altFormat: 'F j, Y',
        dateFormat: 'Y-m-d'
    });
    $('#dateDp').flatpickr({
        altInput: true,
        altFormat: 'F j, Y',
        dateFormat: 'Y-m-d'
    });
    $('#timeDp').flatpickr({
			enableTime: true,
			noCalendar: true,
			dateFormat: 'h:i K'
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

    $('.btn-abw').popover({title: "Muestras", html: true, placement: "left"});

    $('input').on('change',function(){
        console.log('change');
        if($(this).prop('name') === 'hc03' || $(this).prop('name') === 'co3'){
            var alcals = $(this).parent().parent().find('input');
            var co3 = parseInt($(alcals[6]).val(), 10);
            var hco3 = parseInt($(alcals[7]).val(), 10);
            var total = $(alcals[8]);
            co3 = co3 > 0 ? co3 : 0;
            hco3 = hco3 > 0 ? hco3 : 0;
            total.val(co3 + hco3);
        }
        
        
       
    })
}); 

function showPopover(event){
    var tr = $(event.target).parent().parent();
        tag = $(event.target);
        tag.popover('show', {title: "Muestras", html: true, placement: "left"});
        console.log(tag, tr);
        $('.popover-body').empty();
        $('.popover-body').append('<div id="cal-pop" class="row cal-content"></div>');
        $('.cal-content').append('<div class="col-6 mx-auto"><input id="new-abw" class="form-control" placeholder="ABW" type="number"></div>');
        $('.cal-content').append('<div class="col-6 mx-auto"><input id="sample" class="form-control" placeholder="muestra" type="number"></div>');
        $('.popover-body').append('<div id="btn-gr" class="row mt-2 btn-group-xs"><button id="cal-abw" class="btn btn-success mx-auto">calcular</button><button id="close-pop" class="btn btn-danger mx-auto">cancelar</button></div>');
       
        $('#btn-gr').on('click', '#cal-abw', function() {
        let inputs = tr.find('input');
        let lastAbw = $(inputs[7]);
        let abw =  $(inputs[8]);
        let wg = $(inputs[9]);
        let newAbw = $('#new-abw')[0].value;
        let sample = $('#sample')[0].value;
        if(sample > 0  && newAbw >= 0){
        abw.val((newAbw/sample).toFixed(2));
        wg.val((abw.val() - lastAbw.val()).toFixed(2));
        hiddenPopover(tag);  
        }else{
            alert('revise los campos');
        }
        
    });
    $('#btn-gr').on('click', '#close-pop', function() {
        hiddenPopover(tag);
    });
}

function hiddenPopover(tag){
    tag.popover('hide');
    tag.popover('enable');
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

//save resource used
function saveDataResourceUsed(){

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
            console.log(form);
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
            }else{
                alert("Debe agregar datos");
            }
    })
   
}

function saveDaylyParameters(){

    var table = $('#paramaters-table');
    var time = $('#timeDp').val();
    var valid = true;
    var timeout = null;
    
    table.find('tr').each(function(){
        var inputs = $(this).find('input');

        if(inputs.length > 0){

         for (let i = 0; i < inputs.length; i++) {
           if($(inputs[0]).prop('checked')) {

             var textVal = $(inputs[i]).val();
             inputName =  $(inputs[i]).attr("name");
             $('#'+inputName+'_s').val(textVal);

           }else{
                valid= false;
           }
               
        }
        
         if(valid){
            $('#dateDp_s').val($('#dateDp').val());
            $('#lab_s').val($('#lab').val());
             var form = $('#formDayly').serialize();
             console.log(form);
             $.post("{{route('storeDaylyParam')}}",form,function(resp){
                      
                 console.log(resp);               
               }).done(function(){
                                                                                                                                                               
                  console.log("success");                                                                                                                                                                                                                 
              }).fail(function(resp){                                                 
                        });
         }
        }
        });
}
   
</script>

@endsection
