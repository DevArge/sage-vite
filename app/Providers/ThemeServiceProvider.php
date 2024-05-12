<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Directives\GreetingsDirective;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        
        // directive @hello, each time you change or add a directive you have to run the command 'wp acorn view:cache'
        Blade::directive('hello', function($expression){
            // get the params from the expression
            list($name, $lastName) = explode(',', $expression);
            return "{!! \App\View\Directives\GreetingsDirective::greetings($name,$lastName) !!}";
        });

    }

}
