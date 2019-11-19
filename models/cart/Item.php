<?php

namespace Model\Cart;

use Model\Product;

class Item
{
	protected $product;
	protected $quantity = 0;

	public function __construct(Product $product) {
		$this->product = $product;
	}

	public function incrementQuantity(int $quantity) {
		$this->quantity += $quantity;
	}

	public function totalWithDiscount() {
		return array_sum($this->product->pricePer($this->quantity));
	}
}