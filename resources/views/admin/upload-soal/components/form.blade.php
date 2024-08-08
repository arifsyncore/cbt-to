@extends('layouts.main')

@section('title', 'Upload Soal')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card mb-6">
                <h5 class="card-header">{{ $title }} Upload Soal</h5>
                <form id="form-upload-soal">
                    @csrf
                    <input type="hidden" id="action" name="action" value="{{ $action }}">
                    <input type="hidden" id="id" name="id" value="{{ $action == 'edit' ? $data->id : '' }}">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6 col-md-6 col-sm-12 mb-4">
                                <div class="form-floating form-floating-outline upload-soal">
                                    <select id="soal" name="soal" class="soal-select form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="">Pilih Bank Soal</option>
                                        @foreach ($bank_soals as $soal)
                                            <option value="{{ $soal->id }}"
                                                {{ $action == 'edit' ? ($data->id_bank_soal == $soal->id ? 'selected' : '') : '' }}>
                                                {{ $soal->nama_soal }}</option>
                                        @endforeach
                                    </select>
                                    <label for="select2Basic">Bank Soal</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-12 col-md-12 col-sm-12 mb-4">
                                <div class="form-floating form-floating-outline upload-soal">
                                    <div class="form-floating form-floating-outline upload-soal">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama" value="{{ $action == 'edit' ? $data->nama : '' }}" />
                                        <label for="floatingInput">Nama</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-sm-12 mb-4">
                                <div class="form-floating form-floating-outline upload-soal">
                                    <select id="selectpickerBasic" class="selectpicker w-100" name="jenis"
                                        data-style="btn-default">
                                        <option value="">Tipe Soal</option>
                                        @foreach ($tipe_soals as $tipe)
                                            <option value="{{ $tipe->id }}"
                                                {{ $action == 'edit' ? ($data->id_jenis == $tipe->id ? 'selected' : '') : '' }}>
                                                {{ $tipe->nama_jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-sm-12 mb-4">
                                <div class="form-floating form-floating-outline upload-soal">
                                    <select id="selectpickerBasic" class="selectpicker w-100" name="tipe"
                                        data-style="btn-default">
                                        <option value="">Pilih Status</option>
                                        <option value="Free"
                                            {{ $action == 'edit' ? ($data->type_soal == 'Free' ? 'selected' : '') : '' }}>
                                            Gratis</option>
                                        <option value="Premium"
                                            {{ $action == 'edit' ? ($data->type_soal == 'Premium' ? 'selected' : '') : '' }}>
                                            Premium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12 mb-2">
                                <div class="form-floating form-floating-outline upload-soal">
                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD HH:MM"
                                        id="tanggal_mulai" name="tanggal_mulai"
                                        value="{{ $action == 'edit' ? $data->tanggal_mulai : '' }}" />
                                    <label for="flatpickr-datetime">Tanggal Mulai</label>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12 mb-2">
                                <div class="form-floating form-floating-outline upload-soal">
                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD HH:MM"
                                        id="tanggal_selesai" name="tanggal_selesai"
                                        value="{{ $action == 'edit' ? $data->tanggal_selesai : '' }}" />
                                    <label for="flatpickr-datetime">Tanggal Selesai</label>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="form-floating form-floating-outline upload-soal">
                                    <input type="number" class="form-control" id="durasi" name="durasi"
                                        placeholder="Durasi" value="{{ $action == 'edit' ? round($data->durasi) : '' }}" />
                                    <label for="floatingInput">Durasi (Menit)</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-end">
                            <button type="submit"
                                class="btn btn-primary data-submit me-sm-4 me-1 btn-submit">Simpan</button>
                            <a href="{{ route('upload-soal') }}" type="reset" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    @include('admin.upload-soal.js.form')
@endsection
