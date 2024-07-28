@extends('landing.layouts.main')

@section('title', 'CBT Online')
@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/dashboard.css') }}" />
@endsection
@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">
        <section id="landingHero" class="section-py landing-hero position-relative mb-6">
            <img src="../../assets/img/front-pages/backgrounds/hero-bg-light.png" alt="hero background"
                class="position-absolute top-0 start-0 w-100 h-100 z-n1" data-speed="1"
                data-app-light-img="front-pages/backgrounds/hero-bg-light.png"
                data-app-dark-img="front-pages/backgrounds/hero-bg-dark.png" />
            <div class="container">
                <div class="hero-text-box text-center">
                    <h3 class="text-primary hero-title fs-2">All in one sass application for your business</h3>
                    <h2 class="h6 mb-8">
                        No coding required to make customisations.<br />The live customiser has everything your marketing
                        need.
                    </h2>
                    <a href="#landingPricing" class="btn btn-lg btn-primary">Get early access</a>
                </div>
            </div>
        </section>
    </div>
    <hr>
    <div class="row d-flex justify-content-center">
        <div class="col-11">
            <div class="card mb-6">
                <div class="card-header header-elements">
                    <h5 class="mb-0 me-2">Try Out Terbaru</h5>
                    <div class="card-header-elements ms-auto">
                        <a href="#" class="fw-bold text-reset">
                            <small>Selengkapnya</small>
                        </a>
                        <span class="tf-icon ri-arrow-right-line"></span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="swiper" id="swiper-multiple-slides">
                            <div class="swiper-wrapper">
                                @foreach ($bank_soal as $soal)
                                    <div class="swiper-slide">
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="card-title">{{ $soal->soal->nama_soal }}</h5>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <span
                                                            class="badge rounded-pill bg-success">{{ $soal->type_soal }}</span>
                                                    </div>
                                                </div>
                                                <div class="card-subtitle mb-4">{{ $soal->soal->jenis->jenis }}</div>
                                                <ul class="list-group list-group-flush mb-3">
                                                    <li class="list-group-item">Tanggal Mulai :
                                                        {{ \Carbon\Carbon::parse($soal->tanggal_mulai)->translatedFormat('d F Y H:i:s') }}
                                                    </li>
                                                    <li class="list-group-item">Tanggal Selesai :
                                                        {{ \Carbon\Carbon::parse($soal->tanggal_selesai)->translatedFormat('d F Y H:i:s') }}
                                                    </li>
                                                </ul>
                                                <a href="javascript:void(0)" class="card-link selengkapnya-to"
                                                    data-id="{{ $soal->id }}">Selengkapnya <span
                                                        class="tf-icon ri-arrow-right-line"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next custom-icon"></div>
                            <div class="swiper-button-prev custom-icon"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script>
        const swiperMultipleSlides = document.querySelector('#swiper-multiple-slides')
        if (swiperMultipleSlides) {
            new Swiper(swiperMultipleSlides, {
                slidesPerView: 3,
                spaceBetween: 30,
                navigation: {
                    prevEl: '.swiper-button-prev',
                    nextEl: '.swiper-button-next'
                },
                pagination: {
                    clickable: true,
                    el: '.swiper-pagination'
                }
            });
        }

        const btnDetailTo = document.querySelectorAll('.selengkapnya-to')
        btnDetailTo.forEach(function(btn) {
            btn.addEventListener('click', function() {
                let id = this.dataset.id
                window.location.href = `/soal-to?id=${id}`
            })
        })
    </script>
@endsection
