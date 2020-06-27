<?php

// Use some kind of Strategy pattern

class Voucher {
    public $type;       // Voucher type for strategy application
    public $applied;    // Avoid applying multiple time the same Voucher

    function __construct($type) {
        $this->type = $type;
        $this->applied = false;
    }

    // TODO: Decide if apply all the Vouchers at the end, or one by one (this could change the total and which ones apply or not)
    // Following the given examples the order is defined for each call
    public function apply($basket, $total) { // V, R, S
        $discount = 0; // No discount by default
        switch($this->type) {
            case 'V': // (10% off discount voucher for the second unit applying only to product type A)
                if (!$this->applied && isset($basket->products['A']) && $basket->products['A']->amount > 1) {
                    $this->applied = true;
                    $discount += ($basket->products['A']->price / 10);
                }
                return $discount;
            case 'R': // (5€ off discount on product type B)
                if (!$this->applied && $total > 40) {
                    $this->applied = true;
                    $discount = 5;
                }
                return $discount;
            case 'S': // (5% off discount on a cart value over 40€)
                if (!$this->applied && $total > 40) {
                    $this->applied = true;
                    $discount = $total * 5/100;
                }
                return $discount;
            default:
                return $discount;
        }
    }
}