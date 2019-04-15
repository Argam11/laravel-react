<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Employee;

class EmployeeService
{
    /**
     * Показать профиль переданного пользователя.
     *
     * 
     * @return Response
     */
    public function index()
    {
        $companies = Company::all();
        $employees = Employee::with('companies')->paginate(10);
        return ['companies' => $companies, 'employees' => $employees];
    }

    /**
     * Показать профиль переданного пользователя.
     *
     * @param $request
     * @return Response
     */
    public function storeEmployee($request)
    {
        $employee = new Employee([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'company_id' => $request->get('company_id'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone')
        ]);
        $employee->save();
        return response()->json('Employee duct Added Successfully.');
    }
    /**
     * Показать профиль переданного пользователя.
     *
     * @param int  $id
     * @return Response
     */
    public function showEmployee($id)
    {
        $companies = Company::all();
        $employee = Employee::find($id);
        return response()->json(['employee' => $employee, 'companies' => $companies]);
    }
    /**
     * Показать профиль переданного пользователя.
     *
     * @param $request, int  $id
     * @return Response
     */

    public function updateEmployee($request, $id)
    {
        $employee = Employee::find($id);
        $employee->first_name = $request->get('first_name');
        $employee->last_name = $request->get('last_name');
        $employee->company_id = $request->get('company_id');
        $employee->email = $request->get('email');
        $employee->phone = $request->get('phone');
        $employee->save();
        return response()->json('Employee duct Update Successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json('Employee duct delete Successfully.');
    }
}