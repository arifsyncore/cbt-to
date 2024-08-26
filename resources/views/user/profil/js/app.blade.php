<script>
    const formProfil = document.querySelector('#form-data-diri')
    document.addEventListener('DOMContentLoaded', function(e) {
        FormValidation.formValidation(formProfil, {
                fields: {
                    nama_lengkap: {
                        validators: {
                            notEmpty: {
                                message: 'Nama lengkap harus diisi'
                            },
                        }
                    },
                    nama_alias: {
                        validators: {
                            notEmpty: {
                                message: 'Nama panggilan harus diisi'
                            },
                        }
                    },
                    jekel: {
                        validators: {
                            notEmpty: {
                                message: 'Jenis kelamin harus dipilih'
                            },
                        }
                    },
                    tanggal_lahir: {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal lahir harus diisi'
                            },
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Nama lengkap harus diisi'
                            },
                            emailAddress: {
                                message: 'Alamat email tidak valid'
                            }
                        }
                    },
                    telp: {
                        validators: {
                            notEmpty: {
                                message: 'Nomor whatsapps harus diisi'
                            },
                        }
                    },
                    provinsi: {
                        validators: {
                            notEmpty: {
                                message: 'Provinsi harus dipilih'
                            },
                        }
                    },
                    kab_kota: {
                        validators: {
                            notEmpty: {
                                message: 'Kab/Kota harus dipilih'
                            },
                        }
                    },
                    alamat_lengkap: {
                        validators: {
                            notEmpty: {
                                message: 'Alamat lengkap harus diisi'
                            },
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.input-profil'
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
                saveDataDiri()
            })

        getKab()
    })

    function saveDataDiri() {
        var btnSimpan = document.querySelector('.btn-simpan-datadiri')
        btnSimpan.disabled = true
        btnSimpan.innerHTML =
            `<span class="spinner-border me-1" role="status" aria-hidden="true"></span> Mohon Tunggu`

        var res = dxAjax(`/profil/update-data-diri`, $('#form-data-diri').serialize(), 'PUT')
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
                location.reload()
            }, 1000);
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

    const flatpickrDate = document.querySelector('#flatpickr-date')
    if (flatpickrDate) {
        flatpickrDate.flatpickr({
            monthSelectorType: 'static'
        });
    }

    var select_prov = document.querySelector('#provinsi')
    var select_kab = document.querySelector('#kab_kota')
    select_prov.addEventListener('change', async function(e) {
        var id = e.target.options[event.target.selectedIndex].dataset.id
        var res = dxAjax(`/register/getKota`, {
            id: id
        }, 'GET')
        if (res.resCode == 200) {
            select_kab.innerHTML = `<option value="">-- Pilih Kota / Kab --</option>`
            res.data.forEach(kota => {
                select_kab.innerHTML +=
                    `<option value="${kota.name}">${kota.name}</option>`
            })
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

    function getKab() {
        var kab = '{{ $data->kota_kab }}'
        var prov = '{{ $data->provinsi }}'
        var selected = select_prov.selectedIndex
        var id = select_prov.options[selected].dataset.id
        var res = dxAjax(`/register/getKota`, {
            id: id
        }, 'GET')
        if (res.resCode == 200) {
            if (res.data != null) {
                select_kab.innerHTML = `<option value="">-- Pilih Kota / Kab --</option>`
                res.data.forEach(kota => {
                    select_kab.innerHTML +=
                        `<option value="${kota.name}" ${kab == kota.name ? 'selected' : ''}>${kota.name}</option>`
                })
            }
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
