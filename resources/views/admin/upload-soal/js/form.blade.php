<script>
    var selectSoal = $('.soal-select')
    var tglMulai = document.querySelector('#tanggal_mulai')
    var tglSelesai = document.querySelector('#tanggal_selesai')
    var form = document.querySelector('#form-upload-soal')
    $(document).ready(function() {
        FormValidation.formValidation(form, {
                fields: {
                    soal: {
                        validators: {
                            notEmpty: {
                                message: 'Bank soal harus dipilih'
                            }
                        }
                    },
                    jenis: {
                        validators: {
                            notEmpty: {
                                message: 'Tipe soal harus diisi'
                            }
                        }
                    },
                    tipe: {
                        validators: {
                            notEmpty: {
                                message: 'Status soal harus dipilih'
                            }
                        }
                    },
                    tanggal_mulai: {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal mulai harus diisi'
                            }
                        }
                    },
                    tanggal_selesai: {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal selesai harus diisi'
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
                        rowSelector: '.upload-soal'
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
        var res = dxAjax(`/upload-soal/${action}`, $('#form-upload-soal').serialize(), method)
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
            window.location.href = '/upload-soal'
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

    if (selectSoal.length) {
        selectSoal.each(function() {
            var $this = $(this);
            select2Focus($this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Pilih Bank Soal',
                dropdownParent: $this.parent()
            });
        });
    }

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
</script>
