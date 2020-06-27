<?php

class Item extends Product {
    public $amount;             // Number off pieces of the current product in the basket

    function __construct($product, $amount) {
        Parent::__construct($product->type, $product->price);
        $this->amount = $amount;
    }
}