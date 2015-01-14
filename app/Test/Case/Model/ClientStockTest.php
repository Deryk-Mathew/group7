<?php
App::uses('ClientStock', 'Model');

/**
 * ClientStock Test Case
 *
 */
class ClientStockTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.client_stock',
		'app.client',
		'app.user',
		'app.group',
		'app.balance',
		'app.note',
		'app.stock',
		'app.stock_exchange'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClientStock = ClassRegistry::init('ClientStock');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientStock);

		parent::tearDown();
	}

}
