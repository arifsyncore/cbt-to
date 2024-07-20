@extends('layouts.main')

@section('title', 'Bank Soal')
@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/quill/editor.css') }}" />
    <style>
        .ql-snow .ql-editor {
            min-height: 50px;
        }
    </style>
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
                                        </tr>
                                        <tr>
                                            <td>Nama Soal</td>
                                            <td>{{ $bank_soal->nama_soal }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="form-content">
                    </div>
                    <hr>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table-soal table table-bordered">
                            <col style="width: 5%;">
                            <col style="width: 40%;">
                            <col style="width: 40%;">
                            <col style="width: 10%;">
                            <col style="width: 5%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Soal</th>
                                    <th>Opsi</th>
                                    <th>Jawaban</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/quill/quill.js') }}"></script>
    {{-- <script src="{{ asset('/assets/js/forms-editors.js') }}"></script> --}}
    @include('admin.bank-soal.js.detail')
@endsection
