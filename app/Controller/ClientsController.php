<?php
App::uses('AppController', 'Controller');
App::uses('DboSource', 'Model/DataSource');
App::import('Controller', 'Balances');
App::import('Controller', 'Meetings');
/**
 * Clients Controller
 *
 * @property Client $Client
 * @property PaginatorComponent $Paginator
 */
class ClientsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Auth');


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Session->delete('current_client');
		$this->Client->recursive = 0;

		if ($this->Auth->user('group_id') == 2) {

			/* Display only clients user has */
			$var = $this->Auth->user('id');
			$this->paginate = array(
	        	'conditions' => array('Client.user_id' => $var),
	        	'limit' => 10
	        	
	    	);
		    $this->set('clients', $this->paginate($this->Client));
		}else{
			$this->set('clients', $this->Paginator->paginate());
		}
	}


	public function browse() {
		$this->Session->delete('current_client');
		$this->Client->recursive = 0;

		if ($this->Auth->user('group_id') == 2) {

			/* Display only clients user has */
			$var = $this->Auth->user('id');
			$this->paginate = array(
	        	'conditions' => array('Client.user_id' => $var),
	        	'limit' => 10
	        	
	    	);
		    $this->set('clients', $this->paginate($this->Client));
		}else{
			$this->set('clients', $this->Paginator->paginate());
		}
	}
	
	
	public function ajaxRecData() {
		$this->autoRender = false;        
		$options = array('conditions' => array('TransactionRecord.client_id' => $this->Session->read('current_client')));		
        $data = $this->Client->TransactionRecord->find('all', $options);
        echo json_encode($data);
	}
	
	
	
		/**
 * dashboard function
 *
 * @throws NotFoundException
 * @return void
 */
	public function dashboard() {
		
		if ($this->Auth->user('group_id') == 2) {
		$this->loadModel('Meeting');
		$this->Meeting->recursive = 0;


			/* Display only clients user has */
			$var = $this->Auth->user('id');
			$this->paginate = array(
	        	'conditions' => array('Meeting.user_id' => $var),
	        	'limit' => 1000
	        	
	    	);
		    $this->set('meetings', $this->paginate($this->Meeting));
		    
		    $var = $this->Auth->user('id');
		$options2 = array('conditions' => array('Client.user_id'  => $var));
			$clients = $this->Meeting->Client->find('all', $options2);
			foreach($clients as $client):
				$name[$client['Client']['id']] =  $client['Client']['name'];
			endforeach;
			$this->set('clients', $name);
		    
		    
		    
		    
		    $this->loadModel('Stock');
		    $this->paginate = array(
                 'order' => array('Stock.change' => 'DESC'),
                 'limit' => 10
                 );
			$this->set('topStocks', $this->paginate($this->Stock));
	}

		if ($this->Auth->user('group_id') == 1) {

			/* Display only clients user has */
			$var = $this->Auth->user('id');
			$this->paginate = array(
	        	'conditions' => array('Client.user_id' => '1'),
	        	'limit' => 1000
	        	
	    	);
		    $this->set('clients', $this->paginate($this->Client));
		}
		
		
		

	}
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function profile($id = null,$name = null) {
		$this->Client->recursive = 2;
		$this->Session->write('current_client', $id);
		$this->Session->write('current_client_name', $name);
		$options = array('conditions' => array('Balance.client_id' => $id));
		$balance = $this->Client->Balance->find('first',$options);
		$this->Session->write('balance',$balance['Balance']['cash_balance']);
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		$this->set('client', $this->Client->find('first', $options));
	}
	
	public function portfolio($id = null,$name = null) {
		$this->Client->recursive = 4;
		$this->Session->write('current_client', $id);
		$this->Session->write('current_client_name', $name);
		$options = array('conditions' => array('Balance.client_id' => $id));
		$balance = $this->Client->Balance->find('first',$options);
		$this->Session->write('balance',$balance['Balance']['cash_balance']);
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		$this->set('client', $this->Client->find('first', $options));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->request->data['Client']['user_id'] = $this->Auth->user('id');
		$this->request->data['Client']['balance'] = 0.00;
		$db = ConnectionManager::getDataSource('default');
		$this->request->data['Client']['registered'] = $db->expression('SYSDATE()');
		if ($this->request->is('post')) {
			$this->Client->create();
			if ($this->Client->save($this->request->data)) {
				$BalanceCon = new BalancesController;
				$BalanceCon->create($this->Client->id);
				$this->Session->setFlash(__('The client has been saved.'));
				return $this->redirect(array('controller' => 'clients','action' => 'browse'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.','error'));
			}
		}
		$users = $this->Client->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {

		$var = $this->Auth->user('id');

		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Client']['id'] = $id;
			$this->request->data['Client']['user_id'] = $var;
			
			if ($this->Client->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The client has been saved.'));
				return $this->redirect(array('action' => 'profile',$id,$this->request->data['Client']['name']));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
			$this->request->data = $this->Client->find('first', $options);
		}
		$users = $this->Client->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Client->delete()) {
			$this->Session->setFlash(__('The client has been deleted.'));
		} else {
			$this->Session->setFlash(__('The client could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


/**
 * remove method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function remove($id = null) {
		$this->Client->id = $id;
		//$this->request->data['Client']['user_id'] = null;
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->request->allowMethod('post')){
			if ($this->Client->saveField('user_id', '1')) {
				$this->Session->setFlash(__('The client has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}

		}
	}
	
	
	

}

	
