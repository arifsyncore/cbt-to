<p class="card-title mb-4">{{ $soalArr['no'] }} - {{ $soalArr['soal'] }}</p>
<form id="form-soal">
    <ul class="list-group list-group-flush mb-6">
        @foreach ($soalArr['opsi'] as $opsi)
            <li class="list-group-item">
                <div class="form-check">
                    <input name="opsi" class="form-check-input jawaban" type="radio" value="{{ $opsi['value'] }}"
                        id="defaultRadio{{ $opsi['value'] }}" data-no="{{ $soalArr['no'] }}"
                        data-idsoal="{{ $soalArr['id'] }}" {{ $soalArr['jawaban'] == $opsi['value'] ? 'checked' : '' }}>
                    <label class="form-check-label" for="defaultRadio{{ $opsi['value'] }}">
                        {{ $opsi['value'] }} . {{ $opsi['opsi'] }}
                    </label>
                </div>
            </li>
        @endforeach
    </ul>
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
</form>
