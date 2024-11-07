<?php 

namespace App\data;

class bar {
    public foo $foo;
    public function __construct(foo $foo)
    {
        $this->foo = $foo;
    }
    
    function bar() :string {
        return $this->foo->foo() . ' and Bar';
    }
}