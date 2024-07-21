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
                    tipe: {
                        validators: {
                            notEmpty: {
                                message: 'Tipe Soal harus dipilih'
                            }
                        }
                    },
                    tanggal_mulai: {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal Mulai harus diisi'
                            }
                        }
                    },
                    tanggal_selesai: {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal Selesai harus diisi'
                            }
                        }
                    },
                    durasi: {
                        validators: {
                            notEmpty: {
                                message: 'Durasi harus diisi'
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

        var tglMulai = document.querySelector('#tanggal_mulai')
        var tglSelesai = document.querySelector('#tanggal_selesai')

        if (tglMulai) {
            tglMulai.flatpickr({
                enableTime: true,
                dateFormat: 'Y-m-d H:i'
            });
        }

        if (tglSelesai) {
            tglSelesai.flatpickr({
                enableTime: true,
                dateFormat: 'Y-m-d H:i'
            });
        }
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
