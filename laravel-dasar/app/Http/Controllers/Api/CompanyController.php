<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\CompanyInterface;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyInterface;

    public function __construct(CompanyInterface $companyInterface)
    {
        $this->companyInterface = $companyInterface;
    }

    public function forSelect(Request $request)
    {
        $companies = $this->companyInterface->getPaginated($request);

        $more = true;
        $pagination_obj = json_encode($companies);
        if (empty($companies->nextPageUrl())) {
            $more = false;
        }
        $result = [
            "results" => $companies->getCollection()->transform(function ($company) {
                return [
                    'id' => $company->id,
                    'text' => $company->nama
                ];
            }),
            "pagination" => [
                "more" => $more
            ]
        ];

        return response()->json($result);
    }
}
