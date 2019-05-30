var ctx = document.getElementById("myChart").getContext('2d');
var ctx2 = document.getElementById("myChart2").getContext('2d');
var ctx4 = document.getElementById("myChart4").getContext('2d');
var ctx5 = document.getElementById("myChart5").getContext('2d');
var ctx6 = document.getElementById("myChart6").getContext('2d');
var ctx7 = document.getElementById("myChart7").getContext('2d');

var data = [1,4,20, 223, 155,65,100]
var pool_id;
var bioChart;
var balacedChart;
var paramChart;
var projectUsedChart;
var projectSurvivalChart;
var projectAbwChart;

$(function (){
pool_id = $('#select_pool').val();
if( typeof pool_id != 'undefined') {
  iniSummarypool(pool_id);
$('#select_pool').on('change',function(){
  pool_id = $(this).val();
  iniSummarypool(pool_id);
});
} 
});
function iniSummarypool(pool_id){
  let urlPool= '/pools/summary/'+pool_id;
  let urlBio = '/pools/bio/'+pool_id;
  let urlBalanced = '/pools/balancedused/'+pool_id;
  let urlParam = '/pools/parameters/'+pool_id;
  let urlUsed = '/pools/resourcesused/'+pool_id;
  let urlProAbw = '/cultivation/projections/'+pool_id+'/1';
  let urlProUsed = '/cultivation/projections/'+pool_id+'/2';
  let urlProSurv = '/cultivation/projections/'+pool_id+'/3';

  //clear charts views
  clearCharts(bioChart);
  clearCharts(balacedChart);
  clearCharts(paramChart);
  clearCharts(projectUsedChart);
  clearCharts(projectSurvivalChart);
  clearCharts(projectAbwChart);
  //summary pools load
  loadPool(urlPool)
  loadDataBio(urlBio);
  loadDataBalanced(urlBalanced);
  loadDataParam(urlParam);
  //projections load
  loadUsedDataProject(urlProUsed);
  loadABWDataProject(urlProAbw);
  loadSurvDataProject(urlProSurv);
  //load info resource used
  getResourceUsed(urlUsed);
  
}

//definitions of function to load data
function loadPool(url){
  try { 
  $.get(url, function(resp){
    console.log(resp);
    let pool = resp.data[0];
    let used = resp.used;
    let doc = $('.pond_doc');
    let pls = $('.pond_pls');
    let size = $('.pond_wsa');
    let summaryUsed = $('#table-summary-used > tbody');
    let totalBalanced = $('#totalBalanced');
    let maxBalanced = $('#maxBalanced');
    doc.empty();
    pls.empty();
    size.empty();
    summaryUsed.empty()
    totalBalanced.empty();
    maxBalanced.empty();

      doc.append(pool.days+' Dias');
      pls.append(pool.planted_larvae+' ');
      size.append(pool.size+' Hectareas');
      totalBalanced.append('<b>'+ pool.balanced +' Kgs</b>');
      maxBalanced.append('<b>'+ pool.maxbalanced +' Kgs</b>');
      for (let index = 0; index < used.length; index++) {
        const element = used[index];
        summaryUsed.append('<tr><td>'+element.presentation_name+
        '</td><td>'+element.quantity_used+
        '</td><td>'+(element.quantity_used*2.204).toFixed(2)+
        '</td><td>'+((element.price/element.presentation_quantity)*element.quantity_used).toFixed(2)+
        '</td></tr>')
        
      }
  });
} catch (error) {
    console.log(error)
  }
}

function loadDataBio(url) {
  $.get(url, function(resp){
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
    let labels =  loadlabelCreatAt(resp.data, 'date')
    let r1 = createDataBalanced(resp.data, 'quantity',);
    balacedChart = createbalancedChart(r1, [], [], labels, resp.resources_name);
    loadDataToTableBalanced('#table_staticstic_balanced',resp.data);
  });
}


function loadDataParam(url){
    $.get(url, function(resp){
    let labels =  loadlabelCreatAt(resp.data, 'date')
    let pH = createData(resp.data, 'ph');
    let dO = createData(resp.data, 'ppm');
    let temperature = createData(resp.data, 'temperature');
    paramChart = createParamChart(pH,dO,temperature,labels);
    loadDataToTableParameters('#statistic_table_param',resp.data);
  });
}

