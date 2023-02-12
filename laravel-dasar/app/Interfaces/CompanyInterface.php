<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Models\Company as ModelsCompany;

interface CompanyInterface
{
    public function getById(int $id);
    public function getPaginated(Request $request);
    public function store(array $data);
    public function update(array $data, ModelsCompany $model);
    public function destroy(ModelsCompany $model);
}
