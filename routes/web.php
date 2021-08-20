<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmilController;
use App\Http\Controllers\AccountPasswordController;
use App\Http\Controllers\RekeningController;

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

require __DIR__.'/auth.php';

Route::get('/{any?}', function (){
    return view('layouts.master');
})->where('any', '^(?!api\/)[\/\w\.-]*');

// Route::middleware(['auth'])->group(function() {

//     Route::get('/dashboard', function () {
//         return view('dashboard', ['title' => 'Dashboard']);
//     })->name('dashboard');

//     Route::get('/account/password/edit', [AccountPasswordController::class, 'edit'])
//                     ->name('account.password.edit');
//     Route::patch('/account/password', [AccountPasswordController::class, 'update'])
//                     ->name('account.password.update');

//     Route::resource('rekening', RekeningController::class)->except(['show']);

// });

// Route::middleware(['auth', 'superadmin'])->group(function() {

//     Route::get('/amil', [AmilController::class, 'index'])
//                     ->name('amil.index');

//     Route::get('/amil/create', [AmilController::class, 'create'])
//                     ->name('amil.create');

//     Route::post('/amil', [AmilController::class, 'store'])
//                     ->name('amil.store');

//     Route::patch('/amil/{amil}/block', [AmilController::class, 'block'])
//                     ->name('amil.block');

//     Route::patch('/amil/{amil}/unblock', [AmilController::class, 'unblock'])
//                     ->name('amil.unblock');

//     Route::delete('/amil/{amil}', [AmilController::class, 'destroy'])
//                     ->name('amil.destroy');
// });
