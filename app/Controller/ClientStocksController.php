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
		$this->ClientStock->recursive = 2;
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
	$this->ClientStock->recursive = 2;
		if (!$this->ClientStock->exists($id)) {
			throw new NotFoundException(__('Invalid client stock'));
		}
		//$p_plan = $this->ClientStock->find('all', array('contain' => array('Stock')));
		$options = array('conditions' => array('ClientStock.' . $this->ClientStock->primaryKey => $id));
		$this->set('clientStock', $this->ClientStock->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ClientStock->create();
			if ($this->ClientStock->save($this->request->data)) {
				$this->Session->setFlash(__('The client stock has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client stock could not be saved. Please, try again.'));
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


	public function buyStock($id, $lastTradePriceOnly) {

		$var = $this->Session->read('current_client');

		$this->ClientStock->create();
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['ClientStock']['client_id'] = $var;	
			$this->request->data['ClientStock']['stock_id'] = $id;
			$this->request->data['ClientStock']['cost'] = $lastTradePriceOnly;
			if ($this->ClientStock->save($this->request->data)) {
				$this->Session->setFlash(__('The client stock has been purchased.'));
				return $this->redirect(array('controller' => 'clients', 'action' => 'view', $var));
			} else {
				$this->Session->setFlash(__('The client stock could not be purchased. Please, try again.'));
			}
		}
	}
/*
	public function view2(){
		$db = $this->ClientStock->getDataSource();
		$db->fetchAll(
    	'SELECT client_stocks.quantity, client_stocks.cost, client_stocks.purchase, stocks.name, stocks.symbol 
    	FROM `client_stocks` join `stocks` 
    	on client_stocks.stock_id=stocks.id 
    	where client_stocks.client_id=1 
    	group by stocks.name');
		
	//	$this->Client->recursive = 0;
		$this->set('client', $this->ClientStocks->find('first', $db),  $this->Paginator->paginate());
		//debug($db);
	}
*/
}
