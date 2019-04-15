<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    /**
     * Показать профиль переданного пользователя.
     *
     * 
     * @return Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return $companies;
    }

    /**
     * Показать профиль переданного пользователя.
     *
     * @param int  $id
     * @return Response
     */
    public function storeCompany($request)
    {
        if ($logo = $request->file('logo')) {
            $name = $logo->getClientoriginalName();
            $logo->storeAs('public', $name);
        }
        $company = new Company([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'logo' => $request->file('logo')->getClientoriginalName(),
            'website' => $request->get('website')
        ]);
        $company->save();
        return response()->json('Successfully added');
    }
    /**
     * Показать профиль переданного пользователя.
     *
     * @param int  $id
     * @return Response
     */
    public function showCompany($id)
    {
        $company = Company::find($id);
        return $company;
    }
    /**
     * Показать профиль переданного пользователя.
     *
     * @param $request, int  $id
     * @return Response
     */

    public function updateCompany($request, $id)
    {
        $company = Company::find($id);
        $company->name = $request->get('name');
        $company->email = $request->get('email');
        $company->website = $request->get('website');
        if ($logo = $request->file('logo')) {
            $name = $logo->getClientoriginalName();
            $logo->storeAs('public', $name);
            $company->logo = $request->file('logo')->getClientoriginalName();
        }
        $company->save();
        return response()->json('Company duct Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCompany($id)
    {
        $company = Company::find($id);
        $company->delete();
        return response()->json('Company duct delete Successfully.');
    }
}