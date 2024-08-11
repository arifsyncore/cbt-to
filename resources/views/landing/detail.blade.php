@extends('landing.layouts.main')

@section('title', 'CBT Online')
@section('css')

@endsection
@section('content')
    <section class="section-py bg-body first-section-pt">
        <div class="container">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img class="card-img card-img-left" src="{{ asset('/assets/img/gambar/image-01.jpg') }}"
                            alt="Card image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            @csrf
                            <h5 class="card-title">{{ $data->soal->nama_soal }}</h5>
                            <div class="card-subtitle mb-4">{{ $data->soal->jenis->jenis }}</div>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item">Tanggal Mulai :
                                    {{ \Carbon\Carbon::parse($data->tanggal_mulai)->translatedFormat('d F Y H:i:s') }}
                                </li>
                                <li class="list-group-item">Tanggal Selesai :
                                    {{ \Carbon\Carbon::parse($data->tanggal_selesai)->translatedFormat('d F Y H:i:s') }}
                                </li>
                                <li class="list-group-item">
                                    Jumlah Soal : <span class="badge bg-label-primary">{{ round($data->soal->jml_soal) }}
                                        Soal</span>
                                </li>
                                <li class="list-group-item">
                                    Durasi : <span class="badge bg-label-primary">{{ round($data->durasi) }}
                                        Menit</span>
                                </li>
                                <li class="list-group-item">
                                    @if ($data->type_soal == 'Free')
                                        Harga : <span class="badge bg-label-success">Free</span>
                                    @else
                                        Harga : <span class="badge bg-label-success">0</span>
                                    @endif
                                </li>
                            </ul>
                            <button type="button" data-id="{{ $data->id }}"
                                class="btn rounded-pill btn-primary waves-effect waves-light add-list">
                                <span class="tf-icons ri-add-circle-line ri-16px me-2"></span>Tambah Ke
                                Ruang Ujian
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        var btnAddList = document.querySelector('.add-list')
        btnAddList.addEventListener('click', function() {
            let id_soal = this.dataset.id
            Swal.fire({
                title: 'Yakin?',
                text: "Menambah ujian ini ke ruang ujian !",
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
                    window.location.href = `/soal-to/add?id=${id_soal}`
                }
            });
        })
    </script>
@endsection
