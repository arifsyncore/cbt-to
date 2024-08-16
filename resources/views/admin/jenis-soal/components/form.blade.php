@extends('layouts.main')

@section('title', 'Jenis Soal')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card mb-6">
                <h5 class="card-header">{{ $title }} Jenis Soal</h5>
                <form id="form-jenis-soal">
                    @csrf
                    <input type="hidden" id="action" name="action" value="{{ $action }}">
                    <input type="hidden" id="id" name="id" value="{{ $action == 'edit' ? $data->id : '' }}">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6 col-md-6 col-sm-12 mb-4">
                                <div class="jenis-soal form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        placeholder="Kode" value="{{ $action == 'edit' ? $data->kode : $kode }}" readonly />
                                    <label for="floatingInput">Kode</label>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-sm-12 mb-4">
                                <div class="jenis-soal form-floating form-floating-outline">
                                    <input type="text" id="jenis" class="form-control dt-full-name" name="jenis"
                                        placeholder="Jenis" value="{{ $action == 'edit' ? $data->jenis : '' }}" />
                                    <label for="basicFullname">Nama</label>
                                </div>
                            </div>
                        </div>
                        <div class="divider">
                            <div class="divider-text">Detail Jenis Soal</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 col-md-12 col-sm-12 mb-4">
                                <div class="form-repeater detail">
                                    <div data-repeater-list="group-a">
                                        @if ($action == 'edit')
                                            @foreach ($data->detail as $detail)
                                                <div data-repeater-item>
                                                    <div class="row">
                                                        <div class="mb-6 col-lg-4 col-xl-4 col-4 mb-0">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="text" id="form-repeater-1-1"
                                                                    class="form-control" name="nama"
                                                                    placeholder="Jenis Soal" value="{{ $detail->nama }}" />
                                                                <label for="form-repeater-1-1">Jenis Soal</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-6 col-lg-2 col-xl-2 col-2 mb-0">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="number" id="form-repeater-1-2"
                                                                    class="form-control" name="bobot"
                                                                    placeholder="Bobot Soal"
                                                                    value="{{ round($detail->bobot_soal) }}" />
                                                                <label for="form-repeater-1-2">Bobot Soal</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-6 col-lg-2 col-xl-2 col-2 mb-0">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="number" id="form-repeater-1-3"
                                                                    class="form-control" name="jml"
                                                                    placeholder="Jumlah Soal"
                                                                    value="{{ round($detail->jml_soal) }}" />
                                                                <label for="form-repeater-1-3">Jumlah Soal</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-6 col-lg-2 col-xl-2 col-2 mb-0">
                                                            <div class="form-floating form-floating-outline">
                                                                <select class="form-select" id="form-repeater-1-4"
                                                                    name="type_jenis" aria-label="Default select example">
                                                                    <option value="">Pilih Tipe Penilaian</option>
                                                                    <option value="benar_salah"
                                                                        {{ $detail->type_jenis == 'benar_salah' ? 'selected' : '' }}>
                                                                        Benar Salah</option>
                                                                    <option value="nilai_jawaban"
                                                                        {{ $detail->type_jenis == 'nilai_jawaban' ? 'selected' : '' }}>
                                                                        Nilai Jawaban</option>
                                                                </select>
                                                                <label for="exampleFormControlSelect1">Tipe
                                                                    Penilaian</label>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="mb-6 col-lg-2 col-xl-2 col-2 d-flex align-items-center mb-0">
                                                            <button type="button" class="btn btn-outline-danger btn-xl"
                                                                data-repeater-delete>
                                                                <i class="ri-close-line ri-24px me-1"></i>
                                                                <span class="align-middle">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0" />
                                                </div>
                                            @endforeach
                                        @else
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="mb-6 col-lg-4 col-xl-4 col-4 mb-0">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" id="form-repeater-1-1"
                                                                class="form-control" name="nama"
                                                                placeholder="Jenis Soal" />
                                                            <label for="form-repeater-1-1">Jenis Soal</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-6 col-lg-2 col-xl-2 col-2 mb-0">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="number" id="form-repeater-1-2"
                                                                class="form-control" name="bobot"
                                                                placeholder="Bobot Soal" />
                                                            <label for="form-repeater-1-2">Bobot Soal</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-6 col-lg-2 col-xl-2 col-2 mb-0">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="number" id="form-repeater-1-3"
                                                                class="form-control" name="jml"
                                                                placeholder="Jumlah Soal" />
                                                            <label for="form-repeater-1-3">Jumlah Soal</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-6 col-lg-2 col-xl-2 col-2 mb-0">
                                                        <div class="form-floating form-floating-outline">
                                                            <select class="form-select" id="form-repeater-1-4"
                                                                name="type_jenis" aria-label="Default select example">
                                                                <option value="">Pilih Tipe Penilaian</option>
                                                                <option value="benar_salah">Benar Salah</option>
                                                                <option value="nilai_jawaban">Nilai Jawaban</option>
                                                            </select>
                                                            <label for="exampleFormControlSelect1">Tipe Penilaian</label>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="mb-6 col-lg-2 col-xl-2 col-2 d-flex align-items-center mb-0">
                                                        <button type="button" class="btn btn-outline-danger btn-xl"
                                                            data-repeater-delete>
                                                            <i class="ri-close-line ri-24px me-1"></i>
                                                            <span class="align-middle">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <hr class="mt-0" />
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-0">
                                        <button type="button" class="btn btn-primary" data-repeater-create>
                                            <i class="ri-add-line me-1"></i>
                                            <span class="align-middle">Tambah</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-end">
                            <button type="submit"
                                class="btn btn-primary data-submit me-sm-4 me-1 btn-submit">Simpan</button>
                            <a href="{{ route('jenis-soal') }}" type="reset"
                                class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    @include('admin.jenis-soal.js.form')
@endsection
