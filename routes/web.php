<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipAdminController;
use App\Http\Controllers\DaftarTungguController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PendaftaranLanjutanController;
use App\Http\Controllers\PendaftaranPasienBaruController;
use App\Http\Controllers\PendaftaranPasienLamaController;

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



// Login Routes
Route::get('/', [AuthController::class, 'LoginForm'])->name('loginShow');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//Register Routes
Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'register'])->name('register.create');
//logout routes
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



// Midlleware isLogin
Route::middleware(['isLogin'])->group(function () {

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('update.profile');

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/data-perbulan', [DashboardController::class, 'dataPerbulan']);

    // Pasien Baru Routes
    Route::get('/pendaftaran-pasien-baru', [PendaftaranPasienBaruController::class, 'index'])->name('pendaftaran-pasien-baru.index');
    Route::post('/pendaftaran-pasien-baru', [PendaftaranPasienBaruController::class, 'store'])->name('pendaftaran-pasien-baru.create');

    // Pasien Lama Routes
    Route::get('/pendaftaran-pasien-lama', [PendaftaranPasienLamaController::class, 'index'])->name('pendaftaran-pasien-lama.index');
    Route::post('/pendaftaran-pasien-lama', [PendaftaranPasienLamaController::class, 'create'])->name('pendaftaran-pasien-lama.create');


    //Pendaftaran Lanjutan Routes
    Route::get('/pendaftaran-pasien-selanjutnya', [PendaftaranLanjutanController::class, 'nextPage'])->name('pendaftaran-lanjutan');
    Route::post('/pendaftaran-pasien-selanjutnya', [PendaftaranLanjutanController::class, 'store'])->name('pendaftaran-lanjutan.create');

    //Arsip Routes
    Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');

    //Arsip Daftar Tunggu
    Route::get('/daftar-tunggu', [DaftarTungguController::class, 'index'])->name('daftar-tunggu.index');
    Route::put('/update-daftar-tunggu/{id}', [DaftarTungguController::class, 'updateDiagnosaStatus'])->name('update-daftar-tunggu');

    // Arsip Admin
    Route::get('/arsip-admin', [ArsipAdminController::class, 'index'])->name('arsip-admin.index');
    Route::get('/data-awal', [ArsipAdminController::class, 'data_awal']);
    Route::get('/data-awal-bulan-ini', [ArsipAdminController::class, 'dataAwalBulanIni']);
    Route::get('/data-awal-custom', [ArsipAdminController::class, 'dataAwalCustom']);
});