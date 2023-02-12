<?php

namespace App\Http\Controllers;

use App\Models\Company;
use PDF;
use Illuminate\Http\Request;
use App\Interfaces\CompanyInterface;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;

class CompanyController extends Controller
{
    protected $companyInterface;

    public function __construct(CompanyInterface $companyInterface)
    {
        $this->companyInterface = $companyInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('company.index', [
            'results' => $this->companyInterface->getPaginated($request),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->companyInterface->store($request->validated());

        return redirect()->route('companies.index')->with('success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $logo = base64_encode(file_get_contents($company->logo));

        $layout = view('company.show', [
            'company' => $company,
            'logo' => $logo,
        ]);

        $pdf = PDF::loadHTML($layout)->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit', [
            'result' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Company $company)
    {
        $this->companyInterface->update($request->validated(), $company);

        return redirect()->route('companies.index')->with('success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->companyInterface->destroy($company);

        return redirect()->route('companies.index')->with('success', 'Success');
    }
}
