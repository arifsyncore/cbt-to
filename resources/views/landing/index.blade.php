@extends('landing.layouts.main')

@section('title', 'CBT Online')
@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/dashboard.css') }}" />
    @include('landing.css.app')
@endsection
@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">
        <section id="landingHero" class="section-py landing-hero position-relative">
            <img src="{{ asset('/assets/img/front-pages/backgrounds/hero-bg-light.png') }}" alt="hero background"
                class="position-absolute top-0 start-0 w-100 h-100 z-n1" data-speed="1"
                data-app-light-img="front-pages/backgrounds/hero-bg-light.png"
                data-app-dark-img="front-pages/backgrounds/hero-bg-dark.png" />
            <div class="container">
                <section id="hero" class="hero section">
                    <div id="hero-carousel" data-bs-interval="5000" class="container carousel carousel-fade"
                        data-bs-ride="carousel">
                        <div class="carousel-item active">
                            <div class="carousel-container">
                                <h2 class="animate__animated animate__fadeInDown">Try Out Online</h2>
                                <p class="animate__animated animate__fadeInUp">
                                    Kami membantu untuk berlatih dan mempersiapkan diri menghadapi segala macam ujian
                                </p>
                                <a href="{{ url('/register') }}"
                                    class="btn btn-primary waves-effect waves-light selengkapnya-kat">Daftar Sekarang</a>
                            </div>
                        </div>
                        @foreach ($jenis_soal as $jenis)
                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <h2 class="animate__animated animate__fadeInDown">{{ $jenis->jenis }}</h2>
                                    <p class="animate__animated animate__fadeInUp">
                                        Terdapat jenis soal
                                        @foreach ($jenis->detail as $det)
                                            {{ $det->nama }},
                                        @endforeach
                                    </p>
                                    <a href="javascript:void(0)"
                                        class="btn btn-primary waves-effect waves-light selengkapnya-kat"
                                        data-id="{{ $jenis->id }}">Selengkapnya</a>
                                </div>
                            </div>
                        @endforeach
                        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                        </a>
                    </div>
                </section>
            </div>
        </section>
        <section id="landingFeatures" class="section-py landing-features">
            <div class="container">
                <h6 class="text-center d-flex justify-content-center align-items-center mb-6">
                    <img src="{{ asset('/assets/img/front-pages/icons/section-tilte-icon.png') }}" alt="section title icon"
                        class="me-3" />
                    <span class="text-uppercase">Daftar Try-Out</span>
                </h6>
                <div class="row gy-lg-5 gy-12 mt-2 mb-6">
                    @foreach ($bank_soal as $soal)
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img class="card-img card-img-left" src="{{ asset('/assets/img/elements/12.jpg') }}"
                                            style="width: 100%;height:100%;" alt="Card image">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="card-title">{{ $soal->nama }}</h5>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span
                                                        class="badge rounded-pill bg-success">{{ $soal->type_soal }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start flex-column" style="height: 150px;">
                                                <p class="card-text">
                                                    <i class="ri-pages-line"></i> {{ $soal->soal->detail->count() }} Soal
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">
                                                        <i class="ri-calendar-line"></i>
                                                        {{ \Carbon\Carbon::parse($soal->tanggal_mulai)->translatedFormat('d F Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($soal->tanggal_selesai)->translatedFormat('d F Y') }}
                                                    </small>
                                                </p>
                                                <a href="javascript:void(0)" class="card-link mt-auto selengkapnya-to"
                                                    data-id="{{ $soal->id }}">Selengkapnya <span
                                                        class="tf-icon ri-arrow-right-line"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn rounded-pill btn-primary waves-effect waves-light">Lihat Semua
                        Try Out</button>
                </div>
            </div>
        </section>
    </div>
    {{-- <div class="row d-flex justify-content-center">
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
                                                        <h5 class="card-title">{{ $soal->nama }}</h5>
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
    </div> --}}
@endsection

@section('js')
    <script src="{{ asset('/assets/vendor/libs/swiper/swiper.js') }}"></script>
    @include('landing.js.app')
@endsection
