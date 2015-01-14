<?php
App::uses('StockExchange', 'Model');

/**
 * StockExchange Test Case
 *
 */
class StockExchangeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.stock_exchange'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StockExchange = ClassRegistry::init('StockExchange');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StockExchange);

		parent::tearDown();
	}

}
