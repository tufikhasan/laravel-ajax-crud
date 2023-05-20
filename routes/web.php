<?php

use App\Http\Controllers\Employees;
use Illuminate\Support\Facades\Route;

Route::controller( Employees::class )->group( function () {
    Route::get( '/', 'employees' );
} );
