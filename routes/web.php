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

//guest index
Route::get('/', [GuestController :: class, 'index'])
    -> name("guest.index");

//message login
Route::get('guest/message', [GuestController :: class, 'message'])
    -> name("guest.message");

//CRUD for projects logged
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

Route::delete('logged/delete/{id}', [LoggedController :: class, 'delete'])
    -> middleware('auth')
    -> name('logged.delete');


Route::get('logged/show/{id}', [LoggedController :: class, 'show'])
    -> middleware('auth')
    -> name("logged.show");

//CRUD for types logged
Route::get('logged/type', [LoggedController :: class, 'typeIndex'])
    -> middleware('auth')
    -> name("logged.typeIndex");

Route::get('logged/type/create', [LoggedController :: class, 'typeCreate'])
    -> middleware('auth')
    -> name("logged.typeCreate");
Route::post('logged/type/store', [LoggedController :: class, 'typeStore'])
    -> middleware('auth')
    -> name("logged.typeStore");

Route::get('logged/type/edit/{id}', [LoggedController :: class, 'typeEdit'])
    -> middleware('auth')
    -> name('logged.typeEdit');
Route::put('logged/type/update/{id}', [LoggedController :: class, 'typeUpdate'])
    -> middleware('auth')
    -> name('logged.typeUpdate');
Route::delete('logged/type/delete/{id}', [LoggedController :: class, 'typeDelete'])
    -> middleware('auth')
    -> name('logged.typeDelete');

Route::get('logged/type/show/{id}', [LoggedController :: class, 'typeShow'])
    -> middleware('auth')
    -> name("logged.typeShow");

//CRUD for technologies logged
Route::get('logged/technology', [LoggedController :: class, 'technologyIndex'])
    -> middleware('auth')
    -> name("logged.technologyIndex");
Route::get('logged/technology/create', [LoggedController :: class, 'technologyCreate'])
    -> middleware('auth')
    -> name("logged.technologyCreate");
Route::post('logged/technology/store', [LoggedController :: class, 'technologyStore'])
    -> middleware('auth')
    -> name("logged.technologyStore");

Route::get('logged/technology/edit/{id}', [LoggedController :: class, 'technologyEdit'])
    -> middleware('auth')
    -> name('logged.technologyEdit');
Route::put('logged/technology/update/{id}', [LoggedController :: class, 'technologyUpdate'])
    -> middleware('auth')
    -> name('logged.technologyUpdate');
Route::delete('logged/technology/delete/{id}', [LoggedController :: class, 'technologyDelete'])
    -> middleware('auth')
    -> name('logged.technologyDelete');

Route::get('logged/technology/show/{id}', [LoggedController :: class, 'technologyShow'])
    -> middleware('auth')
    -> name("logged.technologyShow");

// Route::middleware('auth')
//     -> name('logged.')
//     -> prefix('logged')
//     -> group(function (){
//         Route :: get('show/{id}', [LoggedController :: class, 'show'])
//             -> name('show');
//     });


