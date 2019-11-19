<?php

namespace Controller;

use Model\Cart\Cart;
use Model\Inventory;
use http\Client\Response;

class CartController
{

	/**
	 * Total up the products in the cart and output a total
	 * Normally injecting the request would be more suitable here
	 *
	 * @param $product_codes array
	 */
	public function subtotal(array $product_codes) {
		$inventory = new Inventory();
		$cart = new Cart();

		// clean and validate cart
		foreach ($product_codes as $cart_item) {
			// invalid/unrecognised product code
			if (!isset($inventory[$cart_item['code']])) {
				http_response_code(400);
				exit;
			}

			$cart->addProduct($inventory[$cart_item['code']]);
		}

		// return the subtotal
		return $cart->subTotal();
	}
}