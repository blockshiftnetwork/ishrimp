<div class="card card-table card-default">
    <div class="card-header">
        <h5>Insumos y Minerales</h5>
    </div>
    <div class="card-body">
<table
id="tbl_abw"
style="width:99.9%;"
data-toggle="table"
data-classes="table table-striped table-hover table-borderless"
data-pagination="true"
data-search="true"
data-unique-id="true">
    <thead>
        <tr>
            <th class="col-xs-2" data-checkbox="true" data-field="name_pool">Nombre piscina</th>
            <th class="col-xs-1 text-left" data-field="last_abw">Última ABW</th>
            <th class="col-xs-2" data-field="last_date">Última Fecha ABW</th>
            <th class="col-xs-1 text-left" >Muestras</th>
            <th class="col-xs-2" data-field="abw">ABW (g)</th>
            <th class="col-xs-1" data-field="wg">WG (g)</th>
            <th class="col-xs-2" data-field="survival">Supervivencia (%)</th>
        </tr>
    </thead>
    <tbody style="height: 228px !important;">
        <tr>
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
                <button class="btn btn-light btn-duplicate btn-abw" role="button"  style="border-radius: 50px; border: 1px solid #ccc;"><b>+</b></button>
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
<button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>
  Tooltip on top
</button>
