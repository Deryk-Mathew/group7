<?php
/**
 * StockFixture
 *
 */
class StockFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'averageDailyVolume' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'change' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'daysLow' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'daysHigh' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'yearsLow' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'marketCapatalization' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'lastTradePriceOnly' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'daysRange' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'symbol' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 4, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'volume' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'stockExchange_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'symbol' => array('column' => 'symbol', 'unique' => 1),
			'stockExchange_id' => array('column' => 'stockExchange_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'averageDailyVolume' => 1,
			'change' => 'Lorem ip',
			'daysLow' => 1,
			'daysHigh' => 1,
			'yearsLow' => 1,
			'marketCapatalization' => 'Lorem ipsum dolor ',
			'lastTradePriceOnly' => 1,
			'daysRange' => 'Lorem ipsum dolor ',
			'name' => 'Lorem ipsum dolor sit amet',
			'symbol' => 'Lo',
			'volume' => 1,
			'stockExchange_id' => 1
		),
	);

}
