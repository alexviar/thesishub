<?php

namespace App\Providers;

use App\Modules\Auth\Models\Usuario;
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
        #region Para compatibilidad de los Factories con laravel-modules
        \Illuminate\Database\Eloquent\Factories\Factory::guessFactoryNamesUsing(function (string $modelName) {
            $namespace = \Illuminate\Support\Str::before($modelName, 'Models\\').'Database\\Factories\\';
        
            $modelName = \Illuminate\Support\Str::after($modelName, 'Models\\');
        
            return $namespace.$modelName.'Factory';
        });
        
        \Illuminate\Database\Eloquent\Factories\Factory::guessModelNamesUsing(function ($factory) {
            $namespacedFactoryBasename = \Illuminate\Support\Str::replaceLast(
                'Factory', '', \Illuminate\Support\Str::replaceFirst('Database\\Factories\\', 'Models\\', get_class($factory))
            );
        
            return $namespacedFactoryBasename;
        });
        #endregion
    }
}
