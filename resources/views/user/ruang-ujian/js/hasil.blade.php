<script>
    var id_sesi = "{!! $data->sesiuser->id !!}"
    var btnTab = document.querySelectorAll('.btn-tab')
    var field = document.querySelector('#field-content')
    btnTab.forEach(tab => tab.addEventListener('click', function() {
        var id_ruang = this.dataset.id
        var res = dxAjax(`/ruang-ujian/hasil/jenis`, {
            id_ruang: id_ruang,
            id_sesi: id_sesi
        }, 'GET')
        if (res.status == 200) {
            field.innerHTML = res.data
        } else {
            Swal.fire({
                title: 'Error !',
                text: 'Terdapat kesalahan, harap hubungi admin',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            });
        }
    }))
</script>
