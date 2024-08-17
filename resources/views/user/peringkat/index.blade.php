@extends('layouts.main')

@section('title', 'Peringkat')

@section('content')
    <div class="card">
        <h5 class="card-header">Daftar Try-Out</h5>
        <div class="card-datatable table-responsive pt-0">
            <table class="table-ruang-ujian table table-bordered">
                <col style="width: 10%;">
                <col style="width: 80%;">
                <col style="width: 10%;">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Soal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @include('user.peringkat.js.app')
@endsection
