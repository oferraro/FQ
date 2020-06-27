<?php

/*
 --- Entities ---
- basket, it has the items (which are products with the amount of them) and vouchers (to discount)
- product, just type of products and values
- voucher, has the type and the code to apply each type
*/

spl_autoload_register(function($className) {
    include_once $className . '.php';
});

// TODO: Check if Vouchers are added by user, if applies automatically when conditions matches or it depends on each user conditions

$products = [];
$products['A'] = new Product('A', 10);
$products['B'] = new Product('B', 8);
$products['C'] = new Product('C', 12);

echo "\n----------- CASE 1 -----------\n";
$basket = new Basket();
$basket->addItem($products['A']);
$basket->addItem($products['C']);
$basket->addItem($products['A']);
$basket->addItem($products['B']);
$basket->addVoucher('S');
$basket->addVoucher('V');

print_r ($basket->getTotal());

echo "\n\n----------- CASE 2 -----------\n";
$basket2 = new Basket();
$basket2->addItem($products['A']); // § Product A added
$basket2->addItem($products['A']); // § Product A added
$basket2->addItem($products['B']);  // § Product B added
$basket2->addItem($products['C']); // § Product C added
$basket2->addItem($products['C']); // § Product C added
$basket2->addItem($products['C']); // § Product C added

$basket2->addVoucher('S'); // § Voucher S added
$basket2->addVoucher('V'); // § Voucher V added
$basket2->addVoucher('R'); // § Voucher R added

print_r($basket2->getTotal());
