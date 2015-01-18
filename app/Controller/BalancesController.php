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
	public $components = array('Paginator');

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
				return $this->redirect(array('action' => 'index'));
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
		$var = $this->Session->read('current_client');
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
	public function deposit($id){

	}

	/* Method to withdraw cash from an account*/
	public function withdraw(){

	}
}
