<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BankSoalController;
use App\Http\Controllers\admin\ManajemenUserController;
use App\Http\Controllers\admin\MasterJenisSoalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
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
Route::get('/', [LandingPageController::class, 'index']);
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
    Route::get('/bank-soal/detail/edit', [BankSoalController::class, 'editDetail']);
});

Route::group(['middleware' => ['auth', 'role:2']], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
});
