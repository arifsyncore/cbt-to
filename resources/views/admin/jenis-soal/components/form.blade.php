<form class="add-new-record pt-0 row g-3" id="form-add-new-record" onsubmit="return false">
    @csrf
    <input type="hidden" name="action" id="action" value="{{ $action }}">
    <input type="hidden" name="id" id="id" value="{{ $action == 'edit' ? $jenis->id : '' }}">
    <div class="col-sm-12">
        <div class="input-group input-group-merge">
            <span id="basicFullname2" class="input-group-text"><i class="ri-hashtag ri-18px"></i></span>
            <div class="form-floating form-floating-outline">
                <input type="text" id="kode" class="form-control dt-full-name" name="kode" placeholder="Kode"
                    value="{{ $action == 'edit' ? $jenis->kode : '' }}" />
                <label for="basicFullname">Kode</label>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="input-group input-group-merge">
            <span id="basicFullname2" class="input-group-text"><i class="ri-file-text-line ri-18px"></i></span>
            <div class="form-floating form-floating-outline">
                <input type="text" id="jenis" class="form-control dt-full-name" name="jenis"
                    placeholder="Jenis" value="{{ $action == 'edit' ? $jenis->jenis : '' }}" />
                <label for="basicFullname">Jenis</label>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Simpan</button>
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
    </div>
</form>
