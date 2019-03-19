<div>
    <div class="card card-default">
        <div class="card-header">
			<h5>ABW</h5>
		</div>
        <div class="card-body">
            <form>
                <table class="table table-responsive">
                    <thead>
                        <th><input type="checkbox"></th>
                        <th>Nombre Piscina</th>
                        <th>Última ABW</th>
                        <th>Última Fecha ABW</th>
                        <th>Peso (g)</th>
                        <th>Muestra</th>
                        <th>ABW (g)</th>
                        <th>WG (g)</th>
                        <th>Supervivencia (%)</th>
                    </thead>
                    <tbody>
                        <tr id="piscina10">
                            <td><input type="checkbox"></td>
                            <td>Piscina 10</td>
                            <td>14.22 Gramo</td>
                            <td>28-Jan 19 11:06 AM</td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control" readonly></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

@section('custom-scripts')
<script>
$(document).ready(function() {

});
</script>
@endsection