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
                window.location.href = `/try-out/cbt?id=${id}`
            }
        });
    })
</script>
