<?php

namespace App\Providers;

use App\Models\Invoice;
use App\Models\User;
use App\Observers\v1\InvoiceObserver;
use App\Observers\v1\UserObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        Invoice::observe(InvoiceObserver::class);
    }
}
