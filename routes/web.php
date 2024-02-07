<?php

use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrxController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/', function () {
    // return view('welcome');
    return Redirect::route('login');
});

Route::get('/dashboard', [TrxController::class, 'trxlist'])->middleware(['auth', 'verified'])->name('profile.transaction');


Route::middleware('auth')->group(function () {
    // Profile Page
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/transaction', [TrxController::class, 'trxlist'])->name('profile.transaction');
    Route::get('/backoffice/members', [MembersController::class, 'list'])->name('backoffice.members');
    
    // Transaction Page 
    Route::get('/topup', [TrxController::class, 'topup'])->name('topup.form');
    Route::post('/topup', [TrxController::class, 'store'])->name('topup.store');
});

require __DIR__.'/auth.php';
