@extends('layouts.main')

@section('title', 'Detail Pesanan')

@section('content')
    @if ($data)
        <div class="card">
            <h5 class="card-header">Detail Langganan</h5>
            <div class="card-body">
                <table class="table table-bordered mb-2">
                    <tbody>
                        <tr>
                            <td>No.Langganan</td>
                            <td>{{ $data->no_pesanan }}</td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>{{ $data->user->name }}</td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td>{{ $data->user->email }}</td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>Rp 100.000</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                @if ($data->status == 'Belum Bayar')
                                    <span class="badge bg-label-warning">Silahkan melakukan pembayaran</span>
                                    <button type="button" data-id="{{ $data->id }}"
                                        class="btn btn-danger waves-effect waves-light btn-bayar" id="pay-button">Bayar
                                        Sekarang</button>
                                @else
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Pesanan</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_pesanan)->translatedFormat('d F Y H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Langganan Premium</h5>
                <p class="card-text">Berlangganan untuk akses semua fitur premium di website.</p>
                <a href="{{ route('langganan') }}" class="btn btn-primary waves-effect waves-light">Langganan</a>
            </div>
        </div>
    @endif
@endsection
@section('js')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        const btnBayar = document.querySelector('.btn-bayar')
        if (btnBayar) {
            btnBayar.addEventListener('click', function() {
                var id = btnBayar.dataset.id
                var res = dxAjax('/detail-pesanan/bayar', {
                    id: id
                }, 'GET')
                if (res.status == 200) {
                    bayar(res.data)
                }
            })

            function bayar(data) {
                snap.pay(data.token, {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result);
                        // window.location.href = `/bayar-berhasil?id=${data.id}`
                        window.location.href = '{{ route('bayar-berhasil', $data->id) }}'
                    },
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result);
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result);
                    }
                });
            }
        }
    </script>
@endsection
