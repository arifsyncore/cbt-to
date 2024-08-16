@extends('layouts.main')

@section('title', 'Bank Soal')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card mb-6">
                <h5 class="card-header">{{ $title }} Soal {{ $jenis->nama }}</h5>
                <div class="card-body">
                    <form id="form-soal" onsubmit="return false" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="action" id="action" value="{{ $action }}">
                        <input type="hidden" name="id_jenis" id="id_jenis" value="{{ $jenis->id }}">
                        <input type="hidden" name="id_bank" id="id_bank" value="{{ $bank_soal->id }}">
                        <input type="hidden" name="id" id="id"
                            value="{{ $action == 'edit' ? $data->id : '' }}">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating form-floating-outline mb-6 input-soal">
                                    <textarea class="form-control h-px-100" name="soal" id="soal" placeholder="Masukkan Soal">{{ $action == 'edit' ? $data->soal : '' }}</textarea>
                                    <label for="soal">Soal</label>
                                </div>
                            </div>
                            <div class="divider divider-primary">
                                <div class="divider-text">Jawaban</div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-floating form-floating-outline mb-6 input-soal">
                                            <textarea class="form-control h-px-100" name="opsi_a" id="opsi_a" placeholder="Masukkan Jawaban A">{{ $action == 'edit' ? $data->opsi_a : '' }}</textarea>
                                            <label for="opsi_a">Jawaban A</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-floating form-floating-outline mb-6 input-soal">
                                            <textarea class="form-control h-px-100" name="opsi_b" id="opsi_b" placeholder="Masukkan Jawaban B">{{ $action == 'edit' ? $data->opsi_b : '' }}</textarea>
                                            <label for="opsi_b">Jawaban B</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-floating form-floating-outline mb-6 input-soal">
                                            <textarea class="form-control h-px-100" name="opsi_c" id="opsi_c" placeholder="Masukkan Jawaban C">{{ $action == 'edit' ? $data->opsi_c : '' }}</textarea>
                                            <label for="opsi_c">Jawaban C</label>
                                        </div>
                                    </div>
                                    @if ($bank_soal->jml_opsi_jwb == 4)
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-6 input-soal">
                                                <textarea class="form-control h-px-100" name="opsi_d" id="opsi_d" placeholder="Masukkan Jawaban D">{{ $action == 'edit' ? $data->opsi_d : '' }}</textarea>
                                                <label for="opsi_d">Jawaban D</label>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($bank_soal->jml_opsi_jwb == 5)
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-6 input-soal">
                                                <textarea class="form-control h-px-100" name="opsi_d" id="opsi_d" placeholder="Masukkan Jawaban D">{{ $action == 'edit' ? $data->opsi_d : '' }}</textarea>
                                                <label for="opsi_d">Jawaban D</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-6 input-soal">
                                                <textarea class="form-control h-px-100" name="opsi_e" id="opsi_e" placeholder="Masukkan Jawaban E">{{ $action == 'edit' ? $data->opsi_e : '' }}</textarea>
                                                <label for="opsi_e">Jawaban E</label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="divider divider-primary">
                                <div class="divider-text">Jawaban Benar</div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-floating form-floating-outline mb-6 input-soal">
                                    <select class="form-select" id="jawaban" name="jawaban"
                                        aria-label="Default select example">
                                        <option value="">Pilih Jawaban</option>
                                        <option
                                            value="A"{{ $action == 'edit' ? ($data->jawaban == 'A' ? 'selected' : '') : '' }}>
                                            A
                                        </option>
                                        <option
                                            value="B"{{ $action == 'edit' ? ($data->jawaban == 'B' ? 'selected' : '') : '' }}>
                                            B</option>
                                        <option
                                            value="C"{{ $action == 'edit' ? ($data->jawaban == 'C' ? 'selected' : '') : '' }}>
                                            C</option>
                                        @if ($bank_soal->jml_opsi_jwb == 4)
                                            <option
                                                value="D"{{ $action == 'edit' ? ($data->jawaban == 'D' ? 'selected' : '') : '' }}>
                                                D</option>
                                        @endif
                                        @if ($bank_soal->jml_opsi_jwb == 5)
                                            <option
                                                value="D"{{ $action == 'edit' ? ($data->jawaban == 'D' ? 'selected' : '') : '' }}>
                                                D</option>
                                            <option
                                                value="E"{{ $action == 'edit' ? ($data->jawaban == 'E' ? 'selected' : '') : '' }}>
                                                E</option>
                                        @endif
                                    </select>
                                    <label for="jawaban">Jawaban</label>
                                </div>
                            </div>
                        </div>
                        <div class="divider divider-primary">
                            <div class="divider-text">Pembahasan</div>
                        </div>
                        <div class="row mb-6">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating form-floating-outline mb-6 input-soal">
                                    <textarea class="form-control h-px-100" name="text_pembahasan" id="text_pembahasan"
                                        placeholder="Masukkan Pembahasan">{{ $action == 'edit' ? $data->pembahasan->pembahasan : 'N/A' }}</textarea>
                                    <label for="soal">Deskripsi Pembahasan</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-6 input-soal">
                                <label for="formFile" class="form-label">Insert Gambar</label>
                                <input type="file" class="form-control formFile" id="gambar" name="gambar"
                                    value="">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating form-floating-outline mb-6 input-soal">
                                    <input type="text" class="form-control" id="url_video" name="url_video"
                                        placeholder="Nama"
                                        value="{{ $action == 'edit' ? $data->pembahasan->url_video : '' }}" />
                                    <label for="floatingInput">Insert Url Video</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-outline-secondary waves-effect btn-kembali"
                                data-id="{{ $bank_soal->id }}">
                                Kembali
                            </button>
                            @if ($action == 'edit')
                                <button type="submit" class="btn btn-warning waves-effect waves-light">Simpan</button>
                            @else
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.bank-soal.js.form-soal-benar-salah')
@endsection
{{-- <div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel4">{{ $title }} Data Soal</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="form-soal" onsubmit="return false">
        @csrf
        <input type="hidden" name="action" id="action" value="{{ $action }}">
        <input type="hidden" name="id_bank" id="id_bank" value="{{ $bank_soal->id }}">
        <input type="hidden" name="id" id="id" value="{{ $action == 'edit' ? $data->id : '' }}">
        <div class="row">
            <div class="col-4 col-md-4 col-sm-12">
                <div class="form-floating form-floating-outline mb-6 input-soal">
                    <select class="form-select" id="jenis_soal" name="jenis_soal" aria-label="Default select example">
                        <option value="">Jenis Soal</option>
                        @foreach ($bank_soal->jenis->detail as $jenis)
                            <option value="{{ $jenis->id }}"
                                {{ $action == 'edit' ? ($data->id_jenis_det == $jenis->id ? 'selected' : '') : '' }}>
                                {{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                    <label for="exampleFormControlSelect1">Jenis Soal</label>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-floating form-floating-outline mb-6 input-soal">
                    <textarea class="form-control h-px-100" name="soal" id="soal" placeholder="Masukkan Soal">{{ $action == 'edit' ? $data->soal : '' }}</textarea>
                    <label for="soal">Soal</label>
                </div>
            </div>
            <div class="divider divider-primary">
                <div class="divider-text">Jawaban</div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-floating form-floating-outline mb-6 input-soal">
                            <textarea class="form-control h-px-100" name="opsi_a" id="opsi_a" placeholder="Masukkan Jawaban A">{{ $action == 'edit' ? $data->opsi_a : '' }}</textarea>
                            <label for="opsi_a">Jawaban A</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-floating form-floating-outline mb-6 input-soal">
                            <textarea class="form-control h-px-100" name="opsi_b" id="opsi_b" placeholder="Masukkan Jawaban B">{{ $action == 'edit' ? $data->opsi_b : '' }}</textarea>
                            <label for="opsi_b">Jawaban B</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-floating form-floating-outline mb-6 input-soal">
                            <textarea class="form-control h-px-100" name="opsi_c" id="opsi_c" placeholder="Masukkan Jawaban C">{{ $action == 'edit' ? $data->opsi_c : '' }}</textarea>
                            <label for="opsi_c">Jawaban C</label>
                        </div>
                    </div>
                    @if ($bank_soal->jml_opsi_jwb == 4)
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-floating form-floating-outline mb-6 input-soal">
                                <textarea class="form-control h-px-100" name="opsi_d" id="opsi_d" placeholder="Masukkan Jawaban D">{{ $action == 'edit' ? $data->opsi_d : '' }}</textarea>
                                <label for="opsi_d">Jawaban D</label>
                            </div>
                        </div>
                    @endif

                    @if ($bank_soal->jml_opsi_jwb == 5)
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-floating form-floating-outline mb-6 input-soal">
                                <textarea class="form-control h-px-100" name="opsi_d" id="opsi_d" placeholder="Masukkan Jawaban D">{{ $action == 'edit' ? $data->opsi_d : '' }}</textarea>
                                <label for="opsi_d">Jawaban D</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-floating form-floating-outline mb-6 input-soal">
                                <textarea class="form-control h-px-100" name="opsi_e" id="opsi_e" placeholder="Masukkan Jawaban E">{{ $action == 'edit' ? $data->opsi_e : '' }}</textarea>
                                <label for="opsi_e">Jawaban E</label>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="divider divider-primary">
                <div class="divider-text">Jawaban Benar</div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="form-floating form-floating-outline mb-6 input-soal">
                    <select class="form-select" id="jawaban" name="jawaban" aria-label="Default select example">
                        <option value="">Pilih Jawaban</option>
                        <option value="A"{{ $action == 'edit' ? ($data->jawaban == 'A' ? 'selected' : '') : '' }}>
                            A
                        </option>
                        <option value="B"{{ $action == 'edit' ? ($data->jawaban == 'B' ? 'selected' : '') : '' }}>
                            B</option>
                        <option value="C"{{ $action == 'edit' ? ($data->jawaban == 'C' ? 'selected' : '') : '' }}>
                            C</option>
                        @if ($bank_soal->jml_opsi_jwb == 4)
                            <option
                                value="D"{{ $action == 'edit' ? ($data->jawaban == 'D' ? 'selected' : '') : '' }}>
                                D</option>
                        @endif
                        @if ($bank_soal->jml_opsi_jwb == 5)
                            <option
                                value="D"{{ $action == 'edit' ? ($data->jawaban == 'D' ? 'selected' : '') : '' }}>
                                D</option>
                            <option
                                value="E"{{ $action == 'edit' ? ($data->jawaban == 'E' ? 'selected' : '') : '' }}>
                                E</option>
                        @endif
                    </select>
                    <label for="jawaban">Jawaban</label>
                </div>
            </div>
        </div>
        <hr>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
                Batal
            </button>
            @if ($action == 'edit')
                <button type="submit" class="btn btn-warning waves-effect waves-light">Simpan</button>
            @else
                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
            @endif
        </div>
    </form>
</div> --}}
