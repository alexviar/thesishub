<?php

namespace App\Providers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('administrador', function (Usuario $user) {
            return $user->rol == 1;
        }); 

        Gate::before(function (Usuario $user, string $ability) {
            if ($user->estado == 'inactivo') {
                return false;
            }
        });
        
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);
    }
}
