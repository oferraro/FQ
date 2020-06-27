<?php

class Basket {
    public $products; // An array of Product
    private $vouchers; // An array of Voucher types

    function __construct() {
        $this->products = [];
    }

    function addItem($product) {
        $item = new Item($product, 1);
        if (isset($this->products[$item->type])) {
            $item->amount = $this->products[$item->type]->amount + 1;
        }
        $this->products[$item->type] = $item;
    }

    function addVoucher($voucher) {
        $this->vouchers = is_array($this->vouchers) ? $this->vouchers : [];
        $this->vouchers[] = new Voucher($voucher);
    }

    function getSubTotal() {
        $total = 0;
        foreach ($this->products as $item) {
            $total += $item->price * $item->amount;
        }
        return $total;
    }

    public function applyVouchers($total, $type) {
        foreach($this->vouchers as $voucher) {
            if ($voucher->type == $type) {
                $discount = $voucher->apply($this, $total);
                $total = $total - $discount;
            }
        }
        return $total;
    }

    public function getTotal() { // Note: Discounts apply in order, that's why it's called multiple times with type specified
        $discountsApplied = [];
        $subTotal = $this->getSubTotal();
        $subTotal2 = $this->applyVouchers($subTotal, 'V');
        if ($subTotal2 != $subTotal) {
            $discountsApplied[] = 'V';
        }
        $subTotal3 = $this->applyVouchers($subTotal2, 'R');
        if ($subTotal3 != $subTotal2) {
            $discountsApplied[] = 'R';
        }
        $total = $this->applyVouchers($subTotal3, 'S');
        if ($subTotal3 != $total) {
            $discountsApplied[] = 'S';
        }
        return [
            'subTotal' => $subTotal,
            'total' => number_format($total, 2),
            'discounts' => join(', ', $discountsApplied)
        ];
    }

}