<?php
App::uses('AppModel', 'Model');
/**
 * Note Model
 *
 * @property Client $Client
 */
class Meeting extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'notEmpty' => array(
				'rule' => array('numeric'),
				//'message' => 'Please enter data.'
				)
			),
		'client_id' => array(
			'notEmpty' => array(
				'rule' => array('numeric'),
				//'message' => 'Please enter data.'
				)
			),
		'startDate' => array(
			'notEmpty' => array(
			'rule' => array('datetime', 'Y-m-d H:i:00'),
				//'message' => 'Please enter data.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'duration' => array(
			'notEmpty' => array(
				'rule' => array('numeric'),
				//'message' => 'Please enter data.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)));

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
