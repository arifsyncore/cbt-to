<script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script>
    var field = document.querySelector('#chart')
    if (field) {
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
    }
</script>
<script>
    var tableNilai
    $(document).ready(function() {
        tableNilai = document.querySelector('.table-nilai')
        if (tableNilai) {
            tableNilai = $('.table-nilai').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/dashboard/nilai',
                "language": {
                    "sSearch": "Cari:",
                    "sProcessing": "Sedang memproses...",
                    "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sLengthMenu": "Tampilkan _MENU_ entri",
                },
                columns: [{
                        data: 'kode'
                    },
                    {
                        data: 'nama_soal'
                    },
                    {
                        data: 'aksi'
                    },
                ],
            });
        }
    })
</script>
