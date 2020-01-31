@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title', 'Vendas')

@section('content_header')
    <h1>Vendas</h1>
@stop

@section('content')
    ...
@stop


@section('js')
<script>
    $(function () {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#sales-chart')
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($days as $day => $total)
                        'Dia {{ $day }}',
                    @endforeach
                ],
                datasets: [
                    {
                        backgroundColor: ["rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)", "rgba(255, 99, 132, 0.2)",],
                        borderColor: ["rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)","rgb(255, 99, 132)",],
                        borderWidth: 1,
                        data: [
                            @foreach($days as $key => $day)
                                {{ $day['total'] }},
                            @endforeach
                        ]
                    }
                ]
            },
            options: {
                maintainAspectRatio: true,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            stepSize: undefined,
                            // Include a dollar sign in the ticks
                            callback: function (value, index, values) {
                                if (value >= 1000) {
                                    value /= 1000
                                    value += ' mil'
                                }
                                return 'R$ ' + value
                            }
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
    })

</script>
@endsection
