<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Controllers\Controller;
use App\Services\CompanyService;

class CompaniesController extends Controller
{
    /**
     * The user repository implementation.
     *
     * @var CompanyService
     */

    protected $companies;

    /**
     * Create a new controller instance.
     *
     * @param  CompanyService  $companies
     * @return void
     */

    public function __construct(CompanyService $companies)
    {
        $this->middleware('auth');
        $this->companies = $companies;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->companies->index();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $this->companies->storeCompany($request);
        return redirect('/admin/companies')->with('success', 'Stock has been added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->companies->showCompany($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $this->companies->updateCompany($request, $id);
        return redirect('/admin/companies')->with('success', 'Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->companies->deleteCompany($id);
        return redirect('/companies')->with('success', 'Stock has been deleted Successfully');
    }
}
