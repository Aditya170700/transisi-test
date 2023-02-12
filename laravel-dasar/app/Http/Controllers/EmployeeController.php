<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Interfaces\EmployeeInterface;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Imports\EmployeeImport;

class EmployeeController extends Controller
{
    protected $employeeInterface;

    public function __construct(EmployeeInterface $employeeInterface)
    {
        $this->employeeInterface = $employeeInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('employee.index', [
            'results' => $this->employeeInterface->getPaginated($request),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->employeeInterface->store($request->validated());

        return redirect()->route('employees.index')->with('success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $model)
    {
        return view('employee.edit', [
            'result' => $model->firstOrFail(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Employee $model)
    {
        $this->employeeInterface->update($request->validated(), $model);

        return redirect()->route('employees.index')->with('success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $model)
    {
        $model->delete();

        return redirect()->route('employees.index')->with('success', 'Success');
    }

    public function import(Request $request)
    {
        Excel::import(new EmployeeImport, $request->file('excel'));
        return redirect()->route('employees.index')->with('success', 'Success');
    }
}
