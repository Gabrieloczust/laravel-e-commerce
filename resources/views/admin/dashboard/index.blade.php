@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title', 'Dashboard')

@section('content_header')

    <div class="row">
        <div class="col-12 col-md-8">
            <h1>Dashboard</h1>
        </div>

        <!-- Filter Month -->
        <div class="col-12 col-md-4 mt-sm-0 mt-2">
            <form class="form" method="GET">
                <select class="custom-select" name="month" onchange="this.form.submit()">
                    <option selected value="" disabled>Filtrar...</option>
                    @foreach ($months as $monthNumber => $month)
                        <option value="{{ $monthNumber + 1 }}" {{ $filter != $monthNumber + 1 ?: 'selected' }}>            
                            {{ $month }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <!-- End Filter Month -->
    </div>
@endsection

@section('content')

    <!-- Values of filter -->
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-tshirt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Produtos</span>
                    <span class="info-box-number">{{ $filterProducts }}</span>                
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-tags"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Categorias</span>
                    <span class="info-box-number">{{ $filterCategories }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Vendas</span>
                    <span class="info-box-number">{{ $filterSales }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Values of filter -->

    <!-- Char -->
    @if($filterSales > 0)
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Vendas</h3>
                        <a href="javascript:void(0);">Exibir relatório</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">@money($filterSalesTotal)</span>
                            <span class="text-muted">Total de Vendas</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            @if($filterIncrease > 0)
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 
                                    @percent($filterIncrease)
                                </span>
                            @else
                                <span class="text-danger">
                                    <i class="fas fa-arrow-down"></i> 
                                    @percent($filterIncrease)
                                </span>
                            @endif
                            <span class="text-muted">Desde o último mês</span>
                        </p>
                    </div>

                    <div class="position-relative mb-4">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="sales-chart" height="200" style="display: block; width: 479px; height: 200px;"
                            width="479" class="chartjs-render-monitor"></canvas>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-warning text-center">
            Nenhuma venda feita neste mês!
        </div>
    @endif
    <!-- End Char -->

@endsection

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
