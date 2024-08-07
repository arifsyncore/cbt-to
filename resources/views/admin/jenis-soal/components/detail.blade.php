<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel4">Detail</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <table class="table table-bordered mb-2">
        <col style="width: 20%">
        <col style="width: 80%">
        <tbody>
            <tr>
                <td>Kode</td>
                <td>{{ $data->kode }}</td>
            </tr>
            <tr>
                <td>Jenis Soal</td>
                <td>{{ $data->jenis }}</td>
            </tr>
            <tr>
                <td>Jumlah Total Soal</td>
                <td>{{ round($data->detail_sum_jml_soal) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="divider mb-2">
        <div class="divider-text">Detail Jenis Soal</div>
    </div>
    <table class="table table-bordered">
        <col style="width: 60%">
        <col style="width: 20%">
        <col style="width: 20%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Bobot Soal</th>
                <th>Jumlah Soal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->detail as $det)
                <tr>
                    <td>{{ $det->nama }}</td>
                    <td>{{ round($det->bobot_soal) }}</td>
                    <td>{{ round($det->jml_soal) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
