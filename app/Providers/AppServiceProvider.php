<?php

namespace App\Providers;

use Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //https://laravel.com/docs/5.5/queues#job-expirations-and-timeouts
        //https://laracasts.com/discuss/channels/laravel/how-to-know-if-an-email-on-queue-failed
       // Queue::failing(function ($connection, $job, $data) {
            // Notify team of failing job...
       // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
