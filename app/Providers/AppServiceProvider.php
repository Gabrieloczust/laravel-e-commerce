<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::directive('money', function ($money){
            return "<?php echo 'R$ ' . number_format((float)$money, 2, ',', '.') ?>";
        });

        Blade::directive('percent', function ($number){
            return "<?php echo number_format($number, 2, ',', ' ') . '%' ?>";
        });
    }
}
