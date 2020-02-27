<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Scale;
use Illuminate\Http\Request;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        return response()->json([
            'message' => 'Employee(s) record',
            'data' => $employees
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone_number' => 'required|string|unique:employees',
            'salary' => 'required'
        ]);

        // check if validation fails
        if( $validator->fails()) {
            // return validator error message
            return response()->json([
                'message' => $validator->errors(),
                'data' => []
            ], 422);
        }

        // instantiate employee model and set properties
        $employee = new Employee;
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->email = $request->input('email');
        $employee->phone_number = $request->input('phone_number');
        $employee->salary = $request->input('salary');

        // save the employee record
        $employee->save();

        // return response successful created
        return response()->json([
            'message' => 'Employee record created',
            'data' => []
        ], 201);
    }

    public function computePayeByEmployeeId($id) {
        // get employee record
        $employee = Employee::findOrFail($id);

        // retrieve gradation scale
        $scales = Scale::all();
        $paye = 0.0;
        $employeeSalary = $employee->salary;
        foreach ($scales as $scale) {
            if( $employeeSalary > 0) {
                if( $employeeSalary > $scale->monthly) {
                    $paye += $scale->monthly * ($scale->rate / 100);
                    $employeeSalary =  $employeeSalary - $scale->monthly;
                }
            }
        }

        return response()->json([
            'message' => 'Paye for employee',
            'data' => [
                'salary' => $employee->salary,
                'paye' => number_format($paye, 2, '.', '')
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
