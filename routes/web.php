<?php

use App\Http\Controllers\EventController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::resources('events',EventController::class);
Route::post('/event/add', [EventController::class,'store'])->name('storeEvent');
Route::get('/event/show', [EventController::class,'show'])->name('showEvent');
Route::post('/event/edit/{id}', [EventController::class,'edit'])->name('editEvent');
Route::post('/event/delete/{id}', [EventController::class,'destroy'])->name('deleteEvent');
Route::post('/event/update/{event}', [EventController::class,'update'])->name('updateEvent');