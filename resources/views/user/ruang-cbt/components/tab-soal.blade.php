@foreach ($tabArray as $tab)
    <p><strong>{{ $tab['jenis'] }}</strong></p>
    <div class="row mb-4">
        @foreach ($tab['detailTab'] as $det)
            <div class="col-2 d-flex justify-content-center mb-3">
                <button type="button"
                    class="btn btn-icon {{ $det['status'] == 'jawab' ? 'btn-primary' : ($det['status'] == 'ragu' ? 'btn-warning' : 'btn-outline-primary') }} waves-effect btn-tab"
                    id="btn-tab{{ $det['no'] }}" data-no="{{ $det['no'] }}">
                    {{ $det['no'] }}
                </button>
            </div>
        @endforeach
    </div>
@endforeach
