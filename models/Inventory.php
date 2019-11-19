<?php

namespace Model;

use Model\Product;

class Inventory implements \ArrayAccess
{
	protected $products = [];

	public function __construct() {
		// instantiate each product object
		foreach ($this->fetchStock() as $stock_item) {
			$product = new Product($stock_item->code);

			// products may have multiple prices based on purchase volume
			foreach ($stock_item->prices as $item_price) {
				$product->setPrice($item_price->price, $item_price->quantity ?? 1);
			}

			$this[$product->code] = $product;
		}
	}

	// implement methods from ArrayAccess
	public function offsetExists($offset) {
		return isset($this->products[$offset]);
	}

	public function offsetGet($offset) {
		return isset($this->products[$offset]) ? $this->products[$offset] : null;
	}

	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->products[] = $value;
		} else {
			$this->products[$offset] = $value;
		}
	}

	public function offsetUnset($offset) {
		unset($this->products[$offset]);
	}

	/**
	 * Fetch the product list from *ehem* storage
	 * @return array
	 */
	public function fetchStock(): array {
		return json_decode(json_encode([
			[
				'code' => 'ZA',
				'prices' => [
					[
						'price' => 2,
					],
					[
						'price' => 7,
						'quantity' => 4,
					]
				]
			],
			[
				'code' => 'YB',
				'prices' => [
					[
						'price' => 12,
					]
				]
			],
			[
				'code' => 'FC',
				'prices' => [
					[
						'price' => 1.25,
					],
					[
						'price' => 6,
						'quantity' => 6
					]
				]
			],
			[
				'code' => 'GD',
				'prices' => [
					[
						'price' => 0.15,
					],
				]
			],
		]));
	}
}