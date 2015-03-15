<?php
App::uses('AppController', 'Controller');
/**
 * Notes Controller
 *
 * @property Note $Note
 * @property PaginatorComponent $Paginator
 */
class MeetingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Meeting->recursive = 0;
		

			/* Display only clients user has */
			$var = $this->Auth->user('id');
			$this->paginate = array(
	        	'conditions' => array('Meeting.user_id' => $var),
	        	'limit' => 1000
	        	
	    	);
		    $this->set('meetings', $this->paginate($this->Meeting));
			$options = array('conditions' => array('Client.user_id'  => $var));
			$clients = $this->Meeting->Client->find('all', $options);
			foreach($clients as $client):
				$name[$client['Client']['id']] =  $client['Client']['name'];
			endforeach;
			$this->set('clients', $name);
		
	}
	
	
	public function browse() {
		$this->Meeting->recursive = 0;
		

			/* Display only clients user has */
			$var = $this->Auth->user('id');
			$this->paginate = array(
	        	'conditions' => array('Meeting.user_id' => $var),
	        	'limit' => 1000
	        	
	    	);
		    $this->set('meetings', $this->paginate($this->Meeting));
			$options = array('conditions' => array('Client.user_id'  => $var));
			$clients = $this->Meeting->Client->find('all', $options);
			foreach($clients as $client):
				$name[$client['Client']['id']] =  $client['Client']['name'];
			endforeach;
			$this->set('clients', $name);
		
	}
	
	
	/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Meeting->exists($id)) {
			throw new NotFoundException(__('Invalid Meeting'));
		}
		$options = array('conditions' => array('Meeting.' . $this->Meeting->primaryKey => $id));
		$this->set('meeting', $this->Meeting->find('first', $options));
		
		$this->loadModel('Client');
		$this->Meeting->recursive = 0;


			/* Display only clients user has */
			$var = $this->Auth->user('id');
		$options2 = array('conditions' => array('Client.user_id'  => $var));
			$clients = $this->Meeting->Client->find('all', $options2);
			foreach($clients as $client):
				$name[$client['Client']['id']] =  $client['Client']['name'];
			endforeach;
			$this->set('clients', $name);
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$currentUser = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$this->Meeting->create();
            $this->request->data['Meeting']['user_id'] = $currentUser;
			if ($this->Meeting->save($this->request->data)) {
				$this->Session->setFlash(__('The Meeting has been saved.'));
				return $this->redirect(array( 'controller' => 'meetings', 'action' => 'index'));
			} else {
			var_dump($this->Meeting->data['Meeting']);
				$this->Session->setFlash(__('The Meeting could not be saved. Please, try again.'));
			}
		}
		$this->loadModel('User');
		$clients = $this->User->Client->find('list',array(
    'conditions' => array('Client.user_id' => $currentUser)));
		$this->set(compact('clients'));
	

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
	
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Meeting->id = $id;
		if (!$this->Meeting->exists()) {
			throw new NotFoundException(__('Invalid Meeting'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Meeting->delete()) {
			$this->Session->setFlash(__('The meeting has been cancelled.'));
		} else {
			$this->Session->setFlash(__('The meeting could not be cancelled. Please, try again.'));
		}
		return $this->redirect(array('action' => 'browse'));
	}

}