function loadUsedDataProject(url){
  $.get(url, function(resp){
  let labels =  loadlabelWeek(resp.theoretical, 'week')
  let theoretical = createData(resp.theoretical, 'theoretical');
  let real = createData(resp.real, 'real_used');
  console.log('real',real);
  projectUsedChart = createUsedProjecChart(theoretical,real,labels);
});
}

function loadABWDataProject(url){
  $.get(url, function(resp){
  let labels =  loadlabelWeek(resp.theoretical, 'week')
  let theoretical = createData(resp.theoretical, 'theoretical');
  let real = createData(resp.real, 'real_abw');
  console.log('real',real);
  projectAbwChart = createABWProjecChart(theoretical,real,labels);
});
}

function loadSurvDataProject(url){
  $.get(url, function(resp){
  let labels =  loadlabelWeek(resp.theoretical, 'week')
  let theoretical = createData(resp.theoretical, 'theoretical');
  let real = createData(resp.real, 'real_surv');
  console.log('real',real);
  projectSurvivalChart = createSurvivalProjecChart(theoretical,real,labels);
});
}

//proceser data functions
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
    let rc =(data[i][balanced]*2.2)/(((data[i][abw]/1000)*2.2)*(data[i][survival]/1)*(data[i][planted])); 
    values.push(rc);
  }
  return values;
}

//proceser label from data
function loadlabelCreatAt(data, prop){
  let labels = [];
  for (let i = 0; i < data.length; i++) {
    labels.push(getDate(data[i][prop]));
  }
  return labels;
}

function loadlabelWeek(data, prop){
  let labels = [];
  for (let i = 0; i < data.length; i++) {
    labels.push('Semana '+data[i][prop]);
  }
  return labels;
}

//modals actions

window.operateEvents = {
  // action resources used
  'click .edit-used': function (e, value, row, index) {
    $('#editResourcesUsedPoolModal').modal('show');
    $('#id').val(row.used_id);
    $('#pool_id').val(row.pool_id);
    $('#resource_id').val(row.resource_id);
    $('#note').val(row.note);
    $('#quantity').val(row.quantity);
    $('#used_date').val(row.date);
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
    $('#editAbwPoolModal').modal('show');
    $('#abw_id').val(row.sample_id);
    $('#abw_pool_id').val(row.pool_id);
    $('#pool_abw').val(row.abw);
    $('#pool_awg').val(row.awg);
    $('#pool_survival').val(row.survival);
    $('#abw_date').val(row.abw_date);
    $('#abw_hour').val(row.abw_hour);
  },
  'click .remove-abw': function (e, value, row, index) {
    $('#deleteAbwPoolModal').modal('show');
    $('#abwe_id').val(row.sample_id);
  },
  'click .edit-parameter': function (e, value, row, index) {
    $('#editlabPoolModal').modal('show');
    $('#param_id').val(row.id);
    $('#param_pool_id').val(row.pool_id);
    $('#laboratory_id').val(row.laboratory_id);
    $('#ph').val(row.ph);
    $('#ppt').val(row.ppt);
    $('#temperature').val(row.temperature);
    $('#co3').val(row.co3);
    $('#hco3').val(row.hco3);
    $('#ppm').val(row.ppm);
    $('#ppm_a').val(row.ppm_a);
    $('#ppm_h').val(row.ppm_h);
    $('#ppm_d').val(row.ppm_d);
    $('#green_colonies').val(row.green_colonies);
    $('#yellow_colonies').val(row.yellow_colonies);
    $('#param_date').val(row.date);
    $('#param_hour').val(row.hour);
  },
  'click .remove-parameter': function (e, value, row, index) {
    $('#deletelabPoolModal').modal('show');
    $('#parame_id').val(row.id);

  }
}

