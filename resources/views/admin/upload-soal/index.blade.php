@extends('layouts.main')

@section('title', 'Upload Soal')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="table-upload-soal table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Soal</th>
                        <th>Nama Soal</th>
                        <th>Tanggal Berlaku</th>
                        <th>Jenis Pengerjaan</th>
                        <th>Tipe Soal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.upload-soal.js.app')
@endsection
