@extends('layouts.main')

@section('title', 'Jadwal')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="table-jadwal table table-bordered">
                <thead>
                    <tr>
                        <th>Soal</th>
                        <th>Jenis</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Durasi</th>
                        <th>Tipe</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.jadwal.js.app')
@endsection
