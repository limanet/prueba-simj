<?php

use Illuminate\Support\Facades\Route;

// Rutas para el login
Route::view( 'login', 'auth.login' );
Route::post( 'login', [ \App\Http\Controllers\loginController::class, 'login' ] )->name( 'login' );
Route::get( 'logout', [ \App\Http\Controllers\loginController::class, 'logout' ] )->name( 'logout' );

Route::get( '/', function () {
    return view( 'welcome' );
} )->middleware( 'auth' )->name( 'index' );
