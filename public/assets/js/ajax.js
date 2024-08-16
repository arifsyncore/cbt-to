function dxAjax(requestUrl, requestData, requestMethod) {
    requestMethod = requestMethod ? requestMethod : 'POST';
    var response = ''
    try {
        $.ajax({
            async: false,
            beforeSend: function () {
                $.blockUI({
                    message:
                        '<div class="d-flex justify-content-center overlay"><p class="mb-0">Tunggu Sebentar...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                    css: {
                        backgroundColor: 'transparent',
                        color: '#fff',
                        border: '0'
                    }
                    , overlayCSS: {
                        opacity: 0.5
                    }
                });
            },
            headers: {
                'X-CSRF-TOKEN': $('input[type="hidden"][name="_token"]').val()
            },
            complete: function () {
            },
            url: requestUrl,
            data: requestData,
            type: requestMethod,
            success: function (data, textStatus) {
                if (textStatus == 'success') {
                    try {
                        response = data
                        $.unblockUI();
                    } catch (error) {

                    }
                }
            }
        })
    } catch (error) {
    }
    if (response == '') {
        $.unblockUI();
        Swal.fire({
            title: 'Error!',
            text: ' Error',
            icon: 'error',
            customClass: {
                confirmButton: 'btn btn-primary waves-effect waves-light'
            },
            buttonsStyling: false
        });
    }

    return response
}

function requestDataAjax(url, method, body) {
    return fetch(url, {
        headers: {
            'X-CSRF-TOKEN': $('input[type="hidden"][name="_token"]').val(),
            'X-Requested-With': 'XMLHttpRequest'
        },
        method,
        body,
    })
        .then(res => res.json())
        .then(res => {
            if (res.status != 200) {
                throw res
            }
            return res
        })
}