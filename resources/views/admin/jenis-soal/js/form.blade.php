<script>
    const formDetail = $('.detail')

    $(document).ready(function() {
        var form = document.querySelector('#form-jenis-soal')
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
                                message: 'Nama soal harus diisi'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.jenis-soal'
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
        var btnSimpan = document.querySelector('.btn-submit')
        btnSimpan.disabled = true
        btnSimpan.innerHTML = `<span class="spinner-border me-1" role="status" aria-hidden="true"></span> Mohon Tunggu`
        var action = document.querySelector('#action').value
        var method = action == 'add' ? 'POST' : 'PUT'
        var res = dxAjax(`/jenis-soal/${action}`, $('#form-jenis-soal').serialize(), method)
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
                window.location.href = '/jenis-soal'
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

    if (formDetail.length) {
        var row = 2;
        var col = 1;
        formDetail.repeater({
            show: function() {
                var fromControl = $(this).find('.form-control, .form-select');
                var formLabel = $(this).find('.form-label');

                fromControl.each(function(i) {
                    var id = 'form-repeater-' + row + '-' + col;
                    $(fromControl[i]).attr('id', id);
                    $(formLabel[i]).attr('for', id);
                    col++;
                });

                row++;

                $(this).slideDown();
            },
            hide: function(e) {
                confirm('Are you sure you want to delete this element?') && $(this).slideUp(e);
            }
        });
    }
</script>
