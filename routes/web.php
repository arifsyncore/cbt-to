<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BankSoalController;
use App\Http\Controllers\admin\ManajemenUserController;
use App\Http\Controllers\admin\MasterJenisSoalController;
use App\Http\Controllers\Admin\UploadSoalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\User\RuangUjianController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [LoginController::class, 'index']);
// Route::get('/daftar-akun', [LoginController::class, 'daftarAkun']);

Auth::routes();
// landing page
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/soal-to', [LandingPageController::class, 'detailTo']);
Route::get('/soal-to/add', [LandingPageController::class, 'addUjian']);
// login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('post-login-member', [LoginController::class, 'login'])->name('post-login');
// register
Route::get('/register', [RegisterController::class, 'showRegister'])->name('daftar');
Route::post('/post-register-member', [RegisterController::class, 'register'])->name('post-register');

Route::group(['middleware' => ['auth', 'role:1,2']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['auth', 'role:1']], function () {
    // manajemen user
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/manajemen-user', [ManajemenUserController::class, 'index'])->name('manajemen-user');
    Route::get('/manajemen-user/nonaktifuser', [ManajemenUserController::class, 'destroy']);
    Route::get('/manajemen-user/aktifuser', [ManajemenUserController::class, 'aktifUser']);
    // jenis soal
    Route::get('/jenis-soal', [MasterJenisSoalController::class, 'index'])->name('jenis-soal');
    Route::get('/jenis-soal/formAdd', [MasterJenisSoalController::class, 'create']);
    Route::post('/jenis-soal/add', [MasterJenisSoalController::class, 'store']);
    Route::get('/jenis-soal/formEdit', [MasterJenisSoalController::class, 'edit']);
    Route::put('/jenis-soal/edit', [MasterJenisSoalController::class, 'update']);
    Route::delete('/jenis-soal/hapus', [MasterJenisSoalController::class, 'destroy']);
    // bank soal
    Route::get('/bank-soal', [BankSoalController::class, 'index'])->name('bank-soal');
    Route::get('/bank-soal/create', [BankSoalController::class, 'create'])->name('tambah-bank-soal');
    Route::post('/bank-soal/add', [BankSoalController::class, 'store']);
    Route::get('/bank-soal/ubah', [BankSoalController::class, 'edit']);
    Route::put('/bank-soal/edit', [BankSoalController::class, 'update']);
    Route::delete('/bank-soal/hapus', [BankSoalController::class, 'destroy']);
    Route::get('/bank-soal/detail', [BankSoalController::class, 'detail']);
    Route::get('/bank-soal/detail/form', [BankSoalController::class, 'formDetail']);
    Route::post('/bank-soal/detail/add', [BankSoalController::class, 'detailAdd']);
    Route::get('/bank-soal/detail/form-edit', [BankSoalController::class, 'editDetail']);
    Route::put('/bank-soal/detail/edit', [BankSoalController::class, 'detailEdit']);
    Route::delete('/bank-soal/detail/hapus', [BankSoalController::class, 'detailHapus']);
    // upload soal
    Route::get('/upload-soal', [UploadSoalController::class, 'index'])->name('upload-soal');
    Route::get('/upload-soal/create', [UploadSoalController::class, 'create']);
    Route::post('/upload-soal/add', [UploadSoalController::class, 'store']);
    Route::get('/upload-soal/ubah', [UploadSoalController::class, 'edit']);
    Route::put('/upload-soal/edit', [UploadSoalController::class, 'update']);
    Route::delete('/upload-soal/hapus', [UploadSoalController::class, 'destroy']);
});

Route::group(['middleware' => ['auth', 'role:2']], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');

    Route::get('/ruang-ujian', [RuangUjianController::class, 'index'])->name('ruang-ujian');
    Route::get('/ruang-ujian/add', [RuangUjianController::class, 'addRuangUjian'])->name('add-ruang-ujian');
    Route::get('/ruang-ujian/detail', [RuangUjianController::class, 'detail']);
});
