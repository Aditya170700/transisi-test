<?php

namespace App\Providers;

use App\Interfaces\CompanyInterface;
use App\Interfaces\EmployeeInterface;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CompanyInterface::class, CompanyRepository::class);
        $this->app->bind(EmployeeInterface::class, EmployeeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
