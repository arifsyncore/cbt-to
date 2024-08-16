<script>
    var id_bank = document.querySelector('#id_bank').value
    var btnKembali = document.querySelector('.btn-kembali')
    btnKembali.addEventListener('click', function() {
        window.location.href = `/bank-soal/detail?id=${id_bank}`
    })

    var form = document.querySelector('#form-soal')
    FormValidation.formValidation(form, {
        fields: {
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
            text_pembahasan: {
                validators: {
                    notEmpty: {
                        message: 'Deskripsi pembahasan harus diisi'
                    }
                }
            },
            gambar: {
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,
                        message: 'Ekstensi file harus image',
                    },
                }
            }
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

    async function saveForm() {
        var action = document.querySelector('#action').value
        var method = action == 'add' ? 'POST' : 'PUT'
        var gambar = document.querySelector('#gambar')
        var form = document.querySelector('#form-soal')
        var formData = new FormData(form)
        formData.append('image', gambar.files[0])
        let url
        if (action == 'edit') {
            url = `/bank-soal/detail/edit`
            formData.append('_method', 'PUT')
        } else {
            url = `/bank-soal/detail/add`
        }
        var res = await requestDataAjax(url, 'POST', formData)
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
                window.location.href = `/bank-soal/detail?id=${id_bank}`
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
</script>
