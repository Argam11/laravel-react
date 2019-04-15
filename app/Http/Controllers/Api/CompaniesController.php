<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use App\Http\Requests\CompanyRequest;

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
        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $companies = $this->companies->storeCompany($request);
        return response()->json($companies);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companies = $this->companies->showCompany($id);
        return response()->json($companies);
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
        $companies = $this->companies->updateCompany($request, $id);
        return response()->json($companies);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companies = $this->companies->deleteCompany($id);
        return response()->json($companies);
    }
}
