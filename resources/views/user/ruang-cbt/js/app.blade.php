<script>
    var id_ruang_ujian = "{!! $data['id_ruang_ujian'] !!}"
    var id_sesi = "{!! $data['id_sesi'] !!}"
    var fieldsTab = document.querySelector('#field_tab')
    var fieldsSoal = document.querySelector('#field_soal')
    var btnSubmit = document.querySelector('.btn-submit')
    var btnKeluar = document.querySelector('.btn-keluar')
    document.addEventListener('DOMContentLoaded', async () => {
        setWaktu()
        loadsoal(id_ruang_ujian, id_sesi, nomor = null)
    })

    function loadsoal(idruang, idsesi, nomor) {
        var res = dxAjax(`/try-out/load-soal`, {
            id_ruang: idruang,
            id_sesi: idsesi,
            nomor: nomor
        }, 'GET')
        if (res.status == 200) {
            fieldsTab.innerHTML = res.dataTab
            fieldsSoal.innerHTML = res.dataSoal
            pageSoal()
        }
    }

    function pageSoal() {
        var radioJwb = document.querySelectorAll('.jawaban')
        radioJwb.forEach(radio => radio.addEventListener('change', function() {
            var no = radio.dataset.no
            var idsoal = radio.dataset.idsoal
            var value = radio.value
            var btn = document.querySelector(`#btn-tab${no}`)
            btn.classList.remove('btn-outline-primary')
            btn.classList.add('btn-primary')
            saveJawaban(idsoal, value)
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

        var btnTab = document.querySelectorAll('.btn-tab')
        btnTab.forEach(tab => tab.addEventListener('click', function() {
            var nomor = this.dataset.no
            loadsoal(id_ruang_ujian, id_sesi, nomor)
        }))
    }

    function saveJawaban(idsoal, value) {
        var res = dxAjax(`/try-out/simpan-jawaban`, {
            id: idsoal,
            value: value
        }, 'GET')
        if (res.status != 200) {
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
    }

    btnSubmit.addEventListener('click', function() {
        Swal.fire({
            title: 'Yakin?',
            text: "Jawaban yang sudah disubmit akan tersimpan dan tidak bisa mengerjakan lagi !",
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
                var res = dxAjax(`/try-out/submit`, {
                    id_ruang: id_ruang_ujian
                }, 'GET')
                if (res.status == 200) {
                    window.location.href = `/ruang-ujian`
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
            }
        });
    })

    btnKeluar.addEventListener('click', function() {
        Swal.fire({
            title: 'Yakin?',
            text: "Waktu akan terus berjalan !",
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
                window.location.href = `/ruang-ujian`
            }
        });
    })

    function setWaktu() {
        var sisa_waktu = "{!! $data['sisa_waktu'] !!}";
        var sisaWaktu = sisa_waktu
        var countdownElement = document.querySelector('#timer');
        var countdown = setInterval(function() {
            var jam = Math.floor(sisaWaktu / (1000 * 60 * 60));
            var menit = Math.floor((sisaWaktu % (1000 * 60 * 60)) / (1000 * 60));
            var detik = Math.floor((sisaWaktu % (1000 * 60)) / 1000);

            let showJam = jam;
            let showDetik = detik;
            let showMenit = menit;
            if (jam < 10) showJam = "0" + jam;
            if (detik < 10) showDetik = "0" + detik;
            if (menit < 10) showMenit = "0" + menit;

            countdownElement.innerHTML = showJam + ":" + showMenit + ":" + showDetik;

            // Mengurangi sisa waktu setiap detik
            sisaWaktu -= 1000;

            // Menghentikan countdown jika waktu sudah habis
            if (sisaWaktu < 0) {
                clearInterval(countdown);
                countdownElement.innerHTML = "Waktu sudah habis!";
                var res = dxAjax(`/try-out/submit`, {
                    id_ruang: id_ruang_ujian
                }, 'GET')
                if (res.status == 200) {
                    window.location.href = `/ruang-ujian`
                }
            }
        }, 1000);
    }
</script>
