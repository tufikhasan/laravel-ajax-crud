<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class Employees extends Controller {
    function employees() {
        $employees = Employee::latest()->paginate( 5 );
        return view( 'employees', compact( 'employees' ) );
    }

    function addEmployee( Request $request ) {
        $request->validate( [
            'name'    => 'required',
            'email'   => 'required|unique:employees',
            'address' => 'required',
            'phone'   => 'required|unique:employees',
        ], [
            'name.required'    => 'Name is Required',
            'email.required'   => 'Email is Required',
            'email.unique'     => 'Employee Email already exist',
            'address.required' => 'Address is Required',
            'phone.required'   => 'Phone number is Required',
            'phone.unique'     => 'Employee Phone number already exist',
        ] );

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->save();

        return response()->json( ['status' => 'success'] );
    }
}
