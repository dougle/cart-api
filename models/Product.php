<?php

namespace Model;

class Product
{
	public $code;
	public $prices = [];

	public function __construct($code) {
		$this->code = $code;
	}

	/**
	 * Set the price per quantity from the inventory
	 * @param $price
	 * @param $quantity
	 */
	public function setPrice(float $price, $quantity) {
		$this->prices[$quantity] = (float)$price;
	}

	/**
	 * Calculate the combinations of price and quantity
	 * based on the rules set in the Inventory
	 * @param int $quantity
	 * @return array
	 */
	public function pricePer($quantity = 1) {
		$prices = $this->prices;
		ksort($prices);

		$price_combinations = [];
		foreach (array_reverse($prices, true) as $qty => $price) {
			// this price bracket does not apply
			if ($qty > 1 && $qty > $quantity) {
				continue;
			}

			// total up the number of items we can sell at this price
			$price_combinations[floor($quantity / $qty) * $qty] = $price * floor($quantity / $qty);
			// adjust the remainder for the next iteration
			$quantity = ($quantity % $qty);
		}

		return $price_combinations;
	}
}