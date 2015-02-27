<?php
App::uses('AppController', 'Controller');
/**
 * StockExchanges Controller
 *
 * @property StockExchange $StockExchange
 * @property PaginatorComponent $Paginator
 */
class ExchangeRatesController extends AppController {

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
		$this->StockExchange->recursive = 0;
		$this->set('stockExchanges', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->StockExchange->exists($id)) {
			throw new NotFoundException(__('Invalid stock exchange'));
		}
		$options = array('conditions' => array('StockExchange.' . $this->StockExchange->primaryKey => $id));
		$this->set('stockExchange', $this->StockExchange->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->StockExchange->create();
			if ($this->StockExchange->save($this->request->data)) {
				$this->Session->setFlash(__('The stock exchange has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stock exchange could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->StockExchange->exists($id)) {
			throw new NotFoundException(__('Invalid stock exchange'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->StockExchange->save($this->request->data)) {
				$this->Session->setFlash(__('The stock exchange has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stock exchange could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('StockExchange.' . $this->StockExchange->primaryKey => $id));
			$this->request->data = $this->StockExchange->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->StockExchange->id = $id;
		if (!$this->StockExchange->exists()) {
			throw new NotFoundException(__('Invalid stock exchange'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->StockExchange->delete()) {
			$this->Session->setFlash(__('The stock exchange has been deleted.'));
		} else {
			$this->Session->setFlash(__('The stock exchange could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
