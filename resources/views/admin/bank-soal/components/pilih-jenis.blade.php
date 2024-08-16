<div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel4">Pilih Jenis Soal</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <table class="table table-bordered">
        <col style="width: 60%">
        <col style="width: 20%">
        <col style="width: 20%">
        <thead>
            <tr>
                <th>Jenis</th>
                <th>Tipe Penilaian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenis->detail as $det)
                <tr>
                    <td>{{ $det->nama }}</td>
                    <td>
                        {{ $det->type_jenis == 'benar_salah' ? 'Benar Salah' : 'Nilai Jawaban' }}
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-primary waves-effect pilih-jenis"
                                data-id="{{ $det->id }}">
                                <span class="tf-icons ri-arrow-right-line ri-22px"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
