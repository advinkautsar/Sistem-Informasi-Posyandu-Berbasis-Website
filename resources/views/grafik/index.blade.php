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
                            labelString: 'Berat Badan (kg)',
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
                        labelString: 'Panjang Badan (cm)',
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