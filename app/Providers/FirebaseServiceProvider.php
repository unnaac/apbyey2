<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Auth::class, function ($app) {
            return (new Factory)
                ->withServiceAccount(config('firebase.credentials'))
                ->createAuth();
        });
    }
    public function dashboard()
    {
        $user = Auth::user(); // Mendapatkan data user yang login
        return view('dashboard', compact('user'));
    }
    public function boot()
    {
        //
    }
}
