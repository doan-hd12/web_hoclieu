<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
 use App\Models\Major;
 use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   
   

public function boot()
{
    $majorsWithStats = Major::all();
    View::share('majorsWithStats', $majorsWithStats);
     View::share('user', Auth::user());
}

}
