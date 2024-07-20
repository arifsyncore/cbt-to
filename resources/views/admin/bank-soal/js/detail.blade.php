<script>
    var tabelSoal, soal, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e
    var bank_id = document.querySelector('#bank_id')
    var formContent = document.querySelector('#form-content')
    $(document).ready(function() {
        var res = dxAjax(`/bank-soal/detail/form`, {
            id: bank_id.value,
        }, 'GET')

        if (res.status == 200) {
            formContent.innerHTML = res.data
        } else {
            Swal.fire({
                title: 'Error!',
                text: res.message,
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            });
        }

        editor()

        tabelSoal = $('.table-soal').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: `/bank-soal/detail?id=${bank_id.value}`,
            "language": {
                "sSearch": "Cari:",
                "sProcessing": "Sedang memproses...",
                "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sLengthMenu": "Tampilkan _MENU_ entri",
            },
            columns: [{
                    data: 'nomor_soal'
                },
                {
                    data: 'soal'
                },
                {
                    data: 'opsi'
                },
                {
                    data: 'jawaban'
                },
                {
                    data: 'aksi'
                },
            ]
        })
        $('#form-soal').on('submit', function(e) {
            e.preventDefault()
            var res = dxAjax(`/bank-soal/detail/add`, $('#form-soal').serialize(), 'POST')
            if (res.status == 200) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: res.message,
                    icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-primary waves-effect waves-light'
                    },
                    buttonsStyling: false
                });
                tabelSoal.ajax.reload(null, false)
                resetForm()
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: res.message,
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary waves-effect waves-light'
                    },
                    buttonsStyling: false
                });
            }
        })
    })

    function resetForm() {
        soal.deleteText(0, soal.getLength())
        opsi_a.deleteText(0, opsi_a.getLength())
        opsi_b.deleteText(0, opsi_b.getLength())
        opsi_c.deleteText(0, opsi_c.getLength())
        document.querySelector('#soal').value = '';
        document.querySelector('#opsi_a').value = '';
        document.querySelector('#opsi_b').value = '';
        document.querySelector('#opsi_c').value = '';
        if ($('#snow-editor-opsi-d').length) {
            opsi_d.deleteText(0, opsi_d.getLength())
            document.querySelector('#opsi_d').value = '';
        }
        if ($('#snow-editor-opsi-e').length) {
            opsi_e.deleteText(0, opsi_e.getLength())
            document.querySelector('#opsi_e').value = '';
        }

        document.querySelector('#jawaban').value = ""
    }

    function edit(id) {
        window.scrollTo(2000, 0);
        var res = dxAjax('/bank-soal/detail/edit', {
            id: id
        }, 'GET')
        if (res.status == 200) {
            formContent.innerHTML = res.data
            editor()
        } else {
            Swal.fire({
                title: 'Error!',
                text: res.message,
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            });
        }
    }

    function editor() {
        if ($('#snow-editor-soal').length) {
            soal = new Quill('#snow-editor-soal', {
                bounds: '#snow-editor',
                modules: {
                    formula: true,
                    toolbar: '#snow-toolbar-soal'
                },
                theme: 'snow'
            });
            soal.on('text-change', function(delta, oldDelta, source) {
                document.querySelector("input[name='soal']").value = soal.root.innerHTML;
            });
        }

        if ($('#snow-editor-opsi-a').length) {
            opsi_a = new Quill('#snow-editor-opsi-a', {
                bounds: '#snow-editor-opsi-a',
                modules: {
                    formula: true,
                    toolbar: '#snow-toolbar-opsi-a'
                },
                theme: 'snow'
            });
            opsi_a.on('text-change', function(delta, oldDelta, source) {
                document.querySelector("input[name='opsi_a']").value = opsi_a.root.innerHTML;
            });
        }

        if ($('#snow-editor-opsi-b').length) {
            opsi_b = new Quill('#snow-editor-opsi-b', {
                modules: {
                    formula: true,
                    toolbar: '#snow-toolbar-opsi-b'
                },
                theme: 'snow'
            });
            opsi_b.on('text-change', function(delta, oldDelta, source) {
                document.querySelector("input[name='opsi_b']").value = opsi_b.root.innerHTML;
            });
        }

        if ($('#snow-editor-opsi-c').length) {
            opsi_c = new Quill('#snow-editor-opsi-c', {
                modules: {
                    formula: true,
                    toolbar: '#snow-toolbar-opsi-c'
                },
                theme: 'snow'
            });
            opsi_c.on('text-change', function(delta, oldDelta, source) {
                document.querySelector("input[name='opsi_c']").value = opsi_c.root.innerHTML;
            });
        }

        if ($('#snow-editor-opsi-d').length) {
            opsi_d = new Quill('#snow-editor-opsi-d', {
                modules: {
                    formula: true,
                    toolbar: '#snow-toolbar-opsi-d'
                },
                theme: 'snow'
            });
            opsi_d.on('text-change', function(delta, oldDelta, source) {
                document.querySelector("input[name='opsi_d']").value = opsi_d.root.innerHTML;
            });
        }

        if ($('#snow-editor-opsi-e').length) {
            opsi_e = new Quill('#snow-editor-opsi-e', {
                modules: {
                    formula: true,
                    toolbar: '#snow-toolbar-opsi-e'
                },
                theme: 'snow'
            });
            opsi_e.on('text-change', function(delta, oldDelta, source) {
                document.querySelector("input[name='opsi_e']").value = opsi_e.root.innerHTML;
            });
        }
    }
</script>
