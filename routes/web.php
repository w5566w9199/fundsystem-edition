<?php

use App\Http\Controllers\usercontroller;
use App\Http\Controllers\fund_tablecontroller;
use App\Http\Controllers\implementation_mattercontroller;
use App\Http\Controllers\subplancontroller;
use App\Http\Controllers\LoadFundController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\checksubplancontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\FileDownloadController;
use Inertia\Inertia;

// use app\Http\Controllers\Controller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return redirect('/login');
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/fund_table');
    // return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->resource('users', usercontroller::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('school', SchoolController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('fund_table', fund_tablecontroller::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('implementation_matter', implementation_mattercontroller::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('subplan', subplancontroller::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/scroll', [subplancontroller::class, 'scroll'])->name('scroll');
Route::middleware(['auth:sanctum', 'verified'])->post('/loadfund', [LoadFundController::class, 'index'])->name('loadfund');
Route::middleware(['auth:sanctum', 'verified'])->post('/check', [checksubplancontroller::class, 'index'])->name('check');


Route::middleware(['auth:sanctum', 'verified'])->resource('filedownload', FileDownloadController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('funddownload', [FileDownloadController::class, 'export'])->name('funddownload');

Route::middleware(['auth:sanctum', 'verified'])->get('dropzone', [DropzoneController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->post('dropzone/upload', [DropzoneController::class, 'upload'])->name('dropzone.upload');
Route::middleware(['auth:sanctum', 'verified'])->post('dropzone/fetch', [DropzoneController::class, 'fetch'])->name('dropzone.fetch');
Route::middleware(['auth:sanctum', 'verified'])->post('dropzone/delete', [DropzoneController::class, 'delete'])->name('dropzone.delete');