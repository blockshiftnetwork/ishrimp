<div class="card card-table card-default">
    <div class="card-header">
        <h5 style="margin:0;">ABW</h5>
    </div>
    <div class="card-body p-0">
    <table id="bar-table" class="table mb-0 bg-white">
					<thead class="thead-primary">
						<tr>
							<th colspan="12">
								<div class="form-inline justify-content-lg-around">
									<label class="mr-2">Fecha</label>
									<input class="form-control col-2 mr-4" type="text" id="dateABW" name="date">
									<label class="mr-2">Hora</label>
									<input class="form-control col-2 mr-4 " type="text" id="timeABW" name="time">
									<input type="button" onclick="saveDaylyAbw()" value="Guardar" class="btn btn-light ml-auto">
								</div>
							</th>
						</tr>
					</thead>
				</table>
<table
id="tbl_abw"
class="bg-white"
data-toggle="table"
data-classes="table table-striped table-hover table-borderless"
data-pagination="true"
data-locale="es-ES">
    <thead class="">
        <tr>
            <th class="col-xs-2" data-checkbox="true" data-field="id_pool">id piscina</th>
            <th class="col-xs-2" data-field="name_pool">Nombre piscina</th>
            <th class="col-xs-1 text-left" data-field="last_abw">Última ABW</th>
            <th class="col-xs-2" data-field="last_date">Última Fecha ABW</th>
            <th class="col-xs-1 text-left" >Muestras</th>
            <th class="col-xs-2 text-center" data-field="abw">ABW (g)</th>
            <th class="col-xs-2 text-center" data-field="wg">WG (g)</th>
            <th class="col-xs-2 text-center" data-field="survival">Supervivencia (%)</th>
        </tr>
    </thead>
    <tbody style="height: 228px !important;">
    @forelse($dailySamples as $sample)
    <tr id="1">
        <td class="col-xs-2">
            </td>
            <td class="col-xs-2">
                <span class="clsPondName">{{$sample->pool_name}}</span>
                <input class="form-control" type="hidden" id="newpoolid" value="{{$sample->pool_id}}" >
            </td>
            <td class="col-xs-1">
                <span style="width:45px;display:inline-block;">{{$sample->abw}}</span><span>Gramo</span>
                <input class="form-control" type="hidden" id="lastabw" value="{{$sample->abw}}" >

            </td>
            <td class="col-xs-2">
                <span>{{$sample->abw_date}} {{$sample->abw_hour}} </span>
            </td>
            <td class="col-xs-1 text-center">
                <button class="btn btn-light btn-duplicate btn-abw" role="button" onclick="showPopover(event)" style="border-radius: 50px; border: 1px solid #ccc;">+</button>
            </td>
            <td class="col-xs-1" style="width:100px;">
                <div class="input-group">
                    <input type="text" id="abw" name="abw" value="" class="form-control clsABW abw_1266" style="width:100px !important;">
                </div>
            </td>
            <td class="col-xs-1" style="width:100px;" >
                <div class="input-group">
                    <input type="text" id="wg" name="wg" value="" class="form-control clsWG wg_1266" style="width:100px !important;" readonly=""> </div>
            </td>
            <td class="col-xs-3">
                <div class="input-group">
                    <input type="text" id="survival_percent" name="survival_percent" style="width:113px;" value="100" class="form-control survival_1266"></div>
            </td>
        </tr>
        @empty
        @foreach($pools as $pool)
        <tr>
        <td class="col-xs-2">
            </td>
            <td class="col-xs-2">
                <span class="clsPondName">{{$pool->name}}</span>
                <input class="form-control" type="hidden" id="newpoolid" value="1" >
            </td>
            <td class="col-xs-1">
                <span style="width:45px;display:inline-block;">0</span><span>Gramo</span>
                <input class="form-control" type="hidden" id="lastabw" value="0" >

            </td>
            <td class="col-xs-2">
                <span>N/A</span>
            </td>
            <td class="col-xs-1 text-center">
                <button class="btn btn-light btn-duplicate btn-abw" role="button" onclick="showPopover(event)" style="border-radius: 50px; border: 1px solid #ccc;">+</button>
            </td>
            <td class="col-xs-1" style="width:100px;">
                <div class="input-group">
                    <input type="text" id="abw" name="abw" value="" class="form-control clsABW abw_1266" style="width:100px !important;">
                </div>
            </td>
            <td class="col-xs-2" style="width:100px;" >
                <div class="input-group">
                    <input type="text" id="wg" name="wg" value="" class="form-control clsWG wg_1266" style="width:100px !important;" readonly=""> </div>
            </td>
            <td class="col-xs-3">
                <div class="input-group">
                    <input type="text" id="survival_percent" name="survival_percent" style="width:113px;" value="100" class="form-control survival_1266"></div>
            </td>
        </tr>
        @endforeach
       @endforelse
          </tbody>
          
</table>
</div>
<form id="form_Abw" action="" method="post">
		{{ csrf_field() }}
        <input type="hidden" id="newpoolid_s" name="pool_id" required>
        <input type="hidden" id="abw_s" name="abw" required>
        <input type="hidden" id="wg_s" name="wg"required>
        <input type="hidden" id="weight" name="weight" value="0" >
        <input type="hidden" id="quantity" name="quantity" value="0" >
        <input type="hidden" id="survival_percent_s" name="survival_percent" required>
        <input type="hidden" id="dateABW_s" name="abw_date" required>
		<input type="hidden" id="timeABW_s" name="abw_hour"  required>
		</form>
</div>
