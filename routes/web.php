<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\FormWizard;
use App\Http\Controllers\PersonController;
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

Route::get('/',FormWizard::class);
Route::get('/form-wizard', FormWizard::class);
Route::get('/counter', Counter::class);
Route::get('/dbconn', function(){
    return view('dbconn');
});
Route::get('/persons/create', [PersonController::class, 'create'])->name('person.create');

