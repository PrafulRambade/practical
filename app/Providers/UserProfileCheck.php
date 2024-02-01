<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use auth;
use App\Models\User;

class UserProfileCheck extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            // dd($view);
            $data=[];
            if (Auth::check()){
                $user_id = auth::user()->id;
                $userdetails = User::find($user_id)->userdetails;
                $view->with('commonsidebar', $userdetails);
            }else{
                return redirect('login');
            }
        });
    }
}
