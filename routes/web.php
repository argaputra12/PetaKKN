<?php

use App\Models\Kota;
use App\Models\Lokasi;
use App\Models\Proker;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocationController;

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
    $locations = Kota::all();

    return view('welcome', compact('locations'));
})->name('home');

Route::get('/dashboard', function () {
    $lokasis = Lokasi::paginate(10);

    return view('dashboard', compact('lokasis'));
})->middleware(['auth'])->name('dashboard');

Route::prefix('map')->group(function () {
    Route::post('/', [LocationController::class, 'index'])->name('location.index');

});

Route::get('/dashboard/export', [AdminController::class, 'export'])->name('admin.export');
Route::get('/dashboard/export_all', [AdminController::class, 'exportAll'])->name('admin.export.all');

require __DIR__.'/auth.php';
