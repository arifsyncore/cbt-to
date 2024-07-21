@extends('layouts.main')

@section('title', 'Bank Soal')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card mb-6">
                <h5 class="card-header">{{ $title }} Bank Soal</h5>
                <form action="{{ url('/') }}" method="POST" id="form-bank-soal">
                    @csrf
                    <input type="hidden" id="action" name="action" value="{{ $action }}">
                    <input type="hidden" id="id" name="id" value="{{ $action == 'edit' ? $data->id : '' }}">
                    <input type="hidden" id="id_jadwal" name="id_jadwal"
                        value="{{ $action == 'edit' ? $data->jadwal->id : '' }}">
                    <div class="card-body">
                        <div class="divider divider-primary">
                            <div class="divider-text">Bank Soal</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4 col-md-4 col-sm-12 mb-4">
                                <div class="bank-soal form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        placeholder="Kode" value="{{ $action == 'edit' ? $data->kode : '' }}" />
                                    <label for="floatingInput">Kode</label>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="bank-soal form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama" value="{{ $action == 'edit' ? $data->nama_soal : '' }}" />
                                    <label for="floatingInput">Nama</label>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="bank-soal form-floating form-floating-outline">
                                    <select id="selectpickerBasic" class="selectpicker w-100" name="jenis_soal"
                                        data-style="btn-default">
                                        <option value="">Jenis Soal</option>
                                        @foreach ($jenis_soals as $jenis)
                                            <option value="{{ $jenis->id }}"
                                                {{ $action == 'edit' ? ($data->id_jenis == $jenis->id ? 'selected' : '') : '' }}>
                                                {{ $jenis->jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="bank-soal form-floating form-floating-outline">
                                    <input type="number" class="form-control" id="jml_soal" name="jml_soal"
                                        placeholder="0" value="{{ $action == 'edit' ? round($data->jml_soal) : '' }}" />
                                    <label for="floatingInput">Jumlah Soal</label>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="bank-soal form-floating form-floating-outline">
                                    <input type="number" class="form-control" id="bobot_soal" name="bobot_soal"
                                        placeholder="0" value="{{ $action == 'edit' ? round($data->bobot_soal) : '' }}" />
                                    <label for="floatingInput">Bobot Soal</label>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="bank-soal form-floating form-floating-outline">
                                    <select id="selectpickerBasic" class="selectpicker w-100" name="opsi_jawab"
                                        data-style="btn-default">
                                        <option value="">Opsi Jawaban</option>
                                        <option value="3"
                                            {{ $action == 'edit' ? ($data->jml_opsi_jwb == 3 ? 'selected' : '') : '' }}>3
                                            (A, B, C)</option>
                                        <option value="4"
                                            {{ $action == 'edit' ? ($data->jml_opsi_jwb == 4 ? 'selected' : '') : '' }}>4
                                            (A, B, C, D)</option>
                                        <option value="5"
                                            {{ $action == 'edit' ? ($data->jml_opsi_jwb == 5 ? 'selected' : '') : '' }}>5
                                            (A, B, C, D, E)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="divider divider-primary">
                            <div class="divider-text">Jadwal</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4 col-md-4 col-sm-12 mb-4">
                                <div class="bank-soal form-floating form-floating-outline">
                                    <select id="selectpickerBasic" class="selectpicker w-100" name="tipe"
                                        data-style="btn-default">
                                        <option value="">Tipe Pengerjaan</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}"
                                                {{ $action == 'edit' ? ($data->jadwal->id_jenis == $type->id ? 'selected' : '') : '' }}>
                                                {{ $type->nama_jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="bank-soal form-floating form-floating-outline">
                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD HH:MM"
                                        id="tanggal_mulai" name="tanggal_mulai"
                                        value="{{ $action == 'edit' ? $data->jadwal->tanggal_mulai : '' }}" />
                                    <label for="flatpickr-datetime">Tanggal Mulai</label>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="bank-soal form-floating form-floating-outline">
                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD HH:MM"
                                        id="tanggal_selesai" name="tanggal_selesai"
                                        value="{{ $action == 'edit' ? $data->jadwal->tanggal_selesai : '' }}" />
                                    <label for="flatpickr-datetime">Tanggal Selesai</label>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="bank-soal form-floating form-floating-outline">
                                    <input type="number" class="form-control" id="durasi" name="durasi"
                                        placeholder="Nama"
                                        value="{{ $action == 'edit' ? round($data->jadwal->durasi) : '' }}" />
                                    <label for="floatingInput">Durasi (Menit)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-2 col-md-2 col-sm-6 mb-4">
                                <div
                                    class="bank-soal form-check custom-option custom-option-icon {{ $action == 'edit' ? ($data->jadwal->acak_soal == '1' ? 'checked' : '') : '' }}">
                                    <label class="form-check-label custom-option-content" for="acak_soal">
                                        <span class="custom-option-body">
                                            <i class="ri-shuffle-line"></i>
                                            <span class="custom-option-title mb-2"> Acak Soal </span>
                                            <small> Soal Akan diacak </small>
                                        </span>
                                        <input class="form-check-input" type="checkbox" value="1" id="acak_soal"
                                            name="acak_soal"
                                            {{ $action == 'edit' ? ($data->jadwal->acak_soal == '1' ? 'checked' : '') : '' }} />
                                    </label>
                                </div>
                            </div>
                            <div class="col-2 col-md-2 col-sm-6 mb-4">
                                <div
                                    class="bank-soal form-check custom-option custom-option-icon {{ $action == 'edit' ? ($data->jadwal->acak_opsi == '1' ? 'checked' : '') : '' }}">
                                    <label class="form-check-label custom-option-content" for="acak_opsi">
                                        <span class="custom-option-body">
                                            <i class="ri-shuffle-line"></i>
                                            <span class="custom-option-title mb-2"> Acak Jawaban </span>
                                            <small> Soal Akan diacak </small>
                                        </span>
                                        <input class="form-check-input" type="checkbox" value="1" id="acak_opsi"
                                            name="acak_opsi"
                                            {{ $action == 'edit' ? ($data->jadwal->acak_opsi == '1' ? 'checked' : '') : '' }} />
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Simpan</button>
                            <a href="{{ route('bank-soal') }}" type="reset"
                                class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    {{-- <script src="{{ asset('/assets/js/forms-pickers.js') }}"></script> --}}
    @include('admin.bank-soal.js.form')
@endsection
