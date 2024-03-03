<?php

namespace App\Providers;

use App\Contracts\TransferFundsAuthorizerContract;
use App\Gateways\TransferFundsAuthorizer\EFTAuthorizer\EFTAuthorizer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TransferFundsAuthorizerContract::class, EFTAuthorizer::class);
        $this->repositoriesInterfaceAutoInjection();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function repositoriesInterfaceAutoInjection(): void
    {
        $pathRepositories = collect(File::directories(app_path('Repositories')));

        $pathRepositories->each(function ($pathRepository) {
            $directoryName = basename($pathRepository);

            $interfaceName = "App\Repositories\\$directoryName\\{$directoryName}RepositoryInterface";

            if (interface_exists($interfaceName)) {
                $repositoryImplementationName = "App\Repositories\\{$directoryName}\\{$directoryName}Repository";

                $this->app->bind($interfaceName, $repositoryImplementationName);
            }
        });
    }
}
