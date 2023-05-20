<?php

namespace App\Http\Controllers;

class Employees extends Controller {
    function employees() {
        return view( 'employees' );
    }
}
