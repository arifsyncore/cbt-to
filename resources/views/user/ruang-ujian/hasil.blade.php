@extends('layouts.main')

@section('title', 'Ruang Ujian')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card mb-6">
                <h5 class="card-header">Detail Ujian / {{ $data->nomor_ujian }}</h5>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center flex-wrap">
                                                <div class="avatar me-4">
                                                    <div class="avatar-initial bg-label-primary rounded-3">
                                                        <i class="ri-list-check-3 ri-24px"></i>
                                                    </div>
                                                </div>
                                                <div class="card-info">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 me-2">
                                                            {{ round($data->soalto->soal->jenis->detail->sum('jml_soal')) }}
                                                        </h5>
                                                    </div>
                                                    <p class="mb-0">Total Soal</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center flex-wrap">
                                                <div class="avatar me-4">
                                                    <div class="avatar-initial bg-label-primary rounded-3">
                                                        <i class="ri-time-line ri-24px"></i>
                                                    </div>
                                                </div>
                                                <div class="card-info">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 me-2">
                                                            {{ round($data->soalto->durasi) }} Menit</h5>
                                                    </div>
                                                    <p class="mb-0">Durasi</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center flex-wrap">
                                                <div class="avatar me-4">
                                                    <div class="avatar-initial bg-label-primary rounded-3">
                                                        <i class="ri-pages-line ri-24px"></i>
                                                    </div>
                                                </div>
                                                <div class="card-info">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 me-2">
                                                            {{ $data->soalto->soal->jenis->detail->count() }}</h5>
                                                    </div>
                                                    <p class="mb-0">Total Jenis Soal</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h3 class="card-title text-white text-center">{{ $jmlBenar }}</h3>
                                    <p class="card-text text-center">Nilai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="demo-inline-spacing">
                                @foreach ($data->soalto->soal->jenis->detail as $det)
                                    <button type="button" class="btn btn-primary waves-effect waves-light btn-tab"
                                        data-id="{{ $det->id }}">{{ $det->nama }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <div id="field-content">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Pilih Jenis Soal</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('user.ruang-ujian.js.hasil')
@endsection
