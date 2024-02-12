<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GlobalVariablesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->share('logoPath,','public/plantilla/logo_app_ag_log.jpg');
        view()->share('globCompanyName','GRUPO SERVICIOS ADUANEROS Y LOGISTICA S. DE R.L.');
        view()->share('globShortCompanyName','GSA LOGISTICA');
        view()->share('globCompanyRTN','05019022423247');
        view()->share('globCompanyAddress','RES. COSTA DEL SOL, V-ETAPA, BLOQUE No. 22, CASA No. 14 S.E.');
        view()->share('globCompanyCity','SAN PEDRO SULA');
        view()->share('globCompanyPhone','+504 2510-5668');
        view()->share('globCompanyCellPhone','+504 3187-8682');
        view()->share('globCompanyCountry','HONDURAS');
        view()->share('globCompanyEmail','prealerta@gsaduanera.com');
    }
}
