<?php

use Illuminate\Support\Facades\Route;

// Rutas para el login
Route::view( 'login', 'auth.login' );
Route::post( 'login', [ \App\Http\Controllers\loginController::class, 'login' ] )->name( 'login' );
Route::get( 'logout', [ \App\Http\Controllers\loginController::class, 'logout' ] )->name( 'logout' );

Route::get( '/', function () {
    return redirect( 'login' );
} )->middleware( 'auth' )->name( 'index' );


// Rutas para la sección de los usuarios
Route::prefix( 'users' )->middleware( 'auth' )->group( function () {
    Route::get( '/', [ \App\Http\Controllers\UsersController::class, 'usersList' ] )->name( 'users.index' );
    Route::get( '/create', [ \App\Http\Controllers\UsersController::class, 'newUser' ] )->name( 'users.create' );
    Route::post( '/create', [ \App\Http\Controllers\UsersController::class, 'saveUser' ] )->name( 'users.create.save' );
    Route::get( '/{user_id}/edit', [ \App\Http\Controllers\UsersController::class, 'editUser' ] )->name( 'users.edit' );
    Route::post( '/{user_id}/edit', [ \App\Http\Controllers\UsersController::class, 'saveUser' ] )->name( 'users.edit.save' );
    Route::get( '/{user_id}/delete', [ \App\Http\Controllers\UsersController::class, 'deleteUser' ] )->name( 'users.delete' );
});


// Rutas para la sección del calendario
Route::prefix( 'calendar' )->middleware( 'auth' )->group( function () {
    Route::get( '/', [ \App\Http\Controllers\CalendarController::class, 'index' ] )->name( 'calendar.index' );
    Route::get( 'festivos', [ \App\Http\Controllers\CalendarController::class, 'FestivosList' ] )->name( 'calendar.festivos' );
    Route::get( 'festivos/create', [ \App\Http\Controllers\CalendarController::class, 'newFestivo' ] )->name( 'calendar.festivos.create' );
    Route::post( 'festivos/create', [ \App\Http\Controllers\CalendarController::class, 'storeFestivo' ] )->name( 'calendar.festivos.create.store' );
    Route::get( 'festivos/{id_festivo}/edit', [ \App\Http\Controllers\CalendarController::class, 'editFestivo' ] )->name( 'calendar.festivos.edit' );
    Route::post( 'festivos/{id_festivo}/edit', [ \App\Http\Controllers\CalendarController::class, 'storeFestivo' ] )->name( 'calendar.festivos.edit.store' );
    Route::get( 'festivos/{id_festivo}/delete', [ \App\Http\Controllers\CalendarController::class, 'deleteFestivo' ] )->name( 'calendar.festivos.delete' );
});

Route::get( 'ajax/calendar', [ \App\Http\Controllers\CalendarController::class, 'ajaxCalendar' ] );
