@extends('user.ruang-cbt.layouts.main')

@section('title', 'Ruang Ujian')

@section('content')
    <section class="section-py bg-body first-section-pt mt-6">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header header-elements">
                            <h5 class="mb-0 me-2">Nama Soal</h5>
                            <div class="card-header-elements ms-auto">
                                <div class="fw-bold text-reset">
                                    <small id="timer"></small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="navs-pills-no-1" role="tabpanel">
                                            <div class="card mb-6">
                                                <div class="card-body">
                                                    <h5 class="card-title">01. Lembaga keuangan bukan bank yang menjalankan
                                                        usahanya
                                                        di
                                                        bidang perlindungan seseorang atau perusahaan dari kerugian keuangan
                                                        yang
                                                        disebabkan oleh kerusakan atau pencurian aset dan kematian atau
                                                        kecelakaan
                                                        adalah</h5>
                                                    <ul class="list-group list-group-flush mb-6">
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input name="default-radio-1" class="form-check-input"
                                                                    type="radio" value="" id="defaultRadio1">
                                                                <label class="form-check-label" for="defaultRadio1">
                                                                    Pegadaian
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input name="default-radio-1" class="form-check-input"
                                                                    type="radio" value="" id="defaultRadio1">
                                                                <label class="form-check-label" for="defaultRadio1">
                                                                    Perusahaan
                                                                    Asuransi
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input name="default-radio-1" class="form-check-input"
                                                                    type="radio" value="" id="defaultRadio1">
                                                                <label class="form-check-label" for="defaultRadio1"> Bursa
                                                                    Efek
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input name="default-radio-1" class="form-check-input"
                                                                    type="radio" value="" id="defaultRadio1">
                                                                <label class="form-check-label" for="defaultRadio1"> Lembaga
                                                                    pinjaman Simpanan
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input name="default-radio-1" class="form-check-input"
                                                                    type="radio" value="" id="defaultRadio1">
                                                                <label class="form-check-label" for="defaultRadio1">
                                                                    Reksadana
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="d-flex justify-content-between">
                                                        <button type="button"
                                                            class="btn rounded-pill btn-primary waves-effect waves-light"><span
                                                                class="tf-icons ri-arrow-left-line ri-16px me-2"></span>Kembali</button>
                                                        <button type="button"
                                                            class="btn rounded-pill btn-warning waves-effect waves-light"><span
                                                                class="tf-icons ri-flag-line ri-16px me-2"></span>Tandai
                                                            Ragu</button>
                                                        <button type="button"
                                                            class="btn rounded-pill btn-primary waves-effect waves-light">Lanjut<span
                                                                class="tf-icons ri-arrow-right-line ri-16px me-2"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="navs-pills-no-2" role="tabpanel">
                                            <div class="card mb-6">
                                                <div class="card-body">
                                                    <h5 class="card-title">02. Lembaga keuangan bukan bank yang menjalankan
                                                        usahanya
                                                        di
                                                        bidang perlindungan seseorang atau perusahaan dari kerugian keuangan
                                                        yang
                                                        disebabkan oleh kerusakan atau pencurian aset dan kematian atau
                                                        kecelakaan
                                                        adalah</h5>
                                                    <ul class="list-group list-group-flush mb-6">
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input name="default-radio-2" class="form-check-input"
                                                                    type="radio" value="" id="defaultRadio1">
                                                                <label class="form-check-label" for="defaultRadio1">
                                                                    Pegadaian
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input name="default-radio-2" class="form-check-input"
                                                                    type="radio" value="" id="defaultRadio1">
                                                                <label class="form-check-label" for="defaultRadio1">
                                                                    Perusahaan
                                                                    Asuransi
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input name="default-radio-2" class="form-check-input"
                                                                    type="radio" value="" id="defaultRadio1">
                                                                <label class="form-check-label" for="defaultRadio1"> Bursa
                                                                    Efek
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input name="default-radio-2" class="form-check-input"
                                                                    type="radio" value="" id="defaultRadio1">
                                                                <label class="form-check-label" for="defaultRadio1">
                                                                    Lembaga
                                                                    pinjaman Simpanan
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input name="default-radio-2" class="form-check-input"
                                                                    type="radio" value="" id="defaultRadio1">
                                                                <label class="form-check-label" for="defaultRadio1">
                                                                    Reksadana
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="d-flex justify-content-between">
                                                        <button type="button"
                                                            class="btn rounded-pill btn-primary waves-effect waves-light"><span
                                                                class="tf-icons ri-arrow-left-line ri-16px me-2"></span>Kembali</button>
                                                        <button type="button"
                                                            class="btn rounded-pill btn-warning waves-effect waves-light"><span
                                                                class="tf-icons ri-flag-line ri-16px me-2"></span>Tandai
                                                            Ragu</button>
                                                        <button type="button"
                                                            class="btn rounded-pill btn-primary waves-effect waves-light">Lanjut<span
                                                                class="tf-icons ri-arrow-right-line ri-16px me-2"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card mb-6">
                                        <div class="card-body">
                                            <div class="row mb-4" role="tablist">
                                                {{-- <div class="col-2 d-flex justify-content-center mb-3">
                                                    <ul class="nav nav-pills mb-4" role="tablist">
                                                        <li class="nav-item">
                                                            <button type="button" class="nav-link active" role="tab"
                                                                data-bs-toggle="tab" data-bs-target="#navs-pills-no-1"
                                                                aria-controls="navs-pills-no-1" aria-selected="true">
                                                                Home
                                                            </button>
                                                        </li>
                                                        <li class="nav-item">
                                                            <button type="button" class="nav-link" role="tab"
                                                                data-bs-toggle="tab" data-bs-target="#navs-pills-no-2"
                                                                aria-controls="navs-pills-no-2" aria-selected="false">
                                                                Profile
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div> --}}
                                                <div class="col-2 d-flex justify-content-center mb-3">
                                                    <button type="button"
                                                        class="btn btn-icon btn-outline-primary waves-effect active"
                                                        role="tab" data-bs-toggle="tab"
                                                        data-bs-target="#navs-pills-no-1" aria-controls="navs-pills-no-1"
                                                        aria-selected="true">
                                                        1
                                                    </button>
                                                </div>
                                                <div class="col-2 d-flex justify-content-center mb-3">
                                                    <button type="button"
                                                        class="btn btn-icon btn-outline-primary waves-effect"
                                                        role="tab" data-bs-toggle="tab"
                                                        data-bs-target="#navs-pills-no-2" aria-controls="navs-pills-no-2"
                                                        aria-selected="true">
                                                        2
                                                    </button>
                                                </div>
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
        setWaktu()

        function setWaktu() {
            var sisa_waktu = "{!! $data['hasil'] !!}";
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
                }
            }, 1000);
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
