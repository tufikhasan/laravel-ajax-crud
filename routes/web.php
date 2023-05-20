<?php

use App\Http\Controllers\Employees;
use Illuminate\Support\Facades\Route;

Route::controller( Employees::class )->group( function () {
    Route::get( '/', 'employees' )->name( 'employees' );
    Route::post( '/add-employee', 'addEmployee' )->name( 'add.employee' );
    Route::post( '/update-employee', 'updateEmployee' )->name( 'update.employee' );
    Route::post( '/delete-employee', 'deleteEmployee' )->name( 'delete.employee' );
} );
