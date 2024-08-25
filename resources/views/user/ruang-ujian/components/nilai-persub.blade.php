<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <h5 class="card-header">Nilai Per Subtest</h5>
            <div class="card-body">
                <div class="row">
                    @foreach ($tabArray as $tab)
                        <div class="col-lg-3 col-sm-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="avatar me-4">
                                            <div class="avatar-initial bg-label-primary rounded-3">
                                                <i class="ri-list-check-3 ri-24px"></i>
                                            </div>
                                        </div>
                                        <div class="card-info">
                                            <div class="d-flex align-items-center">
                                                <h5 class="mb-0 me-2">
                                                    {{ round($tab['nilai']) }}
                                                </h5>
                                            </div>
                                            <p class="mb-0">{{ $tab['jenis'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
