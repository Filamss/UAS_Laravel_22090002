<?php

use App\Http\Controllers\Account\AkunController;
use App\Http\Controllers\Alternatif\AlternatifController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Penilaian\PenilaianController;
use App\Http\Controllers\Perhitungan\HitungController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\SubKriteriaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login_proses', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register_proses', [LoginController::class, 'register_proses'])->name('register_proses');

// Rute untuk verifikasi email
// Route::get('/email/verify', function () {
//     return view('auth.verifyemail'); 
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect()->route('admin.beranda')->with('success', 'Email anda berhasil diverifikasi.');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Link verifikasi email telah dikirim!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// Route::get('/test-email', function () {
//     $details = [
//         'title' => 'Mail from SPK Tour Choice',
//         'body' => 'This is for testing email using smtp'
//     ];

//     \Mail::to('filamsi.mghifary@gmail.com')->send(new \App\Mail\TestMail($details));

//     return 'Email has been sent';
// });
Route::middleware(['web'])->group(function () {
    Route::get('auth/google', [SosmedController::class, 'redirectToGoogle'])->name('google');
    Route::get('auth/google/callback', [SosmedController::class, 'handleGoogleCallback']);
});

Route::get('/verify-email/{id}', [LoginController::class, 'verifyEmail'])->name('verify.email');

Route::get('/forgot-password', [ForgotPassController::class, 'forgot_password'])->name('forgot-password');
Route::post('/forgot-password-act', [ForgotPassController::class, 'forgot_password_act'])->name('forgot-password-act');

Route::get('/validasi-forgot-password/{token}/{email}', [ForgotPassController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
Route::post('/validasi-forgot-password-act/{email}', [ForgotPassController::class, 'validasi_forgot_password_act'])->name('validasi-forgot-password-act');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/user', [AkunController::class, 'index'])->name('index');
    Route::get('/create', [AkunController::class, 'create'])->name('create');
    Route::post('/store', [AkunController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AkunController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [AkunController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [AkunController::class, 'delete'])->name('delete');


    Route::get('/clientside', [DataTableController::class, 'clientside'])->name('clientside');
    Route::get('/serverside', [DataTableController::class, 'serverside'])->name('serverside');


    //Kriteria
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria');
    Route::post('/store', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::put('/update/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/delete/{id}', [KriteriaController::class, 'delete'])->name('kriteria.delete');

    //SubKriteria
    Route::get('/subkriteria', [SubKriteriaController::class, 'index'])->name('subkriteria');

    //Alternatif
    Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif');
    Route::post('/alternatif/store', [AlternatifController::class, 'store'])->name('alternatif.store');
    Route::put('/alternatif/update/{id}', [AlternatifController::class, 'update'])->name('alternatif.update');
    Route::delete('/alternatif/delete/{id}', [AlternatifController::class, 'delete'])->name('alternatif.delete');

    //Penilaian
    Route::get('/matrix', [PenilaianController::class, 'index'])->name('penilaian');
    Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::put('/penilaian/update/{id}', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::delete('/penilaian/destroy/{id}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');

    //Perhitungan
    Route::get('/perhitungan', [HitungController::class, 'perhitungan'])->name('perhitungan');

});
