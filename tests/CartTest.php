<?php

namespace tests;

use Controller\CartController;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
	private static $cart_controller;

	/**
	 * Create a fresh instance of the cart controller for all tests
	 */
	public function setUp() {
		self::$cart_controller = new CartController();
	}

	/**
	 * Reset the controller
	 */
	public function tearDown() {
		self::$cart_controller = null;
	}

	/**
	 * Map the provided arrays into input expected from a frontend api call
	 * @param array $codes
	 * @return array
	 */
	private function mapProductCodes(array $codes) {
		return array_map(function ($code) {
			return ['code' => $code];
		}, $codes);
	}

	/**
	 * Test certain product combinations
	 */
	public function testCartSubtotalScenarioOne() {
		$product_codes = $this->mapProductCodes(['ZA', 'YB', 'FC', 'GD', 'ZA', 'YB', 'ZA', 'ZA']);

		$response = self::$cart_controller->subtotal($product_codes);
		$this->assertEquals(32.4, $response);
	}

	/**
	 * Test certain product combinations
	 */
	public function testCartSubtotalScenarioTwo() {
		$product_codes = $this->mapProductCodes(['FC', 'FC', 'FC', 'FC', 'FC', 'FC', 'FC']);

		$response = self::$cart_controller->subtotal($product_codes);
		$this->assertEquals(7.25, $response);
	}


	/**
	 * Test certain product combinations
	 */
	public function testCartSubtotalScenarioThree() {
		$product_codes = $this->mapProductCodes(['ZA', 'YB', 'FC', 'GD']);

		$response = self::$cart_controller->subtotal($product_codes);
		$this->assertEquals(15.4, $response);
	}
}