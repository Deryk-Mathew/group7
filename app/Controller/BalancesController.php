<?php
App::uses('AppController', 'Controller');
/**
 * Balances Controller
 *
 * @property Balance $Balance
 * @property PaginatorComponent $Paginator
 */
class BalancesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Common');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Balance->recursive = 0;
		$this->set('balances', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {

		if (!$this->Balance->exists($id)) {
			throw new NotFoundException(__('Invalid balance'));
		}
		$options = array('conditions' => array('Balance.' . $this->Balance->primaryKey => $id));
		$this->set('balance', $this->Balance->find('first', $options));

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$var = $this->Session->read('current_client');
		if ($this->request->is('post')) {
			$this->request->data['Balance']['client_id'] = $var;
			$this->Balance->create();
			if ($this->Balance->save($this->request->data)) {
				$this->Session->setFlash(__('The balance has been saved.'));
				return $this->redirect(array('controller' => 'clients', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The balance could not be saved. Please, try again.'));
			}
		}
		$clients = $this->Balance->Client->find('list');
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
		
		if (!$this->Balance->exists($id)) {
			throw new NotFoundException(__('Invalid balance'));
		}
		$this->request->data['Balance']['id'] = $id;
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Balance->save($this->request->data)) {
				$this->Session->setFlash(__('The balance has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The balance could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Balance.' . $this->Balance->primaryKey => $id));
			$this->request->data = $this->Balance->find('first', $options);
		}
		$clients = $this->Balance->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Balance->id = $id;
		if (!$this->Balance->exists()) {
			throw new NotFoundException(__('Invalid balance'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Balance->delete()) {
			$this->Session->setFlash(__('The balance has been deleted.'));
		} else {
			$this->Session->setFlash(__('The balance could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	/* Method to deposit cash into an account */
	public function deposit($id = null){
		$cc = $this->Session->read('current_client');

		if (!$this->Balance->exists($id)) {
			$this->add();
			//throw new NotFoundException(__('Invalid balance'));
		}

		if ($this->request->is(array('post', 'put'))) {

			$tmp = $this->Balance->read('cash_balance', $id); //read current balance
			$var = $this->request->data['Balance']['cash_balance']; // read amount to be added to balance

			// Call mathsAdd component to add the numbers together
			$this->request->data['Balance']['cash_balance'] = $this->Common->mathsAdd($tmp['Balance']['cash_balance'], $var);

			// save the data to the database
			if ($this->Balance->save($this->request->data)) {
				$this->Session->setFlash(__('The balance has been saved.'));
				return $this->redirect(array('controller' => 'clients', 'action' => 'view', $cc));
			} else {
				$this->Session->setFlash(__('The balance could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Balance.' . $this->Balance->primaryKey => $id));
			$this->request->data = $this->Balance->find('first', $options);
		}

	}
	

	/* Method to withdraw cash from an account*/
	public function withdraw($id = null){
		$cc = $this->Session->read('current_client');

		if (!$this->Balance->exists($id)) {
			throw new NotFoundException(__('Invalid balance'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$tmp = $this->Balance->read('cash_balance', $id);
			$var = $this->request->data['Balance']['cash_balance'];
			
			$this->request->data['Balance']['cash_balance'] = $this->Common->mathsSub($tmp['Balance']['cash_balance'], $var);

			// Check if account does not pass 0 
			if ($this->request->data['Balance']['cash_balance'] >= 0){	
				if ($this->Balance->save($this->request->data)) {
					$this->Session->setFlash(__('The balance has been saved.'));
					return $this->redirect(array('controller' => 'clients', 'action' => 'view', $cc));
				} else {
					$this->Session->setFlash(__('The balance could not be saved. Please, try again.'));
					}
			} else {
				$this->Session->setFlash(__('Insuficient balance. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Balance.' . $this->Balance->primaryKey => $id));
			$this->request->data = $this->Balance->find('first', $options);
		}
	}
}
