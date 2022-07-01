@extends('grafik.grafik_layout')
@section('nama_grafik',$nama_grafik)
@section('content')

<script>

    let dataGrafik = @json($data);
    let setingan = @json($setingan);
    let datasets = [];
    let colors = ['black','black','pink','orange','green','orange','pink','black']
    let icolor = 0;
    for (dat in dataGrafik){
       if(icolor!=0){
        datasets.push({
            data: dataGrafik[dat],
            fill: false,
            lineTension: 0.2,
            borderColor: colors[icolor],
            
        })
       }
        icolor++;
    }

    let data = {
        type: 'line',
        plugins: [{
  afterDraw: chart => {
    var ctx = chart.chart.ctx;
    var xAxis = chart.scales['x-axis-0'];
    var yAxis = chart.scales['y-axis-0'];
    // xAxis.ticks.forEach((value, index) => {
    //   var x = xAxis.getPixelForTick(index);
    //   var y = yAxis.getPixelForTick(index);
    //   console.log(x)
    //   console.log(value);
    //   var image = new Image();
    //   image.src = "https://i.stack.imgur.com/2RAv2.png",
    //     ctx.drawImage(image, x - 12, 400.74912448181936-35);
    // });

    
    var datanyaX = xAxis.ticks;
    var datanyaY = yAxis.ticks;
    var goalX = setingan.berdasarkanX;
    var goalY = setingan.berdasarkanY;
    var cariDataX = datanyaX.reduce(function(prev, curr) {
        return (Math.abs(curr - goalX) < Math.abs(prev - goalX) ? curr : prev);
    });
    var cariDataY = datanyaY.reduce(function(prev, curr) {
        return (Math.abs(curr - goalY) < Math.abs(prev - goalY) ? curr : prev);
    });
    goalX = datanyaX.indexOf(cariDataX);
    goalY = datanyaY.indexOf(cariDataY);
    var image = new Image();
    image.src = "{{asset('/icon')}}/iconbalita.png",
        ctx.drawImage(image,xAxis.getPixelForTick(goalX)-12 , yAxis.getPixelForTick(goalY) - 35);
  }
}],
        data: {
            labels: dataGrafik.label,
            datasets: datasets,
        },
        options: {
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                },
                line: {
                    borderWidth: 1
                }
            },
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 2,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: setingan.titleY,
                            fontSize: 14,
                        },
                    },
                    {
                        type: 'linear',
                        position: 'right',
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 2,
                            min: 0,
                            max: setingan.maxy,
                        }
                    }
                ],

                xAxes: [{
                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: setingan.maxx,
                    },
                    scaleLabel: {
                        display: true,
                        labelString: setingan.titleX,
                        fontSize: 14,
                    },

                }],
            }
        },

    }

    var ctx = document.getElementById("linechart").getContext("2d");
    new Chart(ctx, data);
</script>
@endsection