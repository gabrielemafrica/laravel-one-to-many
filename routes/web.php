<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoggedController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//mie rotte

Route::get('/', [GuestController :: class, 'index'])
    -> name("guest.index");

Route::get('guest/message', [GuestController :: class, 'message'])
    -> name("guest.message");

Route::get('logged/create', [LoggedController :: class, 'create'])
    -> middleware('auth')
    -> name("logged.create");

Route::post('logged/store', [LoggedController :: class, 'store'])
    -> middleware('auth')
    -> name('logged.store');

Route::get('logged/edit/{id}', [LoggedController :: class, 'edit'])
    -> middleware('auth')
    -> name('logged.edit');

Route::put('logged/update/{id}', [LoggedController :: class, 'update'])
    -> middleware('auth')
    -> name('logged.update');

 // route for logged

Route::get('logged/show/{id}', [LoggedController :: class, 'show'])
    -> middleware('auth')
    -> name("logged.show");

// Route::middleware('auth')
//     -> name('logged.')
//     -> prefix('logged')
//     -> group(function (){
//         Route :: get('show/{id}', [LoggedController :: class, 'show'])
//             -> name('show');
//     });


