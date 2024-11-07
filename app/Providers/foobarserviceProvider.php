<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\data\foo;
use App\data\bar;
use App\services\helloService;
use App\services\helloServiceIDN;
use Illuminate\Contracts\Support\DeferrableProvider;

class foobarserviceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        helloService::class => helloServiceIDN::class
    ];
    public function register()
    {
        $this->app->singleton(foo::class, function($app){
            return new foo();
        });
    
        $this->app->singleton(bar::class, function($app) {
            $foo = $app->make(foo::class);
            return new bar($foo);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides() {
        return [helloService::class, foo::class];
    }
}
