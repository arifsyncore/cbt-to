<script>
    var tabelSoal, elFormModal
    var bank_id = document.querySelector('#bank_id')
    var formContent = document.querySelector('#form-content')
    $(document).ready(function() {
        tabelSoal = $('.table-soal').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: `/bank-soal/detail?id=${bank_id.value}`,
            "language": {
                "sSearch": "Cari:",
                "sProcessing": "Sedang memproses...",
                "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sLengthMenu": "Tampilkan _MENU_ entri",
            },
            columns: [{
                    data: 'soal'
                },
                {
                    data: 'opsi'
                },
                {
                    data: 'jawaban'
                },
                {
                    data: 'jenis_soal'
                },
                {
                    data: 'aksi'
                },
            ],
        })
    })

    function formDetail() {
        var modalForm = document.querySelector('#form-detail-soal')
        var contentForm = document.querySelector('#content-form')
        elFormModal = new bootstrap.Modal(modalForm)
        elFormModal.show()

        var res = dxAjax(`/bank-soal/detail/form`, {
            id: bank_id.value
        }, 'GET')
        if (res.status == 200) {
            contentForm.innerHTML = res.data
            formValidation()
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

    function edit(id) {
        var modalForm = document.querySelector('#form-detail-soal')
        var contentForm = document.querySelector('#content-form')
        elFormModal = new bootstrap.Modal(modalForm)
        elFormModal.show()

        var res = dxAjax(`/bank-soal/detail/form-edit`, {
            id: id,
            id_bank: bank_id.value
        }, 'GET')

        if (res.status == 200) {
            contentForm.innerHTML = res.data
            formValidation()
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

                var res = dxAjax(`/bank-soal/detail/hapus`, {
                    id: id
                }, 'DELETE')
                if (res.status == 200) {
                    tabelSoal.ajax.reload(null, false)
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

    function formValidation() {
        var form = document.querySelector('#form-soal')
        FormValidation.formValidation(form, {
            fields: {
                jenis_soal: {
                    validators: {
                        notEmpty: {
                            message: 'Jenis soal harus dipilih'
                        }
                    }
                },
                soal: {
                    validators: {
                        notEmpty: {
                            message: 'Soal harus diisi'
                        }
                    }
                },
                opsi_a: {
                    validators: {
                        notEmpty: {
                            message: 'Jawaban A harus diisi'
                        }
                    }
                },
                opsi_b: {
                    validators: {
                        notEmpty: {
                            message: 'Jawaban B harus diisi'
                        }
                    }
                },
                opsi_c: {
                    validators: {
                        notEmpty: {
                            message: 'Jawaban C harus diisi'
                        }
                    }
                },
                opsi_d: {
                    validators: {
                        notEmpty: {
                            message: 'Jawaban D harus diisi'
                        }
                    }
                },
                opsi_e: {
                    validators: {
                        notEmpty: {
                            message: 'Jawaban E harus diisi'
                        }
                    }
                },
                jawaban: {
                    validators: {
                        notEmpty: {
                            message: 'Jawaban benar harus dipilih'
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: '.input-soal'
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
        var res = dxAjax(`/bank-soal/detail/${action}`, $('#form-soal').serialize(), method)
        if (res.status == 200) {
            Swal.fire({
                title: 'Berhasil!',
                text: res.message,
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            });
            // check(res.bank)
            elFormModal.hide()
            setTimeout(function() {
                window.location.reload()
            }, 500);
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

    function check(data) {
        console.log(data.detail.length);
        var indikator = document.querySelector('.indikator')
        if (data.detail.length >= data.jml_soal) {
            indikator.innerHTML = `<div class="card bg-success text-white">
                                        <div class="card-header text-white text-center">Pembuatan Soal Selesai</div>
                                        <div class="card-body">
                                            <h3 class="card-title text-white text-center font-weight-bold">Selesai</h3>
                                            <p class="card-text text-center">Soal sudah cukup dan siap digunakan</p>
                                        </div>
                                    </div>`
        } else {
            indikator.innerHTML = `<div class="card bg-danger text-white">
                                        <div class="card-header text-white text-center">Pembuatan Soal Belum Selesai</div>
                                        <div class="card-body">
                                            <h3 class="card-title text-white text-center font-weight-bold">Belum Selesai
                                            </h3>
                                            <p class="card-text text-center">Soal belum siap digunakan</p>
                                        </div>
                                    </div>`
        }
    }
</script>
