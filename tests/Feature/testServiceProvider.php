<?php

namespace Tests\Feature;
use App\data\foo;
use App\data\bar;
use App\services\helloService;
use App\services\helloServiceIDN;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class testServiceProvider extends TestCase
{
    public function   testProvider (){

        $foo1 = $this->app->make(foo::class);
        $foo2 = $this->app->make(foo::class);

        $this->assertEquals($foo1, $foo2);

        
        $bar1 = $this->app->make(bar::class);
        $bar2 = $this->app->make(bar::class);
        
        self::assertEqualsIgnoringCase('hello and bar', $bar1->bar());
        self::assertSame($foo1, $bar1->foo);
        self::assertSame($foo2, $bar2->foo);

    }

        public function testProviderInterface () {
        $helloService = $this->app->make(helloService::class);

        self::assertEquals('hallo iki', $helloService->hello('iky'));

    }
}
