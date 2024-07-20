@extends('layouts.main')

@section('title', 'Manajemen User')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="table-user table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.manajemen-user.js.app')
@endsection
