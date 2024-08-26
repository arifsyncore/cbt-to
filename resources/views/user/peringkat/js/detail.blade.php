<script>
    var tabelPeringkat
    var id_ruang_ujian = "{!! $soal->id_upload_soal !!}"
    $(document).ready(function() {
        tabelPeringkat = $('.table-rangking').DataTable({
            processing: true,
            serverSide: true,
            ajax: `/peringkat/listperingkat/${id_ruang_ujian}`,
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
                {
                    data: 'aksi'
                },
            ],
        });
    })

    function detail(id) {
        window.location.href = `/peringkat/detail-soal?id=${id}`
    }
</script>
