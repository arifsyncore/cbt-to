@extends('layouts.main')

@section('title', 'Peringkat')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card mb-6">
                <h5 class="card-header">
                    Peringkat Ujian / {{ $soal->soalto->soal->kode }} -
                    {{ $soal->soalto->soal->nama_soal }}
                </h5>
            </div>
        </div>
    </div>
    @foreach ($soal->soalto->soal->jenis->detail as $jenisDet)
        <div class="row">
            <div class="col-md">
                <div class="card mb-6">
                    <h5 class="card-header">
                        {{ $jenisDet->nama }}
                    </h5>
                    <div class="card-body">
                        <table class="table-rangking-{{ $jenisDet->nama }} table table-bordered">
                            <thead>
                                <tr>
                                    <th>Rangking</th>
                                    <th>Nama</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('js')
    @include('user.peringkat.js.detail-soal')
@endsection
