<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Interfaces\EmployeeInterface;

class EmployeeRepository implements EmployeeInterface
{
    private $model;

    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function getById(int $id)
    {
        return $this->model->with('company')->findOrfail($id);
    }

    public function getPaginated(Request $request)
    {
        return $this->model->when($request->term, function ($query) use ($request) {
            $query->where('nama', 'like', "%" . trim($request->term) . "%");
        })
            ->latest()
            ->paginate(5);
    }

    public function store(array $data)
    {
        return $this->model->create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'company_id' => $data['company_id'],
        ]);
    }

    public function update(array $data, Employee $model)
    {
        return $model->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'company_id' => $data['company_id'],
        ]);
    }

    public function destroy(Employee $model)
    {
        return $model->delete();
    }

    public function import($request)
    {
        return $this->model->create([
            'nama' => $request[0],
            'email' => $request[1],
            'company_id' => $request[2],
        ]);
    }
}
