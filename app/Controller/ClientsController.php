<?php
App::uses('AppController', 'Controller');
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
	
	
		/**
 * dashboard function
 *
 * @throws NotFoundException
 * @return void
 */
	public function dashboard() {
		$this->Client->recursive = 0;

		if ($this->Auth->user('group_id') == 2) {
			$id = $this->Auth->user('id');
			$options = array('conditions' => array('Meetings.user_id' => $id));
		    $this->set('meetings', $this->Client->Meetings->find('first', $options));
		}else{
			$this->set('clients', $this->Paginator->paginate());
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
		$options = array('conditions' => array('Balance.' . $this->Client->Balance->primaryKey => $id));
		$this->set('balance', $this->Client->Balance->find('first', $options));
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		$this->set('client', $this->Client->find('first', $options));
	}
	
	public function portfolio($id = null,$name = null) {
		$this->Client->recursive = 2;
		$this->Session->write('current_client', $id);
		$this->Session->write('current_client_name', $name);
		$options = array('conditions' => array('Balance.' . $this->Client->Balance->primaryKey => $id));
		$this->Session->write('balance',$this->Client->Balance->find('first',$options)['Balance']['cash_balance']);
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
		if ($this->request->is('post')) {
			$this->Client->create();
			
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__('The client has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
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
				return $this->redirect(array('action' => 'index'));
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

	