var ctx = document.getElementById("myChart").getContext('2d');
var ctx2 = document.getElementById("myChart2").getContext('2d');
var ctx4 = document.getElementById("myChart4").getContext('2d');

var data = [1,4,20, 223, 155,65,100]
var pool_id;
var bioChart;
var balacedChart;
var paramChart;

$(function (){

$('#select_pool').on('change',function(){
  pool_id = $(this).val();
  let urlPool= '/pools/summary/'+pool_id;
  let urlBio = '/pools/bio/'+pool_id;
  let urlBalanced = '/pools/balancedused/'+pool_id;
  let urlParam = '/pools/parameters/'+pool_id;
  let urlUsed = '/pools/resourcesused/'+pool_id;
  clearCharts(bioChart);
  clearCharts(balacedChart);
  clearCharts(paramChart);
  loadPool(urlPool)
  loadDataBio(urlBio);
  loadDataBalanced(urlBalanced);
  loadDataParam(urlParam);
  getResourceUsed(urlUsed);
});

});

function loadPool(url){
    $.get(url, function(resp){
    let pool = resp.data[0];
    let doc = $('.pond_doc');
    let pls = $('.pond_pls');
    let size = $('.pond_wsa');
    doc.empty();
    pls.empty();
    size.empty();
    doc.append(pool.days+' Dias');
    pls.append(pool.planted_larvae+' ');
    size.append(pool.size+' Hectareas');
  });
}

function loadDataBio(url) {
  $.get(url, function(resp){
    console.log('response', resp);
    let labels =  loadlabelCreatAt(resp.data,'abw_date')
    let abw = createData(resp.data, 'abw');
    let agw = createData(resp.data,'awg');
    let rc = calRC(resp.data, 'balanced', 'abw', 'survival','planted_larvae');
    bioChart = createBioChart(abw,agw,rc,labels);
    loadDataToTableAbw('#table_statistic_abw',resp.data);
  });
}

function loadDataBalanced(url){
    $.get(url, function(resp){
    console.log('response', resp);
    let labels =  loadlabelCreatAt(resp.data, 'date')
    let r1 = createDataBalanced(resp.data, 'quantity',);
    balacedChart = createbalancedChart(r1, [], [], labels, resp.resources_name);
    loadDataToTableBalanced('#table_staticstic_balanced',resp.data);
  });
}


function loadDataParam(url){
    $.get(url, function(resp){
    console.log('response', resp);
    let labels =  loadlabelCreatAt(resp.data, 'date')
    let pH = createData(resp.data, 'ph');
    let dO = createData(resp.data, 'ppm');
    let temperature = createData(resp.data, 'temperature');
    paramChart = createParamChart(pH,dO,temperature,labels);
    loadDataToTableParameters('#statistic_table_param',resp.data);
  });
}

function createData(data, prop){
  let values = [];
  for (let i = 0; i < data.length; i++) {
    values.push(data[i][prop]);
  }
  return values;
}

function createDataBalanced(data, prop){
  let values = [];
  for (let i = 0; i < data.length; i++) {
      values.push(data[i][prop]);
  }
  return values;
}

function calRC(data, balanced, abw, survival, planted){
  let values = [];
  for (let i = 0; i < data.length; i++) {
    values.push((data[i][balanced]*2.2)/(((data[i][abw]/1000)*2.2)*(data[i][survival]/1)*(data[i][planted])));
  }
  return values;
}
function loadlabelCreatAt(data, prop){
  let labels = [];
  for (let i = 0; i < data.length; i++) {
    labels.push(getDate(data[i][prop]));
  }
  return labels;
}

window.operateEvents = {
  // action resources used
  'click .edit-used': function (e, value, row, index) {
    $('#editResourcesUsedPoolModal').modal('show');
    $('#id').val(row.used_id);
    $('#pool_id').val(row.pool_id);
    $('#resource_id').val(row.resource_id);
    $('#note').val(row.note);
    $('#quantity').val(row.quantity);
    $('#date').val(row.date);
    $('#presentation_id').empty();
    $.ajax({
        url: "presentation/" + row.resource_id,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var resp = response.data;
            for (var i = 0; i < resp.length; i++) {
                $('#presentation_id').append('<option value="' + resp[i].id + '">' + resp[i].name + '</option>');
            }
            $('#presentation_id').val(row.presentation_id);
        }
    });
    $('#resource_id').on('change', function(){
      $('#presentation_id').empty();
      $.ajax({
        url: "presentation/" + $(this).val(),
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var resp = response.data;
            for (var i = 0; i < resp.length; i++) {
                $('#presentation_id').append('<option value="' + resp[i].id + '">' + resp[i].name + '</option>');
            }
        }
    });
    });
  },
  'click .remove-used': function (e, value, row, index) {
    $('#deleteResourcesUsedPoolModal').modal('show');
    $('#id').val(row.used_id);
  },
