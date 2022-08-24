<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm=$request->get('q');
        if(empty($searchTerm)){
            $companies=Company::paginate(env('PAGE_SIZE'));
        }else{
            $companies=Company::where('organization_number', 'like', '%'.$searchTerm.'%')->paginate(env('PAGE_SIZE'));
        }

        $data=['companies'=>$companies, 'page_size'=>env('PAGE_SIZE')];

        if($request->wantsJson()){
            return response()->json($data);
        }

        return view('company.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $company=new Company();
        $data=['fields'=>$company->getFillable(),'company'=>[], 'editing'=>false, 'countries'=>Utils::getCountries()];
        if($request->wantsJson()){
            return response()->json($data);
        }

        return view('company.editing', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $companyId=null)
    {
        $request->validate([
            'name'=>'required',
            'organization_number'=>['required',Rule::unique('company')->ignore($companyId)],
            'country'=>'required',
            'email'=>'required|email'
        ]);

        if(empty($companyId)){
            $company=new Company();
        }else{
            $company=Company::find($companyId);
            if(is_null($company)){
                abort(404);
            }
        }

        $company->updateOrCreate(['id'=>$companyId],$request->only($company->getFillable()));

        if($request->wantsJson()){
            return response()->json(['success'=>'Company updated']);
        }

        return redirect()->route('company.index')->with('success', 'Company udpated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $companyId)
    {
        /** @var Company $company */
        $company=Company::find($companyId);
        if($request->wantsJson()){
            return response()->json($company);
        }
        return view('company.details', ['company'=>$company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, int $companyId)
    {
        $company=Company::find($companyId);
        $data=['fields'=>$company->getFillable(),'company'=>$company, 'editing'=>true, 'countries'=>Utils::getCountries()];
        if($request->wantsJson()){
            return response()->json($data);
        }
        return view('company.editing', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $companyId)
    {
        Company::destroy($companyId);
        if($request->wantsJson()){
            return response()->json(['success'=>'Company deleted']);
        }
        return redirect()->route('company.index')->with('success', 'Company deleted');
    }
}
