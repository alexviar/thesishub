<?php

namespace App\Providers;

use App\Models\Usuario;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Gate::define('administrar-usuarios', function (Usuario $user) {
            return $user->is_admin;
        }); 

        Gate::before(function (Usuario $user, string $ability) {
            if (!$user->is_activo) {
                return false;
            }
        });
        
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);

        Paginator::useBootstrapFive();

        Password::defaults(function () {
     
            return Password::min(8)
                           ->letters()
                           ->mixedCase()
                           ->symbols()
                           ->numbers();
        });
    }
}
