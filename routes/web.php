<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\DashboardController;

 
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/', function (){
    return view('welcome');
}
);


Route::get('/about', function() {
    return 'Halo, ini profil POS Barokah Mart.';
});