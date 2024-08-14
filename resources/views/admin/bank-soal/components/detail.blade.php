@extends('layouts.main')

@section('title', 'Bank Soal')
@section('css')

@endsection
@section('content')
    <input type="hidden" name="bank_id" id="bank_id" value="{{ $bank_soal->id }}">
    <div class="row">
        <div class="col-md">
            <div class="card mb-6">
                <h5 class="card-header">Detail Soal</h5>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-8 col-md-8 col-sm-8 mb-4">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>Kode Soal</td>
                                            <td>{{ $bank_soal->kode }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Soal</td>
                                            <td>{{ $bank_soal->nama_soal }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Total Harus Dibuat</td>
                                            <td>{{ round($bank_soal->jenis->detail->sum('jml_soal')) }} Soal</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5>Jenis Soal</h5>
                                <table class="table table-bordered">
                                    <col style="width: 50%">
                                    <col style="width: 25%">
                                    <col style="width: 25%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jumlah Soal</th>
                                            <th>Jumlah Soal Dibuat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bank_soal->jenis->detail as $det)
                                            <tr>
                                                <td>{{ $det->nama }}</td>
                                                <td>{{ round($det->jml_soal) }}</td>
                                                <td>{{ round($det->soal->count()) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-4 col-md-4 col-sm-4 mb-4">
                            @if ($bank_soal->detail->count() >= $bank_soal->jenis->detail->sum('jml_soal'))
                                <div class="indikator">
                                    <div class="card bg-success text-white">
                                        <div class="card-header text-white text-center">Pembuatan Soal Selesai</div>
                                        <div class="card-body">
                                            <h3 class="card-title text-white text-center font-weight-bold">Selesai</h3>
                                            <p class="card-text text-center">Soal sudah cukup dan siap digunakan</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="indikator">
                                    <div class="card bg-danger text-white">
                                        <div class="card-header text-white text-center">Pembuatan Soal Belum Selesai</div>
                                        <div class="card-body">
                                            <h3 class="card-title text-white text-center font-weight-bold">Belum Selesai
                                            </h3>
                                            <p class="card-text text-center">Soal belum siap digunakan</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn btn-success waves-effect waves-light mx-1"
                            onclick="importSoal()">
                            <span class="tf-icons ri-upload-2-line ri-16px me-sm-2"></span>Import Soal
                        </button>
                        <button type="button" class="btn btn btn-primary waves-effect waves-light" onclick="formDetail()">
                            <span class="tf-icons ri-add-line ri-16px me-sm-2"></span>Tambah Soal
                        </button>
                    </div>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table-soal table table-bordered">
                            <col style="width: 40%;">
                            <col style="width: 40%;">
                            <col style="width: 5%;">
                            <col style="width: 5%;">
                            <col style="width: 10%;">
                            <thead>
                                <tr>
                                    <th>Soal</th>
                                    <th>Opsi</th>
                                    <th>Jawaban</th>
                                    <th>Jenis Soal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="form-detail-soal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div id="content-form">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="import-soal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel4">Import Soal</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-import" onsubmit="return false" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_bank_soal_import" id="id_bank_soal_import" value="{{ $bank_soal->id }}">
                    <div class="modal-body">
                        <div class="form-floating form-floating-outline import-soal mb-6">
                            <select class="form-select" id="jenis_soal_import" name="jenis_soal_import"
                                aria-label="Default select example">
                                <option value="">Jenis Soal</option>
                                @foreach ($bank_soal->jenis->detail as $jenis)
                                    <option value="{{ $jenis->id }}">
                                        {{ $jenis->nama }}</option>
                                @endforeach
                            </select>
                            <label for="exampleFormControlSelect1">Jenis Soal</label>
                        </div>
                        <div class="mb-4 import-soal">
                            <label for="formFile" class="form-label">File</label>
                            <input type="file" class="form-control formFile" id="formFile" name="file_import"
                                value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="button" class="btn btn-warning waves-effect btn-template"
                            onclick="downloadTemplate()">
                            Download Template
                        </button>
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-light btn-simpan-upload">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/quill/quill.js') }}"></script>

    @include('admin.bank-soal.js.detail')
@endsection
