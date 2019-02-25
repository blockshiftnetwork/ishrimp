@section('title')
Medicamentos y Minerales
@endsection

<div>
    <div class="card card-default">
        <div class="card-header">
            <h5>Medicamentos y Minerales</h5>
        </div>
        <div class="card-body p-0">
            <form method="post">
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
                        <table class="table" id="medicine-table">
                            <thead>
                                <th>Nombre piscina</th>
                                <th>Variedad</th>
                                <th>Recurso</th>
                                <th>Cantidad</th>
                                <th></th>
                                <th>Nota</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <td>
                                    <select class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="1">Piscina 1</option>
                                        <option value="2">Piscina 2</option>
                                        <option value="3">Piscina 3</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="medicamentos">Medicamentos</option>
                                        <option value="minerales">Minerales</option>
                                        <option value="probioticos">Probióticos</option>
                                        <option value="otros">Otros</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="cal">cal</option>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" type="text">
                                </td>
                                <td>
                                    Kg
                                </td>
                                <td>
                                    <textarea class="form-control" cols="30" rows="1" style="max-height: 38px; min-height: 38px;"></textarea>
                                </td>
                                <td>
                                    <span class="btn btn-light btn-duplicate" style="border-radius: 50px; border: 1px solid #ccc;"><b>+</b></span>
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="row m-0 p-2">
                        <div class="col-12">
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                    </div>
                    <div class="row m-0 p-2">
                        <p><strong>* NA: No Aplica * Kg: Kilo gramos * L: Litros * Rs: Rupias</strong></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('custom-scripts')
<script>
$(document).ready(function() {
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

        table_body.append(new_row);
    });

    $('#medicine-table').on('click', '.btn-delete', function() {
        $(this).parent().parent().remove();
    })
});
</script>
@endsection