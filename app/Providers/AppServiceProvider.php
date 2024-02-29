<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        // use bootstrap for pagination
        // \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.bootstrap-4');
        // Paginator::useBootstrap();

        Gate::define('admin', function (User $user) {
            return $user->id_role == 1;
        });

        Gate::define('kepala_madrasah', function (User $user) {
            return $user->id_role == 2;
        });

        Gate::define('guru_wali', function (User $user) {
            return $user->id_role == 3;
        });

        Gate::define('guru_mapel', function (User $user) {
            return $user->id_role == 4;
        });

        Gate::define('siswa', function (User $user) {
            return $user->id_role == 5;
        });
    }
}
