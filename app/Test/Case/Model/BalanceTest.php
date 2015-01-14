<?php
App::uses('Balance', 'Model');

/**
 * Balance Test Case
 *
 */
class BalanceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.balance',
		'app.client',
		'app.user',
		'app.group',
		'app.note'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Balance = ClassRegistry::init('Balance');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Balance);

		parent::tearDown();
	}

}
