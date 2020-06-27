<?php

class Product {
    public $type;
    public $price;

    function __construct($type, $price) {
        $this->type = $type;
        $this->price = $price;
    }
}