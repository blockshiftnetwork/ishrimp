
<div>
    <div class="card card-default">
        <div class="card-header">
            <h5>Insumos y Minerales</h5>
        </div>
        <div class="card-body p-0">
            
                <div class="container p-0 m-0">
                    <div class="row bg-primary text-light m-0" style="width: 100%">
                        <div class="col-12">
                            <div class="form-inline py-2">
                                <label class="mr-2">Fecha</label>
                                <input type="text" class="form-control" id="dateField" name="date">
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-2">
                            <form id="form-r" class="form-group" role="form" role="form" method="POST" action="{{route('cultivation.store')}}">
                                   
                        <table class="table" id="medicine-table">
                            <thead>   
                                <th>Nombre piscina</th>
                                <th>Recurso</th>
                                <th>Variedad</th>
                                <th>Cantidad</th>
                                <th></th>
                                <th>Nota</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr id="0">
                                  
                                <td>
                                    <select id="pool_id" name="pool_id" class="form-control" required="">
                                        <option value="">Seleccione</option>
                                        @foreach ($pools as $pool)
                                        <option value="{{$pool->id}}">{{$pool->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="resource_id" name="resource_id" class="form-control" required="" onchange="select(event)">
                                        <option value="">Seleccione</option>
                                        @foreach ($resources as $resource)
                                        <option value="{{$resource->id}}">{{$resource->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="presentation_id" name="presentation_id"  class="form-control" required="">
                                        <option value="">Seleccione</option>
                                        
                                    </select>
                                </td>
                                <td>
                                    <input id="quantity" name="quantity" class="form-control" type="text" required="">
                                </td>
                                <td>
                                
                                </td>
                                <td>
                                    <textarea id="note" name="note" class="form-control" cols="30" rows="1" style="max-height: 38px; min-height: 38px;"></textarea>
                                </td>
                                <td>
                                    <span class="btn btn-light btn-duplicate" style="border-radius: 50px; border: 1px solid #ccc;"><b>+</b></span>
                                </td>
                            
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row m-0 p-2">
                            <div class="col-12">
                                <input type="btn" value="Guardar" onclick="saveData()" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                    </div>
                  
                
                    <div class="row m-0 p-2">
                        <p><strong>* NA: No Aplica * Kg: Kilo gramos * L: Litros * Rs: Rupias</strong></p>
                    </div>
                </div>
         
        </div>
    </div>
</div>
<form id="data" style="display: none">
        {{ csrf_field() }}
        <input id="pool_id_s" name="pool_id" type="hide" required="">
        <input id="resource_id_s" name="resource_id" type="hide" required="">
        <input id="presentation_id_s" name="presentation_id" type="hide" required="">
        <input id="quantity_s" name="quantity" class="form-control" type="hide" required="">
        <input id="note_s" name="note" class="form-control" type="hide" required="">

</form>
@section('custom-scripts')
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

    
});
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
                alert("Recursos guardados con exito")
                location.reload();
               }, 2000)
             }).fail(function(resp){
                console.log('error',resp);
             })
             
        }
    })
   
}
</script>

@endsection