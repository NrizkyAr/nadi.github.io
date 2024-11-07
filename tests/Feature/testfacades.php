<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class testfacades extends TestCase
{
   public function testFacade () {
    $config1 = config('queue.database.table');
    $config2 = Config::get('queue.database.table');

    $this->assertEquals($config1, $config2);
   }

   public function testFacadeDepedency ()
    {
    $config= $this->app->make('config');
    $config3 =$config->get('queue.database.table');


    $config1 = config('queue.database.table');
    $config2 = Config::get('queue.database.table');

    $this->assertEquals($config1, $config2);
    self::assertEquals($config1,$config3);
    self::assertEquals($config2,$config3);
   }


   public function testFacadeMock () {
    config::shouldReceive('get')
    ->with('queue.database.table')
    ->andReturn('jobs');

    $config2 = Config::get('queue.database.table');
    

    $this->assertEquals('jobs', $config2);
   }

}
