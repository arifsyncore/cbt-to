@extends('layouts.main')

@section('title', 'Bank Soal')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="table-bank-soal table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Soal</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.bank-soal.js.app')
@endsection
