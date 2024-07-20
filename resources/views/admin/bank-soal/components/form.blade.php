@extends('layouts.main')

@section('title', 'Bank Soal')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card mb-6">
                <h5 class="card-header">{{ $title }} Bank Soal</h5>
                <form action="{{ url('/') }}" method="POST" id="form-bank-soal">
                    @csrf
                    <input type="hidden" id="action" name="action" value="{{ $action }}">
                    <input type="hidden" id="id" name="id" value="{{ $action == 'edit' ? $data->id : '' }}">
                    <div class="card-body">
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
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Simpan</button>
                            <a href="{{ route('bank-soal') }}" type="reset" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.bank-soal.js.form')
@endsection
