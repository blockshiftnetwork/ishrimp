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
  loadPool(urlPool)
  loadDataBio(urlBio);
  loadDataBalanced(urlBalanced);
  loadDataParam(urlParam)
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
    let labels =  loadlabelCreatAt(resp.data,'planted_at')
    let abw = createData(resp.data, 'abw');
    let agw = createData(resp.data,'awg');
    let rc = calRC(resp.data, 'balanced', 'abw', 'survival','planted_larvae');
    console.log('data',agw,'labels',labels);
    bioChart = createBioChart(abw,agw,rc,labels);
    
  });
}

function loadDataBalanced(url){
    $.get(url, function(resp){
    console.log('response', resp);
    let labels =  loadlabelCreatAt(resp.data, 'created_at')
    let r1 = createDataBalanced(resp.data, 'quantity');
    let r2 = createDataBalanced(resp.data, 'quantity');
    let r3 = createDataBalanced(resp.data, 'quantity');
    balacedChart = createbalancedChart(r1,r2,r3,labels);
    
  });
}

function loadDataParam(url){
    $.get(url, function(resp){
    console.log('response', resp);
    let labels =  loadlabelCreatAt(resp.data, 'created_at')
    let pH = createData(resp.data, 'ph');
    let dO = createData(resp.data, 'ppm');
    let temperature = createData(resp.data, 'temperature');
    paramChart = createParamChart(pH,dO,temperature,labels);
    
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

function calRC(data, prop1, abw, survival, planted){
  let values = [];
  for (let i = 0; i < data.length; i++) {
    values.push(data[i][prop1]*2.2/(((data[i][abw]/1000)*2.2)*(data[i][survival]/100)*(data[i][planted])));
  }
  return values;
}
function loadlabelCreatAt(data, prop){
  let labels = [];
  for (let i = 0; i < data.length; i++) {
    labels.push(data[i][prop]);
  }
  return labels;
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

function createbalancedChart(data1, data2, data3, labels){ 
   new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Nature Wellness 42% #1-Gisis',
          fill: false,
          data: data1,
          backgroundColor: '#168ede',
          borderColor: '#168ede'
        },
        {
          label: 'Nature Wellness 42% #1-Gisis',
          fill: false,
          data:  data2,
          backgroundColor: '#FF0040',
          borderColor: '#FF0040'
        },
        {
          label: 'Optiline 35% #5-Gisis',
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

  