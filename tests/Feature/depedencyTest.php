<?php

namespace Tests\Feature;

use App\data\foo;
use App\data\bar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class depedencyTest extends TestCase
{
  
    public function testDepedency () {

        $foo = new foo();
        $bar =new bar($foo);
        
        self::assertEquals('Foo and Bar', $bar->bar());
    }
}
