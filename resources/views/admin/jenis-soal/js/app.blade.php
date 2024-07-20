<script>
    var tabelJenis, elModalForm, fv, btnAdd
    var modalForm = document.querySelector('#add-new-record')
    var contentForm = document.querySelector('#content-form')
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
                className: 'create-new btn btn-primary waves-effect waves-light'
            }],
        });
        $('div.head-label').html('<h5 class="card-title mb-0">Data Jenis Soal</h5>');

        btnAdd = document.querySelector('.create-new')
        btnAdd.addEventListener('click', function() {
            elModalForm = new bootstrap.Offcanvas(modalForm);
            elModalForm.show()

            var res = dxAjax(`/jenis-soal/formAdd`, {
                id: ''
            }, 'GET')
            if (res.status == 200) {
                contentForm.innerHTML = res.data
                formJenis()
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
        })
    })

    function edit(id) {
        elModalForm = new bootstrap.Offcanvas(modalForm)
        elModalForm.show()

        var res = dxAjax(`/jenis-soal/formEdit`, {
            id: id
        }, 'GET')
        if (res.status == 200) {
            contentForm.innerHTML = res.data
            formJenis()
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

    function formJenis() {
        var form = document.querySelector('#form-add-new-record')
        FormValidation.formValidation(form, {
            fields: {
                kode: {
                    validators: {
                        notEmpty: {
                            message: 'Kode harus diisi'
                        }
                    }
                },
                jenis: {
                    validators: {
                        notEmpty: {
                            message: 'Jenis harus diisi'
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: '.col-sm-12'
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
                instance.on('plugins.message.placed', function(e) {
                    if (e.element.parentElement.classList.contains('input-group')) {
                        e.element.parentElement.insertAdjacentElement('afterend', e
                            .messageElement);
                    }
                });
            }
        }).on('core.form.valid', function() {
            saveForm()
        })
    }

    function saveForm() {
        var action = document.querySelector('#action').value
        var method = action == 'add' ? 'POST' : 'PUT'
        var res = dxAjax(`/jenis-soal/${action}`, $('#form-add-new-record').serialize(), method)
        if (res.status == 200) {
            elModalForm.hide()
            Swal.fire({
                title: 'Berhasil!',
                text: res.message,
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            });
            tabelJenis.ajax.reload(null, false)
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
