@extends('layouts.main')

@section('title', 'Ruang Ujian')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card mb-6">
                <h5 class="card-header">Detail Ujian / {{ $data->nomor_ujian }}</h5>
                <div class="card-body">
                    <h5 class="card-title">{{ $data->soalto->nama }}</h5>
                    <div class="card-subtitle mb-4">{{ $data->soalto->soal->jenis->jenis }}</div>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">Tanggal Mulai :
                            {{ \Carbon\Carbon::parse($data->soalto->tanggal_mulai)->translatedFormat('d F Y H:i:s') }}
                        </li>
                        <li class="list-group-item">Tanggal Selesai :
                            {{ \Carbon\Carbon::parse($data->soalto->tanggal_selesai)->translatedFormat('d F Y H:i:s') }}
                        </li>
                        <li class="list-group-item">
                            Durasi : <span class="badge bg-label-primary">{{ round($data->soalto->durasi) }}
                                Menit</span>
                        </li>
                        <li class="list-group-item">
                            Jumlah Soal : <span
                                class="badge bg-label-primary">{{ round($data->soalto->soal->jenis->detail->sum('jml_soal')) }}
                                Soal</span>
                        </li>
                        <li class="list-group-item">
                            Status :
                            @if ($data->status == 'Belum Dikerjakan')
                                <span class="badge rounded-pill bg-label-primary">{{ $data->status }}</span>
                            @endif
                            @if ($data->status == 'Sedang Dikerjakan')
                                <span class="badge rounded-pill bg-label-warning">{{ $data->status }}</span>
                            @endif
                            @if ($data->status == 'Selesai')
                                <span class="badge rounded-pill bg-label-success">{{ $data->status }}</span>
                            @endif
                        </li>
                    </ul>
                    <div class="card-subtitle mb-4">Detail Soal</div>
                    <table class="table table-bordered w-25 mb-4">
                        <tbody>
                            @foreach ($data->soalto->soal->jenis->detail as $det)
                                <tr>
                                    <td>{{ $det->nama }}</td>
                                    <td>{{ round($det->jml_soal) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" data-id="{{ $data->id }}"
                        class="btn rounded-pill btn-success waves-effect waves-light kerjakan-soal"
                        {{ $data->status == 'Selesai' ? 'disabled' : '' }}>
                        <span class="tf-icons ri-door-open-fill ri-16px me-2"></span>Kerjakan Soal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('user.ruang-ujian.js.detail')
@endsection
