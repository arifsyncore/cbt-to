<form id="form-soal">
    <input type="hidden" name="id_bank" id="id_bank" value="{{ $bank_soal->id }}">
    <input type="hidden" name="action" id="action" value="{{ $action }}">
    <div class="row mb-4">
        <div class="col-6 col-md-6 col-sm-12 mb-4">
            <div class="card mb-6">
                <h5 class="card-header">Soal</h5>
                <div class="card-body">
                    <div id="snow-toolbar-soal">
                        <span class="ql-formats">
                            <select class="ql-font"></select>
                            <select class="ql-size"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-bold"></button>
                            <button class="ql-italic"></button>
                            <button class="ql-underline"></button>
                            <button class="ql-strike"></button>
                        </span>
                        <span class="ql-formats">
                            <select class="ql-color"></select>
                            <select class="ql-background"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-script" value="sub"></button>
                            <button class="ql-script" value="super"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-header" value="1"></button>
                            <button class="ql-header" value="2"></button>
                            <button class="ql-blockquote"></button>
                            <button class="ql-code-block"></button>
                        </span>
                    </div>
                    <div id="snow-editor-soal"></div>
                    <input type="hidden" name="soal" id="soal" value="">
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-sm-12 mb-4">
            <div class="row mb-4 overflow-scroll" style="max-height:30rem;">
                <div class="col-12 col-md-12 col-sm-12 mb-2">
                    <div class="card">
                        <h5 class="card-header">Jawaban A</h5>
                        <div class="card-body">
                            <div id="snow-toolbar-opsi-a">
                                <span class="ql-formats">
                                    <select class="ql-font"></select>
                                    <select class="ql-size"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                    <button class="ql-strike"></button>
                                </span>
                                <span class="ql-formats">
                                    <select class="ql-color"></select>
                                    <select class="ql-background"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-script" value="sub"></button>
                                    <button class="ql-script" value="super"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-header" value="1"></button>
                                    <button class="ql-header" value="2"></button>
                                    <button class="ql-blockquote"></button>
                                    <button class="ql-code-block"></button>
                                </span>
                            </div>
                            <div id="snow-editor-opsi-a"></div>
                            <input type="hidden" name="opsi_a" id="opsi_a" value="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-sm-12 mb-2">
                    <div class="card">
                        <h5 class="card-header">Jawaban B</h5>
                        <div class="card-body">
                            <div id="snow-toolbar-opsi-b">
                                <span class="ql-formats">
                                    <select class="ql-font"></select>
                                    <select class="ql-size"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                    <button class="ql-strike"></button>
                                </span>
                                <span class="ql-formats">
                                    <select class="ql-color"></select>
                                    <select class="ql-background"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-script" value="sub"></button>
                                    <button class="ql-script" value="super"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-header" value="1"></button>
                                    <button class="ql-header" value="2"></button>
                                    <button class="ql-blockquote"></button>
                                    <button class="ql-code-block"></button>
                                </span>
                            </div>
                            <div id="snow-editor-opsi-b"></div>
                            <input type="hidden" name="opsi_b" id="opsi_b" value="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-sm-12 mb-2">
                    <div class="card">
                        <h5 class="card-header">Jawaban C</h5>
                        <div class="card-body">
                            <div id="snow-toolbar-opsi-c">
                                <span class="ql-formats">
                                    <select class="ql-font"></select>
                                    <select class="ql-size"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                    <button class="ql-strike"></button>
                                </span>
                                <span class="ql-formats">
                                    <select class="ql-color"></select>
                                    <select class="ql-background"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-script" value="sub"></button>
                                    <button class="ql-script" value="super"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-header" value="1"></button>
                                    <button class="ql-header" value="2"></button>
                                    <button class="ql-blockquote"></button>
                                    <button class="ql-code-block"></button>
                                </span>
                            </div>
                            <div id="snow-editor-opsi-c"></div>
                            <input type="hidden" name="opsi_c" id="opsi_c" value="">
                        </div>
                    </div>
                </div>
                @if ($bank_soal->jml_opsi_jwb == 4)
                    <div class="col-12 col-md-12 col-sm-12 mb-2">
                        <div class="card">
                            <h5 class="card-header">Jawaban D</h5>
                            <div class="card-body">
                                <div id="snow-toolbar-opsi-d">
                                    <span class="ql-formats">
                                        <select class="ql-font"></select>
                                        <select class="ql-size"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-strike"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <select class="ql-color"></select>
                                        <select class="ql-background"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-script" value="sub"></button>
                                        <button class="ql-script" value="super"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-header" value="1"></button>
                                        <button class="ql-header" value="2"></button>
                                        <button class="ql-blockquote"></button>
                                        <button class="ql-code-block"></button>
                                    </span>
                                </div>
                                <div id="snow-editor-opsi-d"></div>
                                <input type="hidden" name="opsi_d" id="opsi_d" value="">
                            </div>
                        </div>
                    </div>
                @endif
                @if ($bank_soal->jml_opsi_jwb == 5)
                    <div class="col-12 col-md-12 col-sm-12 mb-2">
                        <div class="card">
                            <h5 class="card-header">Jawaban D</h5>
                            <div class="card-body">
                                <div id="snow-toolbar-opsi-d">
                                    <span class="ql-formats">
                                        <select class="ql-font"></select>
                                        <select class="ql-size"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-strike"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <select class="ql-color"></select>
                                        <select class="ql-background"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-script" value="sub"></button>
                                        <button class="ql-script" value="super"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-header" value="1"></button>
                                        <button class="ql-header" value="2"></button>
                                        <button class="ql-blockquote"></button>
                                        <button class="ql-code-block"></button>
                                    </span>
                                </div>
                                <div id="snow-editor-opsi-d"></div>
                                <input type="hidden" name="opsi_d" id="opsi_d" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-sm-12 mb-2">
                        <div class="card">
                            <h5 class="card-header">Jawaban E</h5>
                            <div class="card-body">
                                <div id="snow-toolbar-opsi-e">
                                    <span class="ql-formats">
                                        <select class="ql-font"></select>
                                        <select class="ql-size"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-strike"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <select class="ql-color"></select>
                                        <select class="ql-background"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-script" value="sub"></button>
                                        <button class="ql-script" value="super"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-header" value="1"></button>
                                        <button class="ql-header" value="2"></button>
                                        <button class="ql-blockquote"></button>
                                        <button class="ql-code-block"></button>
                                    </span>
                                </div>
                                <div id="snow-editor-opsi-e"></div>
                                <input type="hidden" name="opsi_e" id="opsi_e" value="">
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12 col-md-12 col-sm-12 mb-2">
                    <select class="form-control" name="jawaban" id="jawaban" data-style="btn-default">
                        <option value="">Pilih Jawaban</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        @if ($bank_soal->jml_opsi_jwb == 4)
                            <option value="D">D</option>
                        @endif
                        @if ($bank_soal->jml_opsi_jwb == 5)
                            <option value="D">D</option>
                            <option value="E">E</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="text-end">
        @if ($action == 'edit')
            <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Simpan</button>
            <button type="submit" class="btn btn-danger data-submit me-sm-4 me-1">Batal</button>
        @else
            <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Simpan</button>
        @endif
    </div>
</form>
