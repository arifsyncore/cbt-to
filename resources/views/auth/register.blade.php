@extends('auth.layouts.main')

@section('title', 'Register')
@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection
@section('content')
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
            <div class="authentication-inner py-6" style="max-width: 750px !important;">
                <!-- Register Card -->
                <div class="card p-md-7 p-1">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <span style="color: var(--bs-primary)">
                                    <svg width="268" height="150" viewBox="0 0 38 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                                            fill="currentColor" />
                                        <path
                                            d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                                            fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4" />
                                        <path
                                            d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                                            fill="currentColor" />
                                        <path
                                            d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                                            fill="currentColor" />
                                        <path
                                            d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                                            fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4" />
                                        <path
                                            d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                                            fill="currentColor" />
                                        <defs>
                                            <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138"
                                                x2="10.532" y2="24.104" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-opacity="1" />
                                                <stop offset="1" stop-opacity="0" />
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139"
                                                x2="10.3357" y2="24.1155" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-opacity="1" />
                                                <stop offset="1" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </span>
                            </span>
                            <span class="app-brand-text demo text-heading fw-semibold">Materialize</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <div class="card-body mt-1">
                        <h4 class="mb-1">Register akun CBT-Online 🚀</h4>
                        <p class="mb-5">Lengkapi data dibawah untuk register akun.</p>

                        <form id="formAuthentication" class="mb-5" action="{{ route('post-register') }}" method="POST">
                            @csrf
                            @if (session()->has('email'))
                                <div class="alert alert-danger alert-dismissible text-center text-danger" role="alert">
                                    {{ session('email') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('username'))
                                <div class="alert alert-danger alert-dismissible text-center text-danger" role="alert">
                                    {{ session('username') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukkan nama lengkap" autofocus />
                                        <label for="username">Nama Lengkap</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="nama_alias" name="nama_alias"
                                            placeholder="Masukkan nama Panggilan" autofocus />
                                        <label for="username">Nama Panggilan</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="no_telp" name="no_telp"
                                            placeholder="Masukkan no Whatsapp" autofocus />
                                        <label for="username">No Whatsapp</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-floating form-floating-outline">
                                        <select id="jekel" name="jekel" class="soal-select form-select"
                                            data-allow-clear="true">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control flatpickr-input active"
                                            placeholder="YYYY-MM-DD" id="flatpickr-date" name="tanggal_lahir"
                                            readonly="readonly">
                                        <label for="flatpickr-date">Tanggal Lahir</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-floating form-floating-outline">
                                        <select id="provinsi" name="provinsi" class="soal-select form-select"
                                            data-allow-clear="true">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach ($dataProvinsi as $prov)
                                                <option value="{{ $prov['name'] }}" data-id="{{ $prov['id'] }}">
                                                    {{ $prov['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <label for="exampleFormControlSelect1">Pilih Provinsi</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-floating form-floating-outline">
                                        <select id="kab_kota" name="kab_kota" class="soal-select form-select"
                                            data-allow-clear="true">
                                            <option value="">Pilih Kota / Kab</option>
                                        </select>
                                        <label for="exampleFormControlSelect1">Pilih Kota / Kab</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" name="alamat_lengkap" id="alamat_lengkap"
                                            placeholder="Masukkan Alamat lengkap"></textarea>
                                        <label>Alamat Lengkap</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Enter your username" autofocus />
                                        <label for="username">Username</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Enter your email" />
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="form-password-toggle">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="password" id="password" class="form-control"
                                                    name="password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" />
                                                <label for="password">Password</label>
                                            </div>
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="ri-eye-off-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 cl-xl-12 mb-5">
                                    <div class="mb-5 form-password-toggle">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="password" id="confirm-password" class="form-control"
                                                    name="confirm-password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" />
                                                <label for="password">Konfirmasi Password</label>
                                            </div>
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="ri-eye-off-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Sign up</button>
                        </form>

                        <p class="text-center">
                            <span>Sudah punya akun ?</span>
                            <a href="{{ route('login') }}">
                                <span>Sign in disini</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
                <img alt="mask" src="../../assets/img/illustrations/auth-basic-register-mask-light.png"
                    class="authentication-image d-none d-lg-block"
                    data-app-light-img="illustrations/auth-basic-register-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-register-mask-dark.png" />
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('/assets/js/pages-auth.js') }}"></script>
    <script>
        const flatpickrDate = document.querySelector('#flatpickr-date')
        if (flatpickrDate) {
            flatpickrDate.flatpickr({
                monthSelectorType: 'static'
            });
        }

        var select_prov = document.querySelector('#provinsi')
        var select_kab = document.querySelector('#kab_kota')
        select_prov.addEventListener('change', async function(e) {
            var id = e.target.options[event.target.selectedIndex].dataset.id
            var res = dxAjax(`/register/getKota`, {
                id: id
            }, 'GET')
            if (res.resCode == 200) {
                select_kab.innerHTML = `<option value="">-- Pilih Kota / Kab --</option>`
                res.data.forEach(kota => {
                    select_kab.innerHTML +=
                        `<option value="${kota.name}">${kota.name}</option>`
                })
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
    </script>
@endsection