//action balanced used
  'click .edit-balanced': function (e, value, row, index) {
    console.log(row);
    $('#editbalancedPoolModal').modal('show');
    $('#balanced_id').val(row.balanced_id);
    $('#balanced_pool_id').val(row.pool_id);
    $('#balanced_resource_id').val(row.resource_id);
    $('#balanced_note').val(row.note);
    $('#balanced_quantity').val(row.quantity);
    $('#balanced_date').val(row.date);
    $('#balanced_presentation_id').empty();
    $.ajax({
        url: "presentation/" + row.resource_id,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var resp = response.data;
            for (var i = 0; i < resp.length; i++) {
                $('#balanced_presentation_id').append('<option value="' + resp[i].id + '">' + resp[i].name + '</option>');
            }
            $('#balanced_presentation_id').val(row.presentation_id);
        }
    });
    $('#balanced_resource_id').on('change', function(){
      $('#balanced_presentation_id').empty();
      $.ajax({
        url: "presentation/" + $(this).val(),
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var resp = response.data;
            for (var i = 0; i < resp.length; i++) {
                $('#balanced_presentation_id').append('<option value="' + resp[i].id + '">' + resp[i].name + '</option>');
            }
        }
    });
    });
  },
  'click .remove-balanced': function (e, value, row, index) {
    $('#deletebalancedPoolModal').modal('show');
    $('#balanced_id').val(row.balanced_id);
  },
  'click .edit-abw': function (e, value, row, index) {
    $('#editResourcesUsedPoolModal').modal('show');
  },
  'click .remove-abw': function (e, value, row, index) {
    $('#deleteResourcesUsedPoolModal').modal('show');
  },
  'click .edit-paramet': function (e, value, row, index) {
    $('#editResourcesUsedPoolModal').modal('show');
  },
  'click .remove-parame': function (e, value, row, index) {
    $('#deleteResourcesUsedPoolModal').modal('show');
  }
}
function loadDataToTableBalanced(table, data){

  $(table).bootstrapTable('destroy').bootstrapTable({

    classes:"table table-striped table-hover table-borderless",
    theadClasses:"thead-primary",
    pagination:"true",
    locale:"es-ES",
    search:"true",
    data: data,
    columns: [
      [{
        field: 'days',
        title: 'Dias',
        sortable: true,
        align: 'center'
      },
      {
        field: 'date',
        title: 'Fecha del Evento',
        sortable: true,
        align: 'center',
      },
      {
        field: 'resource_name',
        title: 'Nombre del Balanceado',
        sortable: true,
        align: 'center',
      },
      {
        field: 'quantity',
        title: 'Total del Dia (Kg)',
        sortable: true,
        align: 'center',
      },
      {
        field: 'quantity',
        title: 'Consumo Neto (Kg)',
        sortable: true,
        align: 'center',
      },
      {
        field: 'operate',
        title: 'Acciones',
        align: 'center',
        events: window.operateEvents,
        formatter: operateFormatterBalanced
      }]
    ]
  });
}
function operateFormatterBalanced(value, row, index) {
  return [
    '<a   href="javascript:void(0)" class="edit-balanced btn btn-success btn-xs mr-4">'+
    '<i class="fa fa-edit"></i></a>'+
    '<a  href="javascript:void(0)" class="remove-balanced btn btn-xs btn-danger">'+
     '<i class="fa fa-trash-o"></i></a>'
  ].join('')
}

function getResourceUsed(url){
  $.get(url, function(resp){
    loadDataToTableResource('#table_statistic_resource',resp.data);
  });
}

function loadDataToTableResource(table, data){

    $(table).bootstrapTable('destroy').bootstrapTable({
  
      classes:"table table-striped table-hover table-borderless",
      theadClasses:"thead-primary",
      pagination:"true",
      locale:"es-ES",
      search:"true",
      data: data,
      columns: [
        [{
          field: 'resource_name',
          title: 'Nombre del Recurso',
          sortable: true,
          align: 'center'
        },
        {
          field: 'category',
          title: 'Tipo de Recurso',
          sortable: true,
          align: 'center',
        },
       
        {
          field: 'quantity',
          title: 'Total del Dia (Kg)',
          sortable: true,
          align: 'center',
        },
        {
          field: 'date',
          title: 'Fecha del Evento',
          sortable: true,
          align: 'center',
        },
        {
          field: 'operate',
          title: 'Acciones',
          align: 'center',
          events: window.operateEvents,
          formatter: operateFormatterResource
        }]
      ]
    });
}

function operateFormatterResource(value, row, index) {
  return [
    '<a   href="javascript:void(0)" class="edit-used btn btn-success btn-xs mr-4">'+
    '<i class="fa fa-edit"></i></a>'+
    '<a  href="javascript:void(0)" class="remove-used btn btn-xs btn-danger">'+
     '<i class="fa fa-trash-o"></i></a>'
  ].join('')
}

    function loadDataToTableAbw(table, data){

      $(table).bootstrapTable('destroy').bootstrapTable({
    
        classes:"table table-striped table-hover table-borderless",
        theadClasses:"thead-primary",
        pagination:"true",
        locale:"es-ES",
        search:"true",
        data: data,
        columns: [
          [{
            field: 'abw',
            title: 'ABW (g)',
            sortable: true,
            align: 'center'
          },
          {
            field: 'awg',
            title: 'AWG (g)',
            sortable: true,
            align: 'center',
          },
         
          {
            field: 'balanced',
            title: 'Tasa de Balanceado (Kg)',
            sortable: true,
            align: 'center',
          },
          {
            field: 'bio_masa',
            title: 'Bio-Masa',
            sortable: true,
            align: 'center',
            formatter: operateCalBio
          },
          {
            field: 'survival',
            title: 'Supervivencia (%)',
            sortable: true,
            align: 'center',
          },
          {
            field: 'abw_date',
            title: 'Fecha del Evento',
            sortable: true,
            align: 'center',
          },
          {
            field: 'operate',
            title: 'Acciones',
            align: 'center',
            events: window.operateEvents,
            formatter: operateFormatter
          }]
        ]
      });
   
  }

  function operateCalBio(value,row,index){
    return (row.abw != 0 && row.survival != 0 && row.planted_larvae != 0) ? (row.balanced/(row.abw/1000 * row.survival/100 * row.planted_larvae)).toFixed(2) : 0;
  }

  function loadDataToTableParameters(table, data){

    $(table).bootstrapTable('destroy').bootstrapTable({
  
      classes:"table table-striped table-hover table-borderless",
      theadClasses:"thead-primary",
      pagination:"true",
      locale:"es-ES",
      search:"true",
      data: data,
      columns: [
        [{
          field: 'ppt',
          title: 'Salinidad (PPT)',
          sortable: true,
          align: 'center'
        },
        {
          field: 'ppm',
          title: 'DO',
          sortable: true,
          align: 'center',
        },
        {
          field: 'co3',
          title: 'CO3',
          sortable: true,
          align: 'center',
        },
        {
          field: 'hco3',
          title: 'HCO3',
          sortable: true,
          align: 'center',
        },
        {
          field: 'total',
          title: 'Total',
          sortable: true,
          align: 'center',
          formatter:operationCalTotal
        },
        {
          field: 'ppm_d',
          title: 'Dureza (PPM-D)',
          sortable: true,
          align: 'center',
        },
        {
          field: 'ppm_a',
          title: 'Amoníaco (NH4 +)',
          sortable: true,
          align: 'center',
        },
        {
          field: 'ppm_h',
          title: 'Hierro',
          sortable: true,
          align: 'center',
        },
        {
          field: 'green_colonies',
          title: 'Colonias Verdes',
          sortable: true,
          align: 'center',
        },
        {
          field: 'yellow_colonies',
          title: 'Colonias Amarillas',
          sortable: true,
          align: 'center',
        },
        {
          field: 'date',
          title: 'Fecha de la Prueba',
          sortable: true,
          align: 'center',
        },
        {
          field: 'operate',
          title: 'Acciones',
          align: 'center',
          events: window.operateEvents,
          formatter: operateFormatter
        }]
      ]
    });
  }

  function operationCalTotal(value, row, index){
    return (row.co3 + row.hco3);
  }

function operateFormatter(value, row, index) {
  return [
    '<a  href="javascript:void(0)" class="edit-resources btn btn-success btn-xs mr-4">'+
    '<i class="fa fa-edit"></i></a>'+
    '<a  href="javascript:void(0)" class="remove btn btn-xs btn-danger">'+
     '<i class="fa fa-trash-o"></i></a>'
  ].join('')
}

