var ctx = document.getElementById("myChart").getContext('2d');
var data = [1,4,20, 223, 155,65,100]

var myChart =new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['enero 23','enero 24','enero 25','enero 26','enero 27','enero 28'],
      datasets: [
        {
          type: 'line',
          label: 'Biomasa',
          fill: true,
          data: data,
          backgroundColor: '#168ede69',
          borderColor: '#168ede'
        },
        {

          label: 'crecimiento',
          fill: false,
          data:  [122,500,100,230,434],
          backgroundColor: '#FF0040',
          borderColor: '#FF0040',

        },
        {
          type: 'line',
          label: 'ABW',
          fill: true,
          data:  [23,43,32,12,32,123],
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

  var ctx2 = document.getElementById("myChart2").getContext('2d');
  var myChart2 =new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['enero 23','enero 24','enero 25','enero 26','enero 27','enero 28'],
      datasets: [
        {
          label: 'Nature Wellness 42% #1-Gisis',
          fill: false,
          data: data,
          backgroundColor: '#168ede',
          borderColor: '#168ede'
        },
        {
          label: 'Nature Wellness 42% #1-Gisis',
          fill: false,
          data:  [1222,9000,1000,2030,4334],
          backgroundColor: '#FF0040',
          borderColor: '#FF0040'
        },
        {
          label: 'Optiline 35% #5-Gisis',
          fill: false,
          data:  [2300,4300,3220,1232,32232],
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

  var ctx3 = document.getElementById("myChart3").getContext('2d');
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
  });

  var ctx4 = document.getElementById("myChart4").getContext('2d');
  var myChart4 =new Chart(ctx4, {
    type: 'line',
    data: {
      labels: ['enero 23','enero 24','enero 25','enero 26','enero 27','enero 28'],
      datasets: [
        {

          label: 'Temp',
          fill: true,
          data: [23,34,23,18,32,25],
          backgroundColor: '#168ede69',
          borderColor: '#168ede'
        },
        {

          label: 'Do',
          fill: false,
          data:  [122,200,50,130,234,132],
          backgroundColor: '#FF0040',
          borderColor: '#FF0040',

        },
        {

          label: 'pH',
          fill: true,
          data:  [4,4,,4,6,3,5],
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
