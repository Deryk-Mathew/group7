<?php
App::uses('StockExhange', 'Model');

/**
 * StockExhange Test Case
 *
 */
class StockExhangeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.stock_exhange'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StockExhange = ClassRegistry::init('StockExhange');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StockExhange);

		parent::tearDown();
	}

}
