{{-- <p class="card-title mb-4">{{ $soalArr['no'] }} - {{ $soalArr['soal'] }}</p> --}}
<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                @if ($soalArr['type_jenis'] == 'benar_salah')
                    @if ($soalArr['jawaban'] == $soalArr['jawaban_benar'])
                        <span class="badge rounded-pill bg-label-success">Benar</span>
                    @else
                        <span class="badge rounded-pill bg-label-danger">Salah</span>
                    @endif
                @else
                    <span class="badge rounded-pill bg-label-primary">Nilai : {{ $soalArr['nilai_jawaban'] }}</span>
                @endif
            </div>
            <div class="card-body">
                <p class="card-title mb-4"><strong>{{ $soalArr['no'] }} .</strong>{{ $soalArr['soal'] }}</p>
                <ul class="list-group list-group-flush mb-4">
                    @foreach ($soalArr['opsi'] as $opsi)
                        <li
                            class="list-group-item {{ $soalArr['type_jenis'] == 'benar_salah' ? ($soalArr['jawaban'] == $opsi['value'] ? 'list-group-item-success' : '') : '' }}">
                            <strong>{{ $opsi['value'] }} .</strong>{{ $opsi['opsi'] }}
                        </li>
                    @endforeach
                </ul>
                <p class="card-title mb-4"><strong>Jawaban: {{ $soalArr['jawaban'] }}</strong></p>
                <div class="divider divider-primary">
                    <div class="divider-text">Pembahasan</div>
                </div>
                <p class="card-text">{{ $soalArr['deskripsi'] }}</p>
                @if ($soalArr['gambar'] != '')
                    <div class="bg-label-primary rounded-3 text-center mb-3">
                        <img class="img-fluid rounded" src="{{ asset('/' . $soalArr['gambar']) }}" alt="">
                    </div>
                @endif
                <div class="embed-responsive embed-responsive-16by9 mb-6">
                    @if ($soalArr['url_video'] != '' || $soalArr['url_video'] != null)
                        <x-embed url="{{ $soalArr['url_video'] }}" aspect-ratio="4:3" />
                    @endif
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button"
                        class="btn rounded-pill btn-icon btn-primary btn-fab demo waves-effect waves-light btn-kembali"
                        data-no="{{ $soalArr['no'] - 1 }}" data-id="{{ $soalArr['id'] }}"
                        {{ $soalArr['no'] == 1 ? 'disabled' : '' }}>
                        <span class="tf-icons ri-arrow-left-fill ri-22px"></span>
                    </button>
                    <button type="button"
                        class="btn rounded-pill btn-icon btn-primary btn-fab demo waves-effect waves-light btn-lanjut"
                        {{ $soalArr['no'] == $maxNo ? 'disabled' : '' }} data-no="{{ $soalArr['no'] + 1 }}"
                        data-id="{{ $soalArr['id'] }}">
                        <span class="tf-icons ri-arrow-right-fill ri-22px"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
