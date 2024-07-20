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

    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Formulir</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <div id="content-form"></div>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.jenis-soal.js.app')
@endsection
