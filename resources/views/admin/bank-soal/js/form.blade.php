<script>
    $(document).ready(function() {
        var form = document.querySelector('#form-bank-soal')
        FormValidation.formValidation(form, {
                fields: {
                    kode: {
                        validators: {
                            notEmpty: {
                                message: 'Kode harus diisi'
                            }
                        }
                    },
                    nama: {
                        validators: {
                            notEmpty: {
                                message: 'Nama soal harus diisi'
                            }
                        }
                    },
                    jenis_soal: {
                        validators: {
                            notEmpty: {
                                message: 'Jenis Soal harus dipilin'
                            }
                        }
                    },
                    jml_soal: {
                        validators: {
                            notEmpty: {
                                message: 'Jumlah Soal harus diisi'
                            }
                        }
                    },
                    bobot_soal: {
                        validators: {
                            notEmpty: {
                                message: 'Jumlah Soal harus diisi'
                            }
                        }
                    },
                    opsi_jawab: {
                        validators: {
                            notEmpty: {
                                message: 'Opsi Jawaban harus dipilih'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.bank-soal'
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
            })
            .on('core.form.valid', function() {
                saveForm()
            })
    })

    function saveForm() {
        var action = document.querySelector('#action').value
        var method = action == 'add' ? 'POST' : 'PUT'
        var res = dxAjax(`/bank-soal/${action}`, $('#form-bank-soal').serialize(), method)
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
            window.location.href = '/bank-soal'
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
</script>
