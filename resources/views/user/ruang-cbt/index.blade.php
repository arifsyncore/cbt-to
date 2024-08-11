@extends('user.ruang-cbt.layouts.main')

@section('title', 'Ruang Ujian')

@section('content')
    <section class="section-py bg-body first-section-pt mt-6">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-text">{{ $data['nama_soal'] }}</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="badge rounded-pill bg-primary" id="timer">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-9 col-md-9 col-xl-9 col-sm-12">
                    <div class="card mb-6">
                        <div class="card-body">
                            <div id="field_soal"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-md-3 col-xl-3 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Nomor Soal</h5>
                        </div>
                        <div class="card-body">
                            <div id="field_tab"></div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <button type="button"
                                    class="btn rounded-pill btn-primary waves-effect waves-light btn-submit">
                                    <span class="tf-icons ri-save-line ri-16px me-2"></span>Submit
                                </button>
                                <button type="button"
                                    class="btn rounded-pill btn-danger waves-effect waves-light btn-keluar">
                                    <span class="tf-icons ri-close-circle-line ri-16px me-2"></span>Keluar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    @include('user.ruang-cbt.js.app')
@endsection
