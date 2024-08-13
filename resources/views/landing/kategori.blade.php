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
                    <h2>Kategori</h2>
                </div>
            </div>
        </section>
    </div>
    <hr>
    <div class="row d-flex justify-content-center">
        <div class="col-11">
            <div class="row">
                @foreach ($kategori as $kat)
                    <div class="col-sm-12 col-md-6 col-xl-4 col-4">
                        <div class="card mb-6">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title">{{ $kat->jenis }}</h5>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush mb-3">
                                    @foreach ($kat->detail as $det)
                                        <li class="list-group-item">
                                            {{ $det->nama }}
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="javascript:void(0)" class="card-link selengkapnya-kat"
                                    data-id="{{ $kat->id }}">Selengkapnya <span
                                        class="tf-icon ri-arrow-right-line"></span></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const btnDetailTo = document.querySelectorAll('.selengkapnya-kat')
        btnDetailTo.forEach(function(btn) {
            btn.addEventListener('click', function() {
                let id = this.dataset.id
                window.location.href = `/kategori/detail?id=${id}`
            })
        })
    </script>
@endsection
