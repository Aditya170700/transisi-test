<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Interfaces\CompanyInterface;
use App\Services\File;

class CompanyRepository implements CompanyInterface
{
    private $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function getById(int $id)
    {
        return $this->model->with('employees')->firstOrFail($id);
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
        $path = '';

        if ($data['logo']) {
            $path = File::upload($data['logo'], 'company');
        }

        return $this->model->create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'logo' => $path,
            'website' => $data['website'],
        ]);
    }

    public function update(array $data, Company $model)
    {
        $path = $model->logo;

        if (isset($data['logo'])) {
            File::destroy($path);
            $path = File::upload($data['logo'], 'company');
        }

        return $model->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'logo' => $path,
            'website' => $data['website'],
        ]);
    }

    public function destroy(Company $model)
    {
        File::destroy($model->logo);

        return $model->delete();
    }
}
