<?php
App::uses('AppModel', 'Model');
/**
 * Client Model
 *
 * @property User $User
 * @property Balance $Balance
 * @property ClientStock $ClientStock
 * @property Note $Note
 */
class Client extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'NINum' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Please enter data.'
				),
			'Invalid NI' => array(
				'rule' => array('validNi'),
				'message' => 'Please enter a valid NI number i.e. AB123456C',
				),
			'unique' => array(
                'rule' => array('isUnique'),
				'message' => 'This client is already registered. Please contact admin to add client.',
				'on' => 'create' // Limit validation to 'create' or 'update' operations
				),
			),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Please enter data.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'street' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Please enter data.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'town' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Please enter data.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'county' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Please enter data.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'postcode' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Please enter data.',
				),
			'postcode' => array(
        		'rule' => array('postal', null, 'uk'),
        		'message' => 'Please enter a valid postcode.'
    		),
			/*'Invalid Postcode' => array(
				'rule' => array('validPostcode'),
				'message' => 'Please enter a valid postcode i.e. AB12 3CD',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
		),
	);

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

	);

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Balance' => array(
			'className' => 'Balance',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ClientStock' => array(
			'className' => 'ClientStock',
			'foreignKey' => 'client_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Note' => array(
			'className' => 'Note',
			'foreignKey' => 'client_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Meetings' => array(
			'className' => 'Meetings',
			'foreignKey' => 'client_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'TransactionRecord' => array(
			'className' => 'TransactionRecord',
			'foreignKey' => 'client_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
    

	public function validNi($check){
		$value = array_values($check);
		$value = $value[0];
		return preg_match('/^[ABCEGHJ-PRSTW-Z][ABCEGHJ-NPRSTW-Z]\d{6}[A-D]$/', $value);
	}

	
	public function custFind(){
		$var = $this->Auth->user('id');
		$clients = $this->Client->findAllByUserId($var);
	}
	
}
