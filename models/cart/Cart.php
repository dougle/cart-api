<?php

namespace Model\Cart;

use Model\Product;

class Cart implements \ArrayAccess
{
	protected $items = [];

	// implement methods from ArrayAccess
	public function offsetExists($offset) {
		if ($offset instanceof Product) {
			$offset = $offset->code;
		}

		return isset($this->items[$offset]);
	}

	public function offsetGet($offset) {
		if ($offset instanceof Product) {
			$offset = $offset->code;
		}

		return isset($this->items[$offset]) ? $this->items[$offset] : null;
	}

	// square bracket syntax does not apply to this class
	public function offsetSet($offset, $value) {
		if ($offset instanceof Product) {
			$offset = $offset->code;
		}

		throw new \BadMethodCallException('Setting cart items with square brackets is not supported, use addProduct');
	}

	public function offsetUnset($offset) {
		unset($this->items[$offset]);
	}

	/**
	 * Add a product to the user's cart or
	 * update the quantity of an existing item
	 * @param Product $product
	 * @param int $quantity
	 */
	public function addProduct(Product $product, $quantity = 1) {
		if (!is_int($quantity)) {
			throw new \InvalidArgumentException("Quantities must be integers");
		}

		if (!isset($this[$product->code])) {
			$this->items[$product->code] = new Item($product);
		}

		$this->items[$product->code]->incrementQuantity($quantity);
	}

	/**
	 * Calculate the cart's total taking into account
	 * volume based discounts
	 * @return float
	 */
	public function subTotal() {
		$sub_total = 0;
		foreach ($this->items as $item) {
			$sub_total += $item->totalWithDiscount();
		}
		return $sub_total;
	}
}