<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class configTest extends TestCase
{

    public function testConfig () {
        $firstname = config('example.author.first');
        $lastname = config('example.author.last');
        $email = config('example.email');

        self::assertEquals('iky',$firstname);
        self::assertEquals('ikhsan',$lastname);
        self::assertEquals('rzkyar@gmal.com',$email);
    }
}
