@extends('spark::layouts.app')

@section('content')
<div id="alert-cultivate" class="alert  alert-dismissible fade in">
</div>
<div>
    <div class="spark-screen " style="min-height: fit-content; height: 100%; width: 100%;">
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
                    <a class="nav-link" href="#abw" aria-controls="abw" role="tab" data-toggle="tab">
                        <i class="fa fa-bar-chart icon"></i>
                        {{__('Peso Promedio')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#projections" aria-controls="projections" role="tab" data-toggle="tab">
                        <i class="fa fa-bar-chart icon"></i>
                        {{__('Proyecciones Semanales')}}
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
                    <div role="tabcard" class="tab-pane" id="projections">
                        @include('spark::cultivation.projections')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('cultivation-scripts')
<script>
 var validph = false; validppt = false; validppm = false; validtemperature = false; validppm_a = false; validppm_h = false; validppm_d = false;
$(function () {
        var j = 0;
        var t = new Date();

        $('#dateRs').flatpickr({
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d',
            maxDate: "today",
            defaultDate: ["today"]
        });
        $('#dateDp').flatpickr({
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d',
            maxDate: "today",
            defaultDate: ["today"]
        });
        $('#timeDp').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            defaultDate: t.getHours()+':'+t.getMinutes()
        });
        $('#dateABW').flatpickr({
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d',
            maxDate: "today",
            defaultDate: ["today"]
        });
        $('#timeABW').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            defaultDate: t.getHours()+':'+t.getMinutes()
        });

        $('#medicine-table').on('click', '.btn-duplicate', function () {
            let current_row = $(this).parent().parent(),
                new_row = current_row.clone(),
                table_body = current_row.parent();

            $(this).off('click');
            $(this).removeClass('btn-duplicate');
            $(this).addClass('btn-delete');
            $(this).html('<b>-</b>');

            table_body.append(new_row.attr('id', ++j));
        });

        $('#medicine-table').on('click', '.btn-delete', function () {
            $(this).parent().parent().remove();
        });

        $('#projection-table').on('click', '.btn-duplicate', function () {
            let current_row = $(this).parent().parent(),
                new_row = current_row.clone(),
                table_body = current_row.parent();

            $(this).off('click');
            $(this).removeClass('btn-duplicate');
            $(this).addClass('btn-delete');
            $(this).html('<b>-</b>');

            table_body.append(new_row.attr('id', ++j));
        });

        $('#projection-table').on('click', '.btn-delete', function () {
            $(this).parent().parent().remove();
        });

        $('.btn-abw').popover({ title: "Muestras", html: true, placement: "left" });

        $('input').on('keyup', function () {
            if ($(this).prop('name') === 'hco3' || $(this).prop('name') === 'co3') {
                var alcals = $(this).parent().parent().find('input');
                var co3 = parseInt($(alcals[6]).val(), 10);
                var hco3 = parseInt($(alcals[7]).val(), 10);
                var total = $(alcals[8]);
                co3 = co3 > 0 ? co3 : 0;
                hco3 = hco3 > 0 ? hco3 : 0;
                total.val(co3 + hco3);
                if ($(this).val() > 300 || !verEmpty(this)) {
                    $(this).removeClass('border border-success');
                    $(this).addClass('border border-danger');
                   
                } else {
                    $(this).removeClass('border border-danger');
                    $(this).addClass('border border-success');
                    
                }
            }
            if ($(this).prop('name') === 'ph') {
                if ($(this).val() < 7.5 || $(this).val() > 8.5) {
                    $(this).removeClass('border border-success');
                    $(this).addClass('border border-danger');
                     validph = false;
                } else {
                    $(this).removeClass('border border-danger');
                    $(this).addClass('border border-success');
                    validph = true;
                }
            }

            if ($(this).prop('name') === 'ppt') {
                if ($(this).val() < 15 || $(this).val() > 25 || $(this).val() === 0) {
                    $(this).removeClass('border border-success');
                    $(this).addClass('border border-danger');
                    validppt = false;
                } else {
                    $(this).removeClass('border border-danger');
                    $(this).addClass('border border-success');
                    validppt = true
                }
            }
            if ($(this).prop('name') === 'ppm') {
                if ($(this).val() < 3.0) {
                    $(this).removeClass('border border-success');
                    $(this).addClass('border border-danger');
                    validppm = false;
                } else {
                    $(this).removeClass('border border-danger');
                    $(this).addClass('border border-success');
                    validppm = true;
                }
            }
            if ($(this).prop('name') === 'temperature' || $(this).prop('name') === 'ppm_d' || $(this).prop('name') === 'green_colonies' || $(this).prop('name') === 'yellow_colonies') {
                if (!verEmpty(this)) {
                    $(this).removeClass('border border-success');
                    $(this).addClass('border border-danger');
                    validtemperature = false
                } else {
                    $(this).removeClass('border border-danger');
                    $(this).addClass('border border-success');
                    validtemperature = true
                }
            }

            if ($(this).prop('name') === 'ppm_a') {
                if ($(this).val() > 1.0 || $(this).val() < 0.001) {
                    $(this).removeClass('border border-success');
                    $(this).addClass('border border-danger');
                    validppm_a = false;
                } else {
                    $(this).removeClass('border border-danger');
                    $(this).addClass('border border-success');
                    validppm_a = true;
                }
            }
            if ($(this).prop('name') === 'ppm_h') {
                if ($(this).val() > 0.1 || $(this).val() < 0.001) {
                    $(this).removeClass('border border-success');
                    $(this).addClass('border border-danger');
                    validppm_h = false;
                } else {
                    $(this).removeClass('border border-danger');
                    $(this).addClass('border border-success');
                    validppm_h = true;
                }
            }

           
        });


    $('#pool').on('change', function(){
       let pool_id = $(this).val();
       let parameter_id = $('#parameter_id').val();
       let urlproj = '/cultivation/projections/'+pool_id+'/'+parameter_id;
        if(pool_id.length > 0 && parameter_id.length > 0){
            loadProyection(urlproj);
        }
        
        
    });

     $('#parameter_id').on('change', function(){
       let parameter_id  = $(this).val();
       let pool_id = $('#pool').val();
       let urlproj = '/cultivation/projections/'+pool_id+'/'+parameter_id;
       if(pool_id.length > 0 && parameter_id.length > 0){
            loadProyection(urlproj);
        }
    });
 
});



    function showPopover(event) {
        var tr = $(event.target).parent().parent();
        tag = $(event.target);
        tag.popover('show', { title: "Muestras", html: true, placement: "left" });
        $('.popover-body').empty();
        $('.popover-body').append('<div id="cal-pop" class="row cal-content"></div>');
        $('.cal-content').append('<div class="col-6 mx-auto"><input id="new-abw" class="form-control" placeholder="ABW" type="number"></div>');
        $('.cal-content').append('<div class="col-6 mx-auto"><input id="sample" class="form-control" placeholder="muestra" type="number"></div>');
        $('.popover-body').append('<div id="btn-gr" class="row mt-2 btn-group-xs"><button id="cal-abw" class="btn btn-success mx-auto">calcular</button><button id="close-pop" class="btn btn-danger mx-auto">cancelar</button></div>');

        $('#btn-gr').on('click', '#cal-abw', function () {
            let inputs = tr.find('input');
            console.log(inputs);
            let lastAbw = $(inputs[2]);
            let abw = $(inputs[3]);
            let wg = $(inputs[4]);
            let newAbw = $('#new-abw')[0].value;
            let sample = $('#sample')[0].value;
            if (sample > 0 && newAbw >= 0) {
                abw.val((newAbw / sample).toFixed(2));
                wg.val((abw.val() - lastAbw.val()).toFixed(2));
                hiddenPopover(tag);
            } else {
                alert('revise los campos');
            }
        });
        $('#btn-gr').on('click', '#close-pop', function () {
            hiddenPopover(tag);
        });
    }

    function hiddenPopover(tag) {
        tag.popover('hide');
        tag.popover('enable');
    }

    function select(event) {
        var id = event.target.value;
        var presentation = $(event.target).parent().next().children();
        $(presentation[0]).empty();
        $(presentation[0]).append('<option value="" selected>Seleccione</option>');
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

    function selectPresentation(event){
        
        var id = event.target.value;
        var unity = $(event.target).parent().next().children().children();
        unity.empty();
        $.ajax({
            url: '/getpresentation/'+id,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                var resp = response.presentation;
                unity.append(resp[0].unity)
            }
        });

    }

    //save resource used
    function saveDataResourceUsed() {
    
        var timeout = null;
        var table = $('#medicine-table');
        var date = $('#dateRs').val();
        var trs = table.find('tr');
        $('#date_s').val(date);
        for (let j = 1; j < trs.length; j++) {
            var dataValid = false;
            //Find inputs
            var inputs = $(trs[j]).find('.form-control');
            for (let i = 0; i < inputs.length; i++) {
                var textVal = $(inputs[i]).val();
                if (textVal.length !== 0 ) {
                    dataValid = true;
                } else {
                  dataValid = $(inputs[i]).attr("name") === 'note';
                }
                inputName = $(inputs[i]).attr("name");
                $('#' + inputName + '_s').val(textVal);
            }

            //if exits inputs inside tr
            if (dataValid) {
                var form = $('#data').serialize();
                $('#btn_res_used').attr("disabled", true);
                $.post("{{route('cultivation.store')}}", form, function (resp) {
                }).done(function (resp) {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        showAlert('#alert-cultivate', 'Éxito', resp.data, 'alert-success', 2000, true)
                    }, 2000)
                    $('#btn_res_used').attr("disabled", false);
                }).fail(function (resp) {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        showAlert('#alert-cultivate', 'Error', 'Verifique los datos', 'alert-danger', 3000, false)
                    }, 2000)
                    $('#btn_res_used').attr("disabled", false);
                });
            } else {
                alert("Debe agregar datos");
            }
        }



    }

    function checkQuantity(event){
                let timeout = null;
                let tr = $(event.target).parent().parent();
                console.log(tr);
                let input = event.target;
                let value = $(event.target).val();
                let inputs = tr.find('.form-control');
                let resource_id = $(inputs[1]).val();
                let presentation_id = $(inputs[2]).val();
              
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    $.get('existence/' + resource_id + '/' + presentation_id, function(data){
                        var existence = data.data[0];
                        if(!(typeof existence === 'undefined')){
                            var total = existence.quantity*existence.presentation_quantity-existence.used_quatity;
                        }else{
                            var total = 0.0;
                        }
                        
                        var message = '';
                        if(typeof existence != 'undefined' && total < parseInt(value) ){
                            message = 'Excedió la cantidad disponible';
                            $(input).removeClass('border border-success');
                            $(input).addClass('border border-danger');
                            showAlert('#alert-cultivate', 'Advertencia', message, 'alert-warning', 5000, false)
                        }
                        if(typeof existence === 'undefined'){
                            message = 'No hay recursos en el inventario <a class="btn btn-warning" href="/resource?inventory=1">Agregar</a>';
                            $(input).removeClass('border border-success');
                            $(input).addClass('border border-danger');
                            showAlert('#alert-cultivate', 'Advertencia', message, 'alert-warning', 10000, false)
                        } else {
                            $(input).removeClass('border border-danger');
                            $(input).addClass('border border-success');
                            }
                    });                      
                }, 1500); 
    }

  //save Dayly Parameters
    function saveDaylyParameters(e) {
        var table = $('#paramaters-table');
        var dataValid = false;
        var timeout = null;
        var trs =  table.find('tr')
        if( $('#lab').val() > 0){
            for (let j = 0; j < trs.length; j++) {

                var inputs = $(trs[j]).find('input');

                if (inputs.length > 0 ) {
                    for (let i = 0; i < inputs.length; i++) {
                   
                        var textVal = $(inputs[i]).val();
                        inputName = $(inputs[i]).attr("name");
                        $('#' + inputName + '_s').val(textVal);

                    }
                if ($(inputs[0]).prop('checked')) {
                    dataValid = true;
                    if(validph && validppt && validppm && validppm_h && validppm_a){
                    $('#dateDp_s').val($('#dateDp').val() +' '+ $('#timeDp').val());
                    $('#hour_s').val($('#timeDp').val());
                    $('#lab_s').val($('#lab').val());
                    var form = $('#formDayly').serialize();
                    $.post("{{route('storeDaylyParam')}}", form, function (resp) {

                    }).done(function (resp) {
                        clearTimeout(timeout);
                        timeout = setTimeout(function () {
                        showAlert('#alert-cultivate', 'Éxito', resp.data, 'alert-success', 3000, false)
                         }, 2000)
                     }).fail(function (resp) {
                        clearTimeout(timeout);
                        timeout = setTimeout(function () {
                        showAlert('#alert-cultivate', 'Error', 'Verifique los datos', 'alert-danger', 3000, false)
                    }, 2000)
                });
             }else{
                showAlert('#alert-cultivate', 'Error', 'Verifique los campos', 'alert-danger', 3000, false)
                }
            }
        }
    }

    }else{
        showAlert('#alert-cultivate', 'Error', 'Seleccione un laboratorio', 'alert-danger', 3000, false)

    }
}
      //save ABW
    function saveDaylyAbw() {
        var timeout = null;
        var table = $('#tbl_abw');
        var date = $('#dateABW').val();
        var time = $('#timeABW').val();
        var trs = table.find('tr');
        var dataValid = false;
        $('#dateABW_s').val(date + ' ' +time);
        $('#timeABW_s').val(time);
        for (let j = 1; j < trs.length; j++) {
            //Find inputs
            var inputs = $(trs[j]).find('input');
            for (let i = 0; i < inputs.length; i++) {
                var textVal = $(inputs[i]).val();
                inputName = $(inputs[i]).attr("id");
                console.log(inputName, textVal);
                $('#' + inputName + '_s').val(textVal);
                console.log('#' + inputName + '_s', $('#' + inputName + '_s').val());
            }

            if ($(inputs[0]).prop('checked')) {
                dataValid = true;
                var form = $('#form_Abw').serialize();
        
                $.post("{{route('storeDaylyABW')}}", form, function (resp) {

                }).done(function (resp) {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        showAlert('#alert-cultivate', 'Èxito', resp.data, 'alert-success', 2000, true)
                    }, 2000)
                }).fail(function (resp) {
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        showAlert('#alert-cultivate', 'Error', 'Verifique los datos', 'alert-danger', 3000, false)
                    }, 2000)
                });
            }
        }
        if (!dataValid) {
            showAlert('#alert-cultivate', 'Error', 'Seleccione una o más filas', 'alert-danger', 3000, false)

        }
    }

