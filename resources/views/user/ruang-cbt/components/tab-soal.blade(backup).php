@php
    $no = 1;
@endphp
@foreach ($tab as $btn)
    <div class="col-2 d-flex justify-content-center mb-3">
        <button type="button"
            class="btn btn-icon {{ $btn->status == 'ragu' ? 'btn-warning' : ($btn->status == 'jawab' ? 'btn-primary' : 'btn-outline-primary') }} waves-effect"
            id="btn-tab{{ $btn->no }}">
            {{ $no }}
        </button>
    </div>
    @php
        $no++;
    @endphp
@endforeach
