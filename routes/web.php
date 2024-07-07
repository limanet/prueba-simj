<?php

use Illuminate\Support\Facades\Route;

// Rutas para el login
Route::view( 'login', 'auth.login' );
Route::post( 'login', [ \App\Http\Controllers\loginController::class, 'login' ] )->name( 'login' );
Route::get( 'logout', [ \App\Http\Controllers\loginController::class, 'logout' ] )->name( 'logout' );

Route::get( '/', function () {
    return redirect( 'login' );
} )->middleware( 'auth' )->name( 'index' );


Route::prefix( 'users' )->middleware( 'auth' )->group( function () {
    Route::get( '/', [ \App\Http\Controllers\UsersController::class, 'usersList' ] )->name( 'users.index' );
    Route::get( '/create', [ \App\Http\Controllers\UsersController::class, 'newUser' ] )->name( 'users.create' );
    Route::post( '/create', [ \App\Http\Controllers\UsersController::class, 'saveUser' ] )->name( 'users.create.save' );
    Route::get( '/{user_id}/edit', [ \App\Http\Controllers\UsersController::class, 'editUser' ] )->name( 'users.edit' );
    Route::post( '/{user_id}/edit', [ \App\Http\Controllers\UsersController::class, 'saveUser' ] )->name( 'users.edit.save' );
    Route::get( '/{user_id}/delete', [ \App\Http\Controllers\UsersController::class, 'deleteUser' ] )->name( 'users.delete' );
});