//functions load data table
function loadDataToTableBalanced(table, data){

  $(table).bootstrapTable('destroy').bootstrapTable({

    classes:"table table-striped table-hover table-borderless",
    theadClasses:"thead-primary",
    pagination:"true",
    locale:"es-ES",
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
        title: 'Fecha de Registro',
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
        title: 'Total Aplicado (Kg)',
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
  '<div class="btn btn-group action" >'+
    '<a   href="javascript:void(0)" class="edit-balanced btn btn-success btn-xs mr-4">'+
    '<i class="fa fa-edit"></i></a>'+
    '<a  href="javascript:void(0)" class="remove-balanced btn btn-xs btn-danger">'+
     '<i class="fa fa-trash-o"></i></a>' + '</div>'
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
    '<div class="btn btn-group action" >'+
    '<a   href="javascript:void(0)" class="edit-used btn btn-success btn-xs mr-4">'+
    '<i class="fa fa-edit"></i></a>'+
    '<a  href="javascript:void(0)" class="remove-used btn btn-xs btn-danger">'+
     '<i class="fa fa-trash-o"></i></a>' + '</div>'
  ].join('')
}

    function loadDataToTableAbw(table, data){

      $(table).bootstrapTable('destroy').bootstrapTable({
    
        classes:"table table-striped table-hover table-borderless",
        theadClasses:"thead-primary",
        pagination:"true",
        locale:"es-ES",
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
            formatter: operateFormatterAbw
          }]
        ]
      });
   
  }
  function operateFormatterAbw(value, row, index) {
    return [
    '<div class="btn btn-group action" >'+
      '<a   href="javascript:void(0)" class="edit-abw btn btn-success btn-xs mr-4">'+
      '<i class="fa fa-edit"></i></a>'+
      '<a  href="javascript:void(0)" class="remove-abw btn btn-xs btn-danger">'+
       '<i class="fa fa-trash-o"></i></a>'+ '</div>'
    ].join('')
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
          formatter: operateFormatterParameter
        }]
      ]
    });
  }

  function operationCalTotal(value, row, index){
    return (row.co3 + row.hco3);
  }

  function operateFormatterParameter(value, row, index) {
    return [
    '<div class="btn btn-group action" >'+
      '<a   href="javascript:void(0)" class="edit-parameter btn btn-success btn-xs mr-4">'+
      '<i class="fa fa-edit"></i></a>'+
      '<a  href="javascript:void(0)" class="remove-parameter btn btn-xs btn-danger">'+
       '<i class="fa fa-trash-o"></i></a>'+ '</div>'
    ].join('')
  }


 //create charts
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

// Proyections Charts
function createUsedProjecChart(data1, data2, labels){
  return new Chart(ctx5, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {

          label: 'Balanceado Real',
          fill: true,
          data: data2,
          backgroundColor: '#168ede69',
          borderColor: '#168ede'
        },
        {

          label: 'Balanceado Proyec.',
          fill: false,
          data:  data1,
          backgroundColor: '#FF0040',
          borderColor: '#FF0040',

        },
      
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

function createABWProjecChart(data1, data2, labels){
  return new Chart(ctx6, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {

          label: 'Peso Promedio Real',
          fill: true,
          data: data2,
          backgroundColor: '#168ede69',
          borderColor: '#168ede'
        },
        {

          label: 'Peso Promedio Proyec.',
          fill: false,
          data:  data1,
          backgroundColor: '#FF0040',
          borderColor: '#FF0040',

        },
      
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

function createSurvivalProjecChart(data1, data2, labels){
  return new Chart(ctx7, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {

          label: 'Supervivencia Real',
          fill: true,
          data: data2,
          backgroundColor: '#168ede69',
          borderColor: '#168ede'
        },
        {

          label: 'Supervivencia Proyec.',
          fill: false,
          data:  data1,
          backgroundColor: '#FF0040',
          borderColor: '#FF0040',

        },
      
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


//others functions
function clearCharts(chart){
  if(chart instanceof Chart){
  chart.destroy();
  }
  
  }

  function getDate(date){
  return $.format.date(date, 'dd MMM yyyy');
  }

// STYLES FOR TABLES 
   $(document).ready(function(){
      // overview
      $holder = $("#dashboard > div > div.card-body > div > div.bootstrap-table > div.fixed-table-toolbar > div > input").detach();
      $("#dashboard > div > div.card-body > div > div.bootstrap-table > div.fixed-table-toolbar").hide();
      $("#dashboard > div > div.card-header > div.search").append($holder);          
   
    });
