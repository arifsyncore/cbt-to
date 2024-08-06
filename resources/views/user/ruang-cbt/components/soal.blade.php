<h5 class="card-title"><span id="no">{{ $data['no'] }}</span> .
    {{ $data['soal'] }} :
</h5>
<form id="form-soal">
    <ul class="list-group list-group-flush mb-6">
        @foreach ($data['opsi_jawaban'] as $opsi)
            <li class="list-group-item">
                <div class="form-check">
                    <input name="opsi" class="form-check-input jawaban" type="radio" value="{{ $opsi['value'] }}"
                        id="defaultRadio{{ $opsi['value'] }}" data-no="{{ $data['no'] }}"
                        {{ $data['jawaban'] == $opsi['value'] ? 'checked' : '' }}>
                    <label class="form-check-label" for="defaultRadio{{ $opsi['value'] }}">
                        {{ $opsi['opsi'] }}
                    </label>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="d-flex justify-content-between">
        <button type="button" class="btn rounded-pill btn-primary waves-effect waves-light"><span
                class="tf-icons ri-arrow-left-line ri-16px me-2"></span>Kembali</button>
        <button type="button" class="btn rounded-pill btn-warning waves-effect waves-light btn-ragu"
            data-no="{{ $data['no'] }}" data-id="{{ $data['id'] }}"><span
                class="tf-icons ri-flag-line ri-16px me-2"></span>Tandai
            Ragu</button>
        <button type="button" class="btn rounded-pill btn-primary waves-effect waves-light btn-lanjut"
            data-no="{{ $data['no'] + 1 }}" data-id="{{ $data['id'] }}">Lanjut<span
                class="tf-icons ri-arrow-right-line ri-16px me-2"></span></button>
    </div>
    <input type="hidden" name="id_soal" value="{{ $data['id'] }}">
</form>
