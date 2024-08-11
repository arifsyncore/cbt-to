<div class="row">
    @foreach ($soal as $item)
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    @if ($item->jawaban == $item->soal->jawaban)
                        <span class="badge rounded-pill bg-label-success">Benar</span>
                    @else
                        <span class="badge rounded-pill bg-label-danger">Salah</span>
                    @endif
                </div>
                <div class="card-body">
                    <p class="card-title mb-4"><strong>{{ $item->no }} .</strong>{{ $item->soal->soal }}</p>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item {{ $item->soal->jawaban == 'A' ? 'list-group-item-success' : '' }}">
                            <strong>A .</strong>{{ $item->soal->opsi_a }}
                        </li>
                        <li class="list-group-item {{ $item->soal->jawaban == 'B' ? 'list-group-item-success' : '' }}">
                            <strong>B .</strong>{{ $item->soal->opsi_b }}
                        </li>
                        <li class="list-group-item {{ $item->soal->jawaban == 'C' ? 'list-group-item-success' : '' }}">
                            <strong>C .</strong>{{ $item->soal->opsi_c }}
                        </li>
                        @if (round($item->soal->banksoal->jml_opsi_jwb) == 4)
                            <li
                                class="list-group-item {{ $item->soal->jawaban == 'D' ? 'list-group-item-success' : '' }}">
                                <strong>D .</strong>{{ $item->soal->opsi_d }}
                            </li>
                        @endif
                        @if (round($item->soal->banksoal->jml_opsi_jwb) == 5)
                            <li
                                class="list-group-item {{ $item->soal->jawaban == 'D' ? 'list-group-item-success' : '' }}">
                                <strong>D .</strong>{{ $item->soal->opsi_d }}
                            </li>
                            <li
                                class="list-group-item {{ $item->soal->jawaban == 'E' ? 'list-group-item-success' : '' }}">
                                <strong>E .</strong>{{ $item->soal->opsi_e }}
                            </li>
                        @endif
                    </ul>
                    <p class="card-title"><strong>Jawaban: {{ $item->jawaban }}</strong></p>
                </div>
            </div>
        </div>
    @endforeach
</div>
