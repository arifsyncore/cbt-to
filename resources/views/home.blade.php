@extends('layouts.main')

@section('title', 'Dashboard')
@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
@endsection
@section('content')
    @if (Auth::user()->role_id == 2)
        <div class="card bg-transparent shadow-none border-0 mb-6">
            <div class="card-body row g-6 p-0 pb-5">
                <div class="col-12 col-md-8 card-separator">
                    <h5 class="mb-2">Selamat Datang,<span class="h4 fw-semibold"> {{ Auth::user()->name }} 👋🏻</span></h5>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4" id="chart2"></div>
                        <table class="table-nilai table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode Ujian</th>
                                    <th>Nama Ujian</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif
@endsection

@section('js')
    @include('js.dashboard')
@endsection
