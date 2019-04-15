<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;

class EmployeesController extends Controller
{
    /**
     * The user repository implementation.
     *
     * @var EmployeeService
     */

    protected $employees;

    /**
     * Create a new controller instance.
     *
     * @param  EmployeeService  $employees
     * @return void
     */

    public function __construct(EmployeeService $employees)
    {   
        $this->middleware('auth');
        $this->employees = $employees;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employees->index()['employees'];
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = $this->employees->index()['companies'];
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $this->employees->storeEmployee($request);
        return redirect('/admin/employees')->with('success', 'Stock has been added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = $this->employees->showEmployee($id);
        $companies = $employee->original['companies'];
        $employee = $employee->original['employee'];
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = $this->employees->updateEmployee($request, $id);
        return redirect('/admin/employees')->with('success', 'Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = $this->employees->deleteEmployee($id);
        return redirect('/employees')->with('success', 'Stock has been deleted Successfully');
    }
}
