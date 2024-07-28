<script>
    var tabelRuangUjian
    $(document).ready(function() {
        tabelRuangUjian = tabelBankSoal = $('.table-bank-soal').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/ruang-ujian',
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
                    data: 'tanggal_mulai'
                },
                {
                    data: 'tanggal_selesai'
                },
                {
                    data: 'aksi'
                },
            ],
        });
    })

    function detail(id) {
        window.location.href = `/ruang-ujian/detail?id=${id}`
    }
</script>
