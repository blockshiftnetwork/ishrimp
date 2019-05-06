
<div>
	<div class="card card-default">
		<div class="card-header">
			<h5 style="margin:0;">Parámetros Diarios</h5>
		</div>
		<div class="card-body p-0">
			<form>
				<table id="bar-table" class="table mb-0 bg-white">
					<thead class="thead-primary">
						<tr>
							<th colspan="12">
								<div class="form-inline justify-content-lg-around">
									<label class="mr-2">Fecha</label>
									<input class="form-control col-2 mr-4 dateField" type="number" id="dateDp" name="date">
									<label class="mr-2">Hora</label>
									<input class="form-control col-2 mr-4 " type="number" id="timeDp" name="time">
									<label class="mr-2">Laboratorios</label>
								
									@if(count($laboratories) > 0)
									<select id="lab" name="lab" class="custom-select">
										<option value="" selected>Seleccione</option>
										@foreach($laboratories as $lab)
										<option value="{{$lab->id}}" >{{$lab->name}}</option>
										@endforeach
									</select>
									@else
										<a class="text-weight-bold text-danger btn btn-inline btn-light" href="/resource?tab=4">Debe registrar uno o más, aquí</a>
									@endif
									<input type="button" onclick="saveDaylyParameters()" value="Guardar" class="btn btn-light ml-auto dayly-parameters-submit">
								</div>
							</th>
						</tr>
					</thead>
				</table>
				<table id="paramaters-table" class="table table-bordered dayly-parameters-table table-responsive-lg text-center mb-0"
				style="font-size: 10px">
					<tbody>
						<tr>
							<td rowspan="3"><i class="fa fa-square-o"></i></td>
							<td rowspan="3">Nombre Piscina</td>
							<td colspan="10">Niveles Óptimos de Agua</td>
							<td colspan="2">Microbiologia</td>
						</tr>
						<tr>
							<td rowspan="2">pH<br>7.5-8.5</td>
							<td rowspan="2">Salinidad (PPT)<br>15-25</td>
							<td rowspan="2">DO (PPM)<br>&gt;3.0</td>
							<td rowspan="2">Temperatura</td>
							<td colspan="3">Alcalinidad (PPM) 300</td>
							<td rowspan="2">Dureza (PPM)<br>300</td>
							<td rowspan="2">Amoníaco NH4+ (PPM)<br>&lt;1.0</td>
							<td rowspan="2">Hierro (PPM)<br>&lt;0.1</td>
							<td colspan="2">VC (UFC / ML)</td>
						</tr>
						<tr>
							<td>CO3</td>
							<td>HCO3</td>
							<td>Total</td>
							<td>Colonias Verdes</td>
							<td>Colonias Amarillas</td>
						</tr>
						@foreach($pools as $pool)
						<tr class="input-row">
							<td><input type="checkbox" id="check" name="checke"></td>
							<td><span>{{$pool->name}}</span> <input type="hidden" name="id" value="{{$pool->id}}"> </td>
							<td><input type="number" name="ph" id="ph" class="form-control" value="0"></td>
							<td><input type="number" name="ppt" id="ppt" class="form-control" value="0"></td>
							<td><input type="number" name="ppm" id="ppm" class="form-control" value="0"></td>
							<td><input type="number" name="temperature" id="" class="form-control" value="0"></td>
							<td><input type="number" name="co3" id="co3" class="form-control" value="0"></td>
							<td><input type="number" name="hco3" id="hco3" class="form-control" value="0"></td>
							<td><input type="number" name="total" id="total" class="form-control" value="0" readonly></td>
							<td><input type="number" name="ppm_d" id="ppm_d" class="form-control" value="0"></td>
							<td><input type="number" name="ppm_a" id="ppm_a" class="form-control" value="0"></td>
							<td><input type="number" name="ppm_h" id="ppm_h" class="form-control" value="0"></td>
							<td><input type="number" name="green_colonies" id="green_colonies" class="form-control" value="0"></td>
							<td><input type="number" name="yellow_colonies" id="yellow_colonies" class="form-control" value="0"></td>		
						</tr>
						@endforeach
					</tbody>
				</table>
			</form>
		</div>
		<form id="formDayly" action="{{route('storeDaylyParam')}}" method="post">
		{{ csrf_field() }}
		<input type="hidden" id="id_s" name="pool_id" value="3" required>
		<input type="hidden" id="ph_s" name="ph" value="3" required>
		<input type="hidden" id="ppt_s" name="ppt" value="3" required>
		<input type="hidden" id="ppm_s" name="ppm" value="3" required>
		<input type="hidden" id="temperature_s" name="temperature" value="3" required>
		<input type="hidden" id="co3_s" name="co3" value="3" required>
		<input type="hidden" id="hco3_s" name="hco3" required>
		<input type="hidden" id="ppm_d_s" name="ppm_d" required>
		<input type="hidden" id="ppm_a_s" name="ppm_a" required>
		<input type="hidden" id="ppm_h_s" name="ppm_h" required>
		<input type="hidden" id="green_colonies_s" name="green_colonies" required>
		<input type="hidden" id="yellow_colonies_s" name="yellow_colonies"  required>
		<input type="hidden" id="dateDp_s" name="date"  required>
		<input type="hidden" id="hour_s" name="hour"  required>
		<input type="hidden" id="lab_s" name="laboratory_id"  required>
		</form>
	</div>
</div>
