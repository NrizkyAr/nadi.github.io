<?php 

namespace App\services;

class helloServiceIDN implements helloService {

    public function hello (string $name) :string {
        return "hallo $name";
    }
}