<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Models\Employee as ModelsEmployee;

interface EmployeeInterface
{
    public function getById(int $id);
    public function getPaginated(Request $request);
    public function store(array $data);
    public function update(array $data, ModelsEmployee $model);
    public function destroy(ModelsEmployee $model);
    public function import($request);
}
