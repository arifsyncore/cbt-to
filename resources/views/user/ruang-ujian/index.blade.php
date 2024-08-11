@extends('layouts.main')

@section('title', 'Ruang Ujian')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="table-bank-soal table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Soal</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status Pengerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @include('user.ruang-ujian.js.app')
@endsection
