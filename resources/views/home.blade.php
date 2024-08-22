@extends('layouts.main')

@section('title', 'Dashboard')
@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
@endsection
@section('content')
    @if (Auth::user()->role_id == 2)
        <div class="card bg-transparent shadow-none border-0 mb-6">
            <div class="card-body row g-6 p-0 pb-5">
                <div class="col-12 col-md-8 card-separator">
                    <h5 class="mb-2">Selamat Datang,<span class="h4 fw-semibold"> {{ Auth::user()->name }} 👋🏻</span></h5>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif
@endsection

@section('js')
    <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script>
        var res = dxAjax(`/dashboard`, {}, 'GET')
        var options = {
            series: [{
                name: "Nilai Total",
                data: res.nilai
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Grafik Nilai Total',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: res.ujian,
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var res = dxAjax(`/dashboard/getChart`, {}, 'GET')
        var options2 = {
            series: res.detail,
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                },
                events: {
                    click: function(event, chartContext, opts) {
                        console.log(opts.w);
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            title: {
                text: 'Grafik Nilai per Sub Test',
                align: 'left'
            },
            legend: {
                tooltipHoverFormatter: function(val, opts) {
                    return val + ' - <strong>' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] +
                        '</strong>'
                }
            },
            markers: {
                size: 0,
                hover: {
                    sizeOffset: 6
                }
            },
            xaxis: {
                categories: res.ujian,
            },
            grid: {
                borderColor: '#f1f1f1',
            }
        };

        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();
    </script>
@endsection
