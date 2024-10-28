<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome');
                })->name('input.data');
                
                Route::get('/form', function () {
                    return view('form.index');
                            })-> name('form.index');
                Route::get('/form.edit', function () {
                    return view('form.edit');
                            })-> name('form.edit');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('data', [DataController::class, 'index'])->name('data.index');
        Route::get('data/{data}', [DataController::class, 'show'])->name('data.show');
        Route::get('data/{data}/edit', [DataController::class, 'edit'])->name('data.edit');
        Route::put('data/{data}', [DataController::class, 'update'])->name('data.update');
        Route::delete('data/{data}', [DataController::class, 'destroy'])->name('data.destroy');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
            });
        
            Route::get('data/create', [DataController::class, 'create'])->name('data.create');
            Route::post('data', [DataController::class, 'store'])->name('data.store');

    require __DIR__.'/auth.php';
});
