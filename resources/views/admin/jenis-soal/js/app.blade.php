<script>
    var tabelJenis, elModal
    $(document).ready(function() {
        tabelJenis = $('.table-jenis').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/jenis-soal',
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
                    data: 'jenis'
                },
                {
                    data: 'aksi'
                },
            ],
            dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            buttons: [{
                text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Tambah</span>',
                className: 'create-new btn btn-primary waves-effect waves-light',
                action: function(e, dt, node, config) {
                    window.location.href = '/jenis-soal/create';
                }
            }],
        });
        $('div.head-label').html('<h5 class="card-title mb-0">Data Jenis Soal</h5>');
    })

    function edit(id) {
        window.location.href = `/jenis-soal/ubah?id=${id}`
    }

    function show(id) {
        var res = dxAjax(`/jenis-soal/show`, {
            id: id
        }, 'GET')
        if (res.status == 200) {
            elModal = new bootstrap.Modal('#modal-form')
            elModal.show()

            var content = document.querySelector('#content-form')
            content.innerHTML = res.data
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

    function hapus(id) {
        Swal.fire({
            title: 'Yakin?',
            text: "Menghapus data ini!",
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

                var res = dxAjax(`/jenis-soal/hapus`, {
                    id: id
                }, 'DELETE')
                if (res.status == 200) {
                    tabelJenis.ajax.reload(null, false)
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
