<?php

namespace App\Providers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

use App\Models\User;

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
    // public function boot()
    // {
    // Gate::before(function (User $user, $ability){
    //     if ($user->checkRole('admin')){
    //         return true;
    //     }
    // });
    // }
    public function boot(GateContract $gate)
    {
    }
}
