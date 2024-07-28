@extends('layouts.main')

@section('title', 'Ruang Ujian')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card mb-6">
                <h5 class="card-header">Detail Ujian</h5>
                <div class="card-body">
                    <h5 class="card-title">{{ $data->soalto->soal->nama_soal }}</h5>
                    <div class="card-subtitle mb-4">{{ $data->soalto->soal->jenis->jenis }}</div>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">Tanggal Mulai :
                            {{ \Carbon\Carbon::parse($data->soalto->tanggal_mulai)->translatedFormat('d F Y H:i:s') }}
                        </li>
                        <li class="list-group-item">Tanggal Selesai :
                            {{ \Carbon\Carbon::parse($data->soalto->tanggal_selesai)->translatedFormat('d F Y H:i:s') }}
                        </li>
                        <li class="list-group-item">
                            Jumlah Soal : <span class="badge bg-label-primary">{{ round($data->soalto->soal->jml_soal) }}
                                Soal</span>
                        </li>
                        <li class="list-group-item">
                            Durasi : <span class="badge bg-label-primary">{{ round($data->soalto->durasi) }}
                                Menit</span>
                        </li>
                    </ul>
                    <button type="button" data-id="{{ $data->id }}"
                        class="btn rounded-pill btn-success waves-effect waves-light add-list">
                        <span class="tf-icons ri-door-open-fill ri-16px me-2"></span>Kerjakan Soal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
