@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title', 'Vendas')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Vendas {{ $year }}</h1>
</div>
@stop

@section('content')
<!-- Char -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">@money($salesYear)</span>
                        <span class="text-muted">Total de Vendas</span>
                    </p>
                    <a href="javascript:void(0);">Exibir relatório</a>
                </div>
            </div>
            <div class="position-relative m-4">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="sales-chart" height="200" style="display: block; width: 479px; height: 200px;" width="479"
                    class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- End Char -->
@stop


@section('js')
<script>
    $(function () {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var months = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro','Dezembro' 
        ];

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#sales-chart')
        var salesChart = new Chart($salesChart, {
            type: 'line',
            data: {
                labels: [
                    @foreach($salesMonth as $saleMonth) 
                        months[{{ $saleMonth['month'] - 1 }}],
                    @endforeach
                ],
                datasets: [
                    {
                        borderColor: "#36a2eb",                        
                        borderWidth: 1,
                        fill: false,
                        data: [
                            @foreach($salesMonth as $saleMonth) 
                                {{ $saleMonth['total'] }},
                            @endforeach
                        ]
                    },
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
