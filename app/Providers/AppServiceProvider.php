<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

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
    public function boot(): void
    {

        View::composer('customer.*', function ($view) {

            $user = Session::get('user');

            if (!$user) {
                Session::put('url.intended', URL::current());

                echo "<script>window.location='".route('login')."'</script>";
                exit; 
            }
            $view->with('user', $user);
        });


        View::composer('admin.*', function ($view) {

            $user = Session::get('user');

            if (!$user) {
                Session::put('url.intended', URL::current());

                echo "<script>window.location='".route('login')."'</script>";
                exit; 
            }

            $view->with('user', $user);
        });
    }
}
