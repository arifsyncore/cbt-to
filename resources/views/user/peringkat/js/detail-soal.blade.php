<script>
    var jenis = JSON.parse('{!! json_encode($soal->soalto->soal->jenis->detail) !!}')
    var id_upload_soal = "{!! $soal->id_upload_soal !!}"
    $(document).ready(function() {
        jenis.forEach(el => {
            var param = {}
            param.id_jenis = el.id
            param.id_upload_soal = id_upload_soal
            var data = JSON.stringify(param)
            var url = `/peringkat/listperingkat/detail/${data}`
            var tabel = $(`.table-rangking-${el.nama}`).DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                "language": {
                    "sSearch": "Cari:",
                    "sProcessing": "Sedang memproses...",
                    "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sLengthMenu": "Tampilkan _MENU_ entri",
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'skor'
                    },
                ],
            })
        });
    })
</script>
