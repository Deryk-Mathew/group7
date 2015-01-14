<?php
App::uses('AppController', 'Controller');
/**
 * ClientStocks Controller
 *
 * @property ClientStock $ClientStock
 * @property PaginatorComponent $Paginator
 */
class ClientStocksController extends AppController {

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
		$this->ClientStock->recursive = 0;
		$this->set('clientStocks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ClientStock->exists($id)) {
			throw new NotFoundException(__('Invalid client stock'));
		}
		$options = array('conditions' => array('ClientStock.' . $this->ClientStock->primaryKey => $id));
		$this->set('clientStock', $this->ClientStock->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id) {
		if ($this->request->is('post')) {
			$this->ClientStock->create();
			$this->request->data['ClientStock']['client_id'] = $id;		
			if ($this->ClientStock->save($this->request->data)) {
				$this->Session->setFlash(__('The client stock has been saved.'));
				return $this->redirect(array('controller' => 'clients', 'action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The client stock could not be saved. Please, try again.'));
			}
		}
		$stocks = $this->ClientStock->Stock->find('list');
		$this->set(compact('stocks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ClientStock->exists($id)) {
			throw new NotFoundException(__('Invalid client stock'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClientStock->save($this->request->data)) {
				$this->Session->setFlash(__('The client stock has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client stock could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ClientStock.' . $this->ClientStock->primaryKey => $id));
			$this->request->data = $this->ClientStock->find('first', $options);
		}
		$clients = $this->ClientStock->Client->find('list');
		$stocks = $this->ClientStock->Stock->find('list');
		$this->set(compact('clients', 'stocks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ClientStock->id = $id;
		if (!$this->ClientStock->exists()) {
			throw new NotFoundException(__('Invalid client stock'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ClientStock->delete()) {
			$this->Session->setFlash(__('The client stock has been deleted.'));
		} else {
			$this->Session->setFlash(__('The client stock could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