function createBioChart(data1, data2, data3, labels){ 
   return new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          type: 'line',
          label: 'Biomasa',
          fill: true,
          data: data3,
          backgroundColor: '#168ede69',
          borderColor: '#168ede'
        },
        {

          label: 'crecimiento',
          fill: false,
          data:  data2,
          backgroundColor: '#FF0040',
          borderColor: '#FF0040',

        },
        {
          type: 'line',
          label: 'ABW',
          fill: true,
          data:  data1,
          backgroundColor: '#1eca4970',
          borderColor: '#1eca49'
        }
      ]
    },
    options: {
      tooltips: {
        enabled: true,
        titleFontSize: 24,
        bodyFontSize: 24
      },
      legend: {
        display: true,
        position: 'bottom',
        labels: {
          fontColor: 'black',
          boxWidth: 2
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            fontColor: 'black',
          }
        }],
        xAxes: [{
          distribution: 'linear',
          ticks: {
            fontColor: 'black',
            beginAtZero: true
          }
        }]
      }
    }
  });

}

function createbalancedChart(data1, data2, data3, labels, sublabel){ 
   return new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: sublabel[0].name,
          fill: false,
          data: data1,
          backgroundColor: '#168ede',
          borderColor: '#168ede'
        },
        {
          label: sublabel[1].name,
          fill: false,
          data:  data2,
          backgroundColor: '#FF0040',
          borderColor: '#FF0040'
        },
        {
          label: '',
          fill: false,
          data:  data3,
          backgroundColor: '#1eca49',
          borderColor: '#1eca49'
        }
      ]
    },
    options: {
      tooltips: {
        enabled: true,
        titleFontSize: 24,
        bodyFontSize: 24
      },
      legend: {
        display: true,
        position: 'bottom',
        labels: {
          fontColor: 'black',
          boxWidth: 2
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            fontColor: 'black',
          }
        }],
        xAxes: [{
          distribution: 'linear',
          ticks: {
            fontColor: 'black',
            beginAtZero: true
          }
        }]
      }
    }
  });

}

function createParamChart(data1, data2, data3, labels){
  return new Chart(ctx4, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {

          label: 'Temp',
          fill: true,
          data: data3,
          backgroundColor: '#168ede69',
          borderColor: '#168ede'
        },
        {

          label: 'Do',
          fill: false,
          data:  data2,
          backgroundColor: '#FF0040',
          borderColor: '#FF0040',

        },
        {

          label: 'pH',
          fill: true,
          data:  data1,
          backgroundColor: '#1eca4970',
          borderColor: '#1eca49'
        }
      ]
    },
    options: {
      tooltips: {
        enabled: true,
        titleFontSize: 24,
        bodyFontSize: 24
      },
      legend: {
        display: true,
        position: 'bottom',
        labels: {
          fontColor: 'black',
          boxWidth: 2
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            fontColor: 'black',
          }
        }],
        xAxes: [{
          distribution: 'linear',
          ticks: {
            fontColor: 'black',
            beginAtZero: true
          }
        }]
      }
    }
  });

}

  /*var ctx3 = document.getElementById("myChart3").getContext('2d');
  var myChart3 =new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: ['8:00','10:30','11:50','13:25','14:30','15:32','16:14','18:45', '20:24'],
      datasets: [
        {
          label: 'Biomasa',
          fill: false,
          data: data,
          backgroundColor: '#168ede',
          borderColor: '#168ede'
        },
        {
          label: 'crecimiento',
          fill: false,
          data:  [122,900,100,230,434,23,444,112,44,535],
          backgroundColor: '#FF0040',
          borderColor: '#FF0040'
        },
        {
          label: 'ABW',
          fill: false,
          data:  [23,43,32,12,32,423,21,23,535,124],
          backgroundColor: '#1eca49',
          borderColor: '#1eca49'
        }
      ]
    },
    options: {
      tooltips: {
        enabled: true,
        titleFontSize: 24,
        bodyFontSize: 24
      },
      legend: {
        display: true,
        position: 'bottom',
        labels: {
          fontColor: 'black',
          boxWidth: 2
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            fontColor: 'black',
          }
        }],
        xAxes: [{
          distribution: 'linear',
          ticks: {
            fontColor: 'black',
            beginAtZero: true
          }
        }]
      }
    }
  });*/

function clearCharts(chart){
  if(chart instanceof Chart){
  chart.destroy();
  }
  
  }

  function getDate(date){
  return $.format.date(date, 'dd MMM yyyy');
  }