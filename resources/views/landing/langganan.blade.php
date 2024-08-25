@extends('landing.layouts.main')

@section('title', 'CBT Online')
@section('css')

@endsection
@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">
        <section id="landingHero" class="section-py landing-hero position-relative">
            <img src="{{ asset('/assets/img/front-pages/backgrounds/hero-bg-light.png') }}" alt="hero background"
                class="position-absolute top-0 start-0 w-100 h-100 z-n1" data-speed="1"
                data-app-light-img="front-pages/backgrounds/hero-bg-light.png"
                data-app-dark-img="front-pages/backgrounds/hero-bg-dark.png" />
            <div class="container">
                <div class="text-center">
                    <h2>Langganan</h2>
                </div>
            </div>
        </section>
    </div>
    <hr>
    <div class="row d-flex justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="pb-sm-12 pb-2 rounded-top">
                    <div class="container py-12">
                        <h4 class="text-center mb-2 mt-0 mt-md-4">Langganan</h4>
                        <p class="text-center mb-2">
                            Berlangganan untuk akses semua fitur premium di website ini.
                        </p>
                        <div class="pricing-plans row mx-4 gy-3 px-lg-12">
                            <!-- Standard -->
                            <div class="col-lg mb-lg-0 mb-3">
                                <div class="card border-primary border shadow-none">
                                    <div class="card-body position-relative pt-4">
                                        <div class="position-absolute end-0 me-6 top-0 mt-6">
                                            <span class="badge bg-label-primary rounded-pill">Popular</span>
                                        </div>
                                        <div class="my-5 pt-6 text-center">
                                            <img src="{{ asset('/assets/img/illustrations/pricing-standard.png') }}"
                                                alt="Standard Image" height="100">
                                        </div>
                                        <h4 class="card-title text-center text-capitalize mb-2">Premium</h4>
                                        <p class="text-center mb-5">Berlangganan untuk akses semua fitur premium di website
                                            ini.</p>
                                        <div class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <sup class="h6 pricing-currency mt-2 mb-0 me-1 text-body">Rp</sup>
                                                <h1 class="price-toggle price-yearly text-primary mb-0">100.000</h1>
                                            </div>
                                        </div>

                                        <ul class="list-group ps-6 my-5 pt-4">
                                            <li class="mb-4">Soal premium</li>
                                            <li class="mb-4">Peringkat hasil ujian per subtest</li>
                                            <li class="mb-4">Grafik nilai per subtest</li>
                                        </ul>
                                        <button
                                            class="btn btn-primary d-grid w-100 waves-effect waves-light btn-modal-langganan">Langganan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-langganan" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="modalForm" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Langganan Premium</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Berlangganan untuk akses semua fitur premium di website</p>
                    <table class="table table-bordered mb-2">
                        <tbody>
                            <tr>
                                <td>Harga</td>
                                <td>Rp 100.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary waves-effect waves-light btn-langganan">Langganan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const btnLangganan = document.querySelector('.btn-modal-langganan')
        btnLangganan.addEventListener('click', function() {
            var elModal = new bootstrap.Modal('#modal-langganan')
            elModal.show()
            langganan()
        })

        function langganan() {
            const btnLangganan = document.querySelector('.btn-langganan')
            btnLangganan.addEventListener('click', function() {
                window.location.href = `/langganan/daftar-langganan`
            })
        }
    </script>
@endsection
