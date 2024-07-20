<script>
    var tabeluser

    $(document).ready(function() {
        tabeluser = $('.table-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/manajemen-user',
            "language": {
                "sSearch": "Cari:",
                "sProcessing": "Sedang memproses...",
                "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sLengthMenu": "Tampilkan _MENU_ entri",
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'username'
                },
                {
                    data: 'email'
                },
                {
                    data: 'aksi'
                },
            ]
        });
    })

    function nonaktif(id) {
        Swal.fire({
            title: 'Yakin?',
            text: "Menonaktifkan Akun!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            customClass: {
                confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                cancelButton: 'btn btn-outline-secondary waves-effect'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {

                var res = dxAjax(`/manajemen-user/nonaktifuser`, {
                    id: id
                }, 'GET')
                if (res.status == 200) {
                    tabeluser.ajax.reload(null, false)
                    Swal.fire({
                        title: 'Berhasil!',
                        text: res.message,
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: res.message,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                }
            }
        });
    }

    function aktif(id) {
        Swal.fire({
            title: 'Yakin?',
            text: "Mengaktifkan Akun!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                cancelButton: 'btn btn-outline-secondary waves-effect'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {

                var res = dxAjax(`/manajemen-user/aktifuser`, {
                    id: id
                }, 'GET')
                if (res.status == 200) {
                    tabeluser.ajax.reload(null, false)
                    Swal.fire({
                        title: 'Berhasil!',
                        text: res.message,
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: res.message,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                }
            }
        });
    }
</script>
