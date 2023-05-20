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
    //Update employee
    function updateEmployee( Request $request ) {
        $request->validate( [
            'up_name'    => 'required',
            'up_email'   => 'required|unique:employees,email,' . $request->up_id,
            'up_address' => 'required',
            'up_phone'   => 'required|unique:employees,phone,' . $request->up_id,
        ], [
            'up_name.required'    => 'Name is Required',
            'up_email.required'   => 'Email is Required',
            'up_email.unique'     => 'Employee Email already exist',
            'up_address.required' => 'Address is Required',
            'up_phone.required'   => 'Phone number is Required',
            'up_phone.unique'     => 'Employee Phone number already exist',
        ] );

        Employee::where( 'id', $request->up_id )->update( [
            'name'    => $request->up_name,
            'email'   => $request->up_email,
            'address' => $request->up_address,
            'phone'   => $request->up_phone,
        ] );

        return response()->json( ['status' => 'success'] );
    }
    //Update employee
    function deleteEmployee( Request $request ) {
        // Employee::where( 'id', $request->del_id )->delete();
        Employee::find( $request->del_id )->delete();
        return response()->json( ['status' => 'success'] );
    }

    function pagination() {
        $employees = Employee::latest()->paginate( 5 );
        return view( 'template.pagination_employees', compact( 'employees' ) )->render();
    }
}
