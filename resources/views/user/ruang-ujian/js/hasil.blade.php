<script>
    // var id_sesi = "{!! $data->sesiuser->id !!}"
    // var btnTab = document.querySelectorAll('.btn-tab')
    // var field = document.querySelector('#field-content')
    // btnTab.forEach(tab => tab.addEventListener('click', function() {
    //     var id_ruang = this.dataset.id
    //     var res = dxAjax(`/ruang-ujian/hasil/jenis`, {
    //         id_ruang: id_ruang,
    //         id_sesi: id_sesi
    //     }, 'GET')
    //     if (res.status == 200) {
    //         field.innerHTML = res.data
    //     } else {
    //         Swal.fire({
    //             title: 'Error !',
    //             text: 'Terdapat kesalahan, harap hubungi admin',
    //             icon: 'error',
    //             customClass: {
    //                 confirmButton: 'btn btn-primary waves-effect waves-light'
    //             },
    //             buttonsStyling: false
    //         });
    //     }
    // }))
    var id_ruang_ujian = "{!! $data->id !!}"
    var id_sesi = "{!! $data->sesiuser->id !!}"
    var fieldsTab = document.querySelector('#field_tab')
    var fieldsSoal = document.querySelector('#field_soal')
    var fieldsNilaiSub = document.querySelector('#nilai-persub')
    document.addEventListener('DOMContentLoaded', async () => {
        loadsoal(id_ruang_ujian, id_sesi, nomor = null)
    })

    function loadsoal(idruang, idsesi, nomor) {
        var res = dxAjax(`/ruang-ujian/hasil/loadsoal`, {
            id_ruang: idruang,
            id_sesi: idsesi,
            nomor: nomor
        }, 'GET')
        if (res.status == 200) {
            fieldsTab.innerHTML = res.dataTab
            fieldsSoal.innerHTML = res.dataSoal
            fieldsNilaiSub.innerHTML = res.dataNilaiSub
            pageSoal()
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

    function pageSoal() {
        var btnTab = document.querySelectorAll('.btn-tab')
        btnTab.forEach(tab => tab.addEventListener('click', function() {
            var nomor = this.dataset.no
            loadsoal(id_ruang_ujian, id_sesi, nomor)
        }))

        var btnLanjut = document.querySelector('.btn-lanjut')
        btnLanjut.addEventListener('click', function() {
            var nomor = this.dataset.no
            loadsoal(id_ruang_ujian, id_sesi, nomor)
        })

        var btnKembali = document.querySelector('.btn-kembali')
        btnKembali.addEventListener('click', function() {
            var nomor = this.dataset.no
            loadsoal(id_ruang_ujian, id_sesi, nomor)
        })
    }
</script>
