<script>
    var tabelRuangUjian
    $(document).ready(function() {
        tabelRuangUjian = tabelBankSoal = $('.table-ruang-ujian').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/peringkat',
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
    })

    function detail(id) {
        window.location.href = `/peringkat/detail?id=${id}`
    }
</script>
