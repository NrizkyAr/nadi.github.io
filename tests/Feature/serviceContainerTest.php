<?php

namespace Tests\Feature;

use App\data\foo;
use App\data\bar;
use App\data\person;
use App\services\helloService;
use App\services\helloServiceIDN;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class serviceContainerTest extends TestCase
{
    public function testService () {
        $foo1 =$this->app->make(foo::class);   // new foo()
        $foo2 =$this->app->make(foo::class); // new foo()

        self::assertEquals("hello",  $foo1->foo());
        self::assertEquals('foo', $foo2->foo());
        self::assertNotSame($foo1,$foo2);

    }

    public function testBind () {
    // $person =$this->app->make(person::class); // new person()
    // self::assertNotNull($person);

    $this->app->bind(person::class, function ($app) {
        return new person('gui','nandi');
    });

    $person1=$this->app->make(person::class); //closure() //new person('fssa', 'asfasf')
    $person2=$this->app->make(person::class); //closure() //new person('fssa', 'asfasf') 

        self::assertEquals("gur",  $person1->firstName);
        self::assertEquals('nandi', $person2->lastName);
        self::assertNotSame($person1,$person2);

    } 

     public function testSingleton() {
   
    $this->app->singleton(person::class, function ($app) {
        return new person('gui','nandi');
    });

    $person1=$this->app->make(person::class); //closure() //new person('fssa', 'asfasf') if not exitstis
    $person2=$this->app->make(person::class);  // return existing
    $person3=$this->app->make(person::class);  // return existing
    $person4=$this->app->make(person::class);  // return existing


        self::assertEquals('gur',  $person1->firstName);
        self::assertEquals('nandi', $person2->lastName);
        self::assertSame($person1,$person2);
}

public function testInstance() {
   
    $ver = new person('kai' , 'banjar');
    $this->app->instance(person::class, $ver);

    $person1=$this->app->make(person::class); // mengembalikan object $ver
    $person2=$this->app->make(person::class);  // mengembalikan object $ver
    $person3=$this->app->make(person::class);  // mengembalikan object $ver
    $person4=$this->app->make(person::class);  // mengembalikan object $ver


        self::assertEquals('kai',  $person1->firstName);
        self::assertEquals('banjar', $person2->lastName);
        self::assertSame($person1,$person2);
}

public function testDepedencyInjection () {

$this->app->singleton(foo::class, function($app){
    return new foo();
});

    $foo =$this->app->make(foo::class);
    $bar =$this->app->make(bar::class);

    self::assertSame($foo, $bar->foo);
}

public function testDepedencyInjectionClosure () {

    $this->app->singleton(foo::class, function($app){
        return new foo();
    });

    $this->app->singleton(bar::class, function($app) {
        $foo = $app->make(foo::class);
        return new bar($foo);
    });
    
        $foo =$this->app->make(foo::class);
        $bar1 =$this->app->make(bar::class); 
        $bar2 =$this->app->make(bar::class);
    
        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1,$bar2);
    }

    public function testHelloService() {
         
        $this->app->singleton(helloService::class, helloServiceIDN::class);

        // $this->app->singleton(helloService::class, function ($app) {
        //     return new helloServiceIDN();
        // });

        $helloService = $this->app->make(helloService::class);

        self::assertEquals('hallo iky', $helloService->hello('iky'));
    }


}