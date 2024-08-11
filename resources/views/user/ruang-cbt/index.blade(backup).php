@extends('user.ruang-cbt.layouts.main')

@section('title', 'Ruang Ujian')

@section('content')
    <section class="section-py bg-body first-section-pt mt-6">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header header-elements">
                            <h5 class="mb-0 me-2">{{ $data['nama_soal'] }}</h5>
                            <div class="card-header-elements ms-auto">
                                <div class="fw-bold text-reset">
                                    <small id="timer"></small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="card mb-6">
                                        <div class="card-body" id="field_soal">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card mb-6">
                                        <div class="card-body">
                                            <div class="row mb-4" id="field_tab">

                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button"
                                                    class="btn rounded-pill btn-danger waves-effect waves-light"><span
                                                        class="tf-icons ri-close-circle-line ri-16px me-2"></span>Keluar</button>
                                                <button type="button"
                                                    class="btn rounded-pill btn-primary waves-effect waves-light"
                                                    onclick="submit()"><span
                                                        class="tf-icons ri-send-plane-fill ri-16px me-2"></span>Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        var id_soal_pertama = "{!! $data['id_soal'] !!}";
        var id_sesi = "{!! $data['id_sesi'] !!}";
        var id_ruang_ujian = "{!! $data['id_ruang_ujian'] !!}";
        var fieldsSoal = document.querySelector('#field_soal')
        var fieldsTab = document.querySelector('#field_tab')
        $(document).ready(function() {
            loadSoalPertama(id_soal_pertama, id_sesi, id_ruang_ujian)
        })

        function loadSoalPertama(id_soal, id_sesi, id_ruang_ujian) {
            var res = dxAjax(`/try-out/loadsoal`, {
                'id_soal': id_soal_pertama,
                'id_sesi': id_sesi,
                'id_ruang_ujian': id_ruang_ujian
            }, 'GET')
            if (res.status == 200) {
                fieldsSoal.innerHTML = res.data
                fieldsTab.innerHTML = res.data2
                loadsoal()
            } else {

            }
        }

        function loadsoal() {
            var radioJwb = document.querySelectorAll('.jawaban')
            var form = document.querySelector('#form-soal')
            radioJwb.forEach(radio => radio.addEventListener('change', function() {
                var no = radio.dataset.no
                var btn = document.querySelector(`#btn-tab${no}`)
                btn.classList.remove('btn-outline-primary')
                btn.classList.add('btn-primary')
            }))
            var btnRagu = document.querySelector('.btn-ragu')
            btnRagu.addEventListener('click', function() {
                if ($('.jawaban').is(':checked')) {
                    var id_soal = this.dataset.id
                    var res = dxAjax(`/try-out/tandaisoal`, $('#form-soal').serialize(), 'GET')
                    if (res.status == 200) {
                        loadSoalPertama(id_soal, id_sesi, id_ruang_ujian)
                    } else {

                    }
                } else {
                    Swal.fire({
                        title: 'Warning !',
                        text: 'Belum mengisi jawaban',
                        icon: 'warning',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                }
            })

            var btnLanjut = document.querySelector('.btn-lanjut')
            btnLanjut.addEventListener('click', function() {
                if ($('.jawaban').is(':checked')) {
                    var nomor = this.dataset.no
                    var res = dxAjax(`/try-out/lanjutsoal`, $('#form-soal').serialize(), 'GET')
                    if (res.status == 200) {
                        loadSoalSelanjutnya(nomor, id_sesi, id_ruang_ujian)
                    } else {

                    }
                } else {
                    Swal.fire({
                        title: 'Warning !',
                        text: 'Belum mengisi jawaban',
                        icon: 'warning',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                }
            })

        }

        function loadSoalSelanjutnya(no, id_sesi, id_ruang_ujian) {
            var res = dxAjax(`/try-out/loadsoalselanjutnya`, {
                'no': no,
                'id_sesi': id_sesi,
                'id_ruang_ujian': id_ruang_ujian
            }, 'GET')
            if (res.status == 200) {
                fieldsSoal.innerHTML = res.data
                fieldsTab.innerHTML = res.data2
                loadsoal()
            } else {

            }
        }

        setWaktu()

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
                    submitWaktuHabis()
                }
            }, 1000);
        }

        function submitWaktuHabis() {
            window.location.href = `/ruang-ujian`
        }

        function submit() {
            Swal.fire({
                title: 'Yakin?',
                text: "Jawaban yang sudah disubmit tidak dapat dikembalikan !",
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
        }
    </script>
@endsection