function saveDataProjections() {    
    var timeout = null;
    var table = $('#projection-table');
    var pool = $('#pool').val();
    console.log('pool',pool);
    var parameter = $('#parameter_id').val();
    var trs = table.find('tr');
    var dataValid = true;

    $('#pool_s').val(pool);
    $('#parameter_id_s').val(parameter);
    for (let j = 1; j < trs.length; j++) {
        //Find inputs
        var inputs = $(trs[j]).find('.form-control');
        for (let i = 0; i < inputs.length; i++) {
            var inputVal = $(inputs[i]).val();
            inputName = $(inputs[i]).attr("id");
            
            $('#' + inputName + '_s').val(inputVal);
            console.log(inputName, inputVal, '#' + inputName + '_s', $('#' + inputName + '_s').val());
        }

        //if exits inputs inside tr
        if (dataValid) {
            
            var form = $('#projection-data').serialize();
            console.log(form);
            $('#btn-projection').attr("disabled", true);
            $.post("{{route('storeProjections')}}", form, function (resp) {

            }).done(function (resp) {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    showAlert('#alert-cultivate', 'Éxito', resp.data, 'alert-success', 2000, true)
                }, 2000)
                $('#btn-projection').attr("disabled", false);
            }).fail(function (resp) {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    showAlert('#alert-cultivate', 'Error', 'Verifique los datos', 'alert-danger', 3000, false)
                }, 2000)
                $('#btn_res_used').attr("disabled", false);
            });
        } else {
            alert("Debe agregar datos");
        }
    }
}
//show alerts
    function showAlert(target, title, message, type, duration, reload) {
        $(target).empty();
        $(target).removeClass('show');
        $(target).removeAttr('class');
        $(target).addClass('alert  alert-dismissible fade in');
        $(target).addClass(type);
        $(target).addClass('show');
        $(target).append('<strong>' + title + ':' + '</strong> ' + message);
        setTimeout(function () {
            $(target).removeClass('show');
            $(target).removeClass(type);
            $(target).empty();
            if (reload) {
                location.reload();
            }
        }, duration)

    }

    function verEmpty(element) {
        let input = $(element).val();
        return input.length > 0;
    }


    function loadProyection(url){
        table = $('#projection-table > tbody');
         $.get(url, function(resp){
            console.log(resp);
            table.find('.val-theoretical').each(function(index){
                $(this).val((typeof resp.theoretical[index] != 'undefined') ? resp.theoretical[index].theoretical: 0)
            })
            table.find('.projection-id').each(function(index){
                $(this).val((typeof resp.theoretical[index] != 'undefined') ? resp.theoretical[index].id: 0)
            })
         });
    }


</script>

@endsection