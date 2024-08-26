@extends('layouts.main')

@section('title', 'Profil')
@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/pages/page-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-6">
                <div class="user-profile-header-banner">
                    <img src="../../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top">
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-5">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="../../assets/img/avatars/1.png" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img">
                    </div>
                    <div class="flex-grow-1 mt-4 mt-sm-12">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                            <div class="user-profile-info">
                                <h4 class="mb-2">{{ $data->name }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4">
                                    <li class="list-inline-item">
                                        <i class="ri-calendar-line me-2 ri-24px"></i>
                                        <span class="fw-medium">
                                            Bergabung
                                            {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-6">
                <h5 class="card-header">Update Detail Profil</h5>
                <div class="card-body">
                    <form id="form-data-diri" onsubmit="return false">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating form-floating-outline mb-6 input-profil">
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                        placeholder="Kode" value="{{ $data->name }}" />
                                    <label for="floatingInput">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating form-floating-outline mb-6 input-profil">
                                    <input type="text" class="form-control" id="nama_alias" name="nama_alias"
                                        placeholder="Kode" value="{{ $data->nama_alias }}" />
                                    <label for="floatingInput">Nama Panggilan</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating form-floating-outline mb-6 input-profil">
                                    <select id="jekel" name="jekel" class="soal-select form-select"
                                        data-allow-clear="true">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki"
                                            {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating form-floating-outline mb-6 input-profil">
                                    <input type="text" class="form-control flatpickr-input active"
                                        placeholder="YYYY-MM-DD" id="flatpickr-date" name="tanggal_lahir"
                                        value="{{ $data->tanggal_lahir }}" readonly="readonly">
                                    <label for="flatpickr-date">Tanggal Lahir</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating form-floating-outline mb-6 input-profil">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Kode" value="{{ $data->email }}" />
                                    <label for="floatingInput">E-Mail</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating form-floating-outline mb-6 input-profil">
                                    <input type="text" class="form-control" id="telp" name="telp"
                                        placeholder="Kode" value="{{ $data->no_telp }}" />
                                    <label for="floatingInput">No Whatsapp</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating form-floating-outline mb-6 input-profil">
                                    <select id="provinsi" name="provinsi" class="soal-select form-select"
                                        data-allow-clear="true">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($dataProvinsi as $prov)
                                            <option value="{{ $prov['name'] }}" data-id="{{ $prov['id'] }}"
                                                {{ $data->provinsi == $prov['name'] ? 'selected' : '' }}>
                                                {{ $prov['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <label for="exampleFormControlSelect1">Pilih Provinsi</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating form-floating-outline mb-6 input-profil">
                                    <select id="kab_kota" name="kab_kota" class="soal-select form-select"
                                        data-allow-clear="true">
                                        <option value="">Pilih Kota / Kab</option>
                                    </select>
                                    <label for="exampleFormControlSelect1">Pilih Kota / Kab</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating form-floating-outline mb-6 input-profil">
                                    <textarea class="form-control h-px-100" name="alamat_lengkap" id="alamat_lengkap"
                                        placeholder="Masukkan Alamat Lengkap">{{ $data->alamat_lengkap }}</textarea>
                                    <label for="opsi_a">Alamat Lengkap</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit"
                                class="btn btn-primary waves-effect waves-light btn-simpan-datadiri">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-6">
                <h5 class="card-header">Update Detail Akun</h5>
                <div class="card-body">
                    <form id="form-akun" onsubmit="return false">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating form-floating-outline mb-6 input-akun">
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Kode" value="{{ $data->username }}" />
                                    <label for="floatingInput">Username</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-6 mb-5">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline input-akun">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i
                                                class="ri-eye-off-line"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-6 mb-5">
                                <div class="mb-5 form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline input-akun">
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
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    @include('user.profil.js.app')
@endsection
