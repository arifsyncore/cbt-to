@extends('layouts.main')

@section('title', 'Jenis Soal')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="table-jenis table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-form" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modalForm"
        aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="content-form">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.jenis-soal.js.app')
@endsection
