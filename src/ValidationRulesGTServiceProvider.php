<?php
namespace SoftlogicGT\ValidationRulesGT;

use Illuminate\Support\ServiceProvider;

class ValidationRulesGTServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/validationRulesGT'),
        ]);

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', 'validationRulesGT');
    }
}
