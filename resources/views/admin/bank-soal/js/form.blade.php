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

    var jenis = document.querySelector('#jenis_soal')
    jenis.addEventListener('change', function() {
        var id = this.value
        getFromJenis(id)
    })

    function getFromJenis(id) {
        var res = dxAjax('/bank-soal/get-from-jenis', {
            id: id
        }, 'GET')
        if (res.status == 200) {
            var bobot = document.querySelector('#bobot_soal')
            var jml = document.querySelector('#jml_soal')
            bobot.value = Math.round(res.data ? res.data.detail_sum_bobot_soal : 0)
            jml.value = Math.round(res.data ? res.data.detail_sum_jml_soal : 0)
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

    function saveForm() {
        var btnSimpan = document.querySelector('.btn-submit')
        btnSimpan.disabled = true
        btnSimpan.innerHTML = `<span class="spinner-border me-1" role="status" aria-hidden="true"></span> Mohon Tunggu`
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
            setTimeout(function() {
                window.location.href = '/bank-soal'
            }, 2000);
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
            btnSimpan.disabled = false
            btnSimpan.innerHTML = `Simpan`
        }
    }
</script>
