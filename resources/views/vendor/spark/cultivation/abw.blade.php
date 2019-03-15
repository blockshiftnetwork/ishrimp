<div class="card card-default">
    <div class="card-header">
        <h5>Insumos y Minerales</h5>
    </div>
    <div class="card-body p-0">
<table class="table scroll" id="tbl_abw" style="margin-top:10px;margin-bottom:0px;">
    <thead>
        <tr>
            <th class="col-xs-1" style="width: 36px;"><input type="checkbox" id="selecctall"></th>
            <th class="col-xs-2" style="line-height: 15px; vertical-align: middle; width: 62px;">Nombre piscina</th>
            <th class="col-xs-1 text-left" style="padding-left: 2%; width: 73.1771px;">Última ABW</th>
            <th class="col-xs-2" style="padding-left: 2%; width: 58.2292px;">Última Fecha ABW</th>
            <th class="col-xs-1 text-left" style="width: 63px;">Muestras</th>
            <th class="col-xs-2" style="padding-left: 2%; width: 122.229px;">ABW (g)</th>
            <th class="col-xs-1" style="padding-left: 2%; width: 122.229px;">WG (g)</th>
            <th class="col-xs-2" style="padding-left: 0%; width: 122px;">Supervivencia (%)</th>
        </tr>
    </thead>
    <tbody style="height: 228px !important;">
        <tr id="p_1266">
            <td class="col-xs-1">
                <input type="checkbox" style="cursor:pointer;margin-top: 8px;" id="chk1266" class="group_abw"
                    checked="">
            </td>
            <td class="col-xs-2">
                <span class="clsPondName">Piscina 10</span>
            </td>
            <td class="col-xs-1">
                <span style="width:45px;display:inline-block;" id="lastABW">14.22</span><span>Gramo</span>
                <input type="text" class="clsAbwDate" name="abwdate" id="abwdate" value="2019-03-14"
                    style="width:120px;display:none;">
                <input type="text" name="abwtime" id="abwtime" value="01:30 PM" class="clsAbwTime"
                    style="display:none;">
            </td>
            <td class="col-xs-2">
                <span id="lastabwDate">28-Jan 19 11:06 AM</span>
            </td>
            <td class="col-xs-1 text-center">
                <span class="btn btn-light btn-duplicate" style="border-radius: 50px; border: 1px solid #ccc;"><b>+</b></span>
            </td>
            <td class="col-xs-1" style="width:100px;">
                <input type="hidden" name="harvestDate" id="harvestDate" value="0000-00-00 00:00:00">
                <input type="hidden" name="sampleWt" id="sampleWt" value="23">
                <input type="hidden" name="total_weight" id="total_weight" value="23">
                <input type="hidden" name="total_shrimps" id="total_shrimps" value="100">
                <input type="hidden" name="last_abw_1266" id="last_abw_1266" value="14.22">
                <div class="input-group">
                    <input type="text" id="abw" name="abw" value="" class="form-control clsABW abw_1266" style="width:100px !important;">
                </div>
            </td>
            <td class="col-xs-1">
                <div class="input-group">
                    <input type="text" id="wg" name="wg" value="" class="form-control clsWG wg_1266" readonly=""> </div>
            </td>
            <td class="col-xs-3">
                <div class="input-group">
                    <input type="text" id="survival_rate" name="survival_rate" style="width:113px;" value="100" class="form-control survival_1266"></div>
            </td>
        </tr>
          </tbody>
</table>
</div>
</div>
@section('custom-scripts')
    <script>
    $(function() {

    })
    </script>
@endsection
