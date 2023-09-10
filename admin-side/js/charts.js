
// ------------------------------------------------------ RADAR ---------------------------------------------//

var options = {
    series: [70],
    chart: {
        height: 350,
        type: 'radialBar',
    },
    plotOptions: {
        radialBar: {
            hollow: {
                size: '70%',
            }
        },
    },
    labels: ['Total Sales target'],
};

var chart = new ApexCharts(document.querySelector("#radar"), options);
chart.render();

// ----------------------------------------------------- BAR GRAPH ---------------------------------------------//


      
var options = {
    series: [{
    name: 'Total reservation',
    data: [10, 55, 41, 67, 22]
  }],
    annotations: {
    points: [{
      x: 'Retreat',
      seriesIndex: 0,
      label: {
        borderColor: '#775DD0',
        offsetY: 0,
        style: {
          color: '#fff',
          background: '#775DD0',
        }
      }
    }]
  },
  chart: {
    height: 350,
    type: 'bar',
  },
  plotOptions: {
    bar: {
      borderRadius: 10,
      columnWidth: '50%',
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    width: 2
  },
  
  grid: {
    row: {
      colors: ['#fff', '#f2f2f2']
    }
  },
  xaxis: {
    labels: {
      rotate: -45
    },
    categories: ['Recollection', 'Retreat', 'Trainings', 'Seminars', 'Reception'],
    tickPlacement: 'on'
  },
  yaxis: {
    title: {
      text: 'Sales',
    },
  },
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'light',
      type: "horizontal",
      shadeIntensity: 0.25,
      gradientToColors: undefined,
      inverseColors: true,
      opacityFrom: 0.85,
      opacityTo: 0.85,
      stops: [50, 0, 100]
    },
  }
  };

  var chart = new ApexCharts(document.querySelector("#column"), options);
  chart.render();
