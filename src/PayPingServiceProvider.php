<?php

namespace AMeysam\PayPing;

use Illuminate\Support\ServiceProvider;

class PayPingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/payping.php', 'payping');

        $this->publishes([
            __DIR__ . '/config/payping.php' => config_path('payping.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		$this->mergeConfigFrom(
            __DIR__ . '/config/payping.php', 'payping'
        );
    }
}
