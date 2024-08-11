<script>
    var btnKerjakan = document.querySelector('.kerjakan-soal')
    btnKerjakan.addEventListener('click', function() {
        var id = this.dataset.id
        Swal.fire({
            title: 'Kerjakan Sekarang ?',
            text: "Jika sudah mulai, waktu pengerjaan akun terus berjalan !",
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
                btnKerjakan.disabled = true
                btnKerjakan.innerHTML =
                    `<span class="spinner-border me-1" role="status" aria-hidden="true"></span> Mohon Tunggu`
                var res = dxAjax(`/try-out/add`, {
                    id: id
                }, 'GET')
                if (res.status == 200) {
                    var id_sesi = res.data.id
                    var user = res.data.user
                    var ujian = res.data.ujian
                    setTimeout(function() {
                        window.location.href =
                            `/try-out/to?id=${id_sesi}&user=${user}&ujian=${ujian}`
                    }, 1000);
                    btnKerjakan.disabled = false
                    btnKerjakan.innerHTML =
                        `<span class="tf-icons ri-door-open-fill ri-16px me-2"></span>Kerjakan Soal`
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
                    btnKerjakan.disabled = false
                    btnKerjakan.innerHTML =
                        `<span class="tf-icons ri-door-open-fill ri-16px me-2"></span>Kerjakan Soal`
                }
            }
        });
    })
</script>
