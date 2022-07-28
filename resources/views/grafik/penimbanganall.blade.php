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
 
    var datanyaX = xAxis.ticks;
    var datanyaY = yAxis.ticks;
    var goalX = setingan.berdasarkanX;
    var goalY = setingan.berdasarkanY;
    goalX.forEach((da,vi) => {
        
    let cariDataX = datanyaX.reduce(function(prev, curr) {
        return (Math.abs(curr - goalX[vi]) < Math.abs(prev - goalX[vi]) ? curr : prev);
    });
    let cariDataY = datanyaY.reduce(function(prev, curr) {
        return (Math.abs(curr - goalY[vi]) < Math.abs(prev - goalY[vi]) ? curr : prev);
    });
    let GX = datanyaX.indexOf(cariDataX);
    let GY = datanyaY.indexOf(cariDataY);
    let image = new Image();
    image.src = "{{asset('public/icon')}}/iconbalita.png",
        ctx.drawImage(image,xAxis.getPixelForTick(GX)-12 , yAxis.getPixelForTick(GY) - 35);

    });
    


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