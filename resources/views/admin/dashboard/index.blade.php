@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title', 'Dashboard')

@section('content_header')
<div class="row">
    <div class="col-12 col-md-8">
        <h1>Dashboard</h1>
    </div>
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
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-tshirt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Novos Produtos</span>
                <span class="info-box-number">
                    @if(isset($filterProducts->monthCount))
                        {{ $filterProducts->monthCount }}
                    @else
                        Não possui cadastrados 
                     @endif
                </span>                
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-tags"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Novas Categorias</span>
                <span class="info-box-number">
                    @if(isset($filterCategories->monthCount))
                        {{ $filterCategories->monthCount }}
                    @else
                        Não possui cadastrados
                    @endif
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-dollar-sign"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Faturamento</span>
                <span class="info-box-number">{{ $sales }}</span>
            </div>
        </div>
    </div>
</div>
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
                        <span class="text-bold text-lg">{{ $sales }}</span>
                        <span>Total de Vendas</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 100%
                        </span>
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

                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Este ano
                    </span>

                    <span>
                        <i class="fas fa-square text-gray"></i> Ano passado
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
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
                labels: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AUG', 'SET', 'OUT', 'NOV',
                    'DEZ'
                ],
                datasets: [{
                        backgroundColor: '#007bff',
                        borderColor: '#007bff',
                        data: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    },
                    {
                        backgroundColor: '#ced4da',
                        borderColor: '#ced4da',
                        data: [1, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22]
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
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

                            // Include a dollar sign in the ticks
                            callback: function (value, index, values) {
                                if (value >= 1000) {
                                    value /= 1000
                                    value += 'k'
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
