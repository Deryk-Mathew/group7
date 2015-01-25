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
	public $components = array('Paginator', 'Common');

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

	/* Function to buy Stock incomplete 24/01/15 */

	public function buyStock($client_id, $id) {

		$conditions = array('ClientStock.client_id' => $client_id, 'ClientStock.stock_id' => $id);

		// Check client_stock table in database to see if client holds specific stock
		if ($this->ClientStock->hasAny($conditions)){

			$specificallyThisOne = $this->ClientStock->find('first', array('conditions' => $conditions));

			debug($specificallyThisOne);

			if($this->request->is(array('post', 'put'))) {

				$this->request->data['ClientStock']['id'] = $specificallyThisOne['ClientStock']['id'];
				$this->request->data['ClientStock']['client_id'] = $specificallyThisOne['ClientStock']['client_id'];
				$this->request->data['ClientStock']['stock_id'] = $specificallyThisOne['ClientStock']['stock_id'];

				$temp = $this->request->data['ClientStock']['quantity'] * $specificallyThisOne['Stock']['lastTradePriceOnly'];

				$var = $specificallyThisOne['ClientStock']['cost'];

				$this->request->data['ClientStock']['cost'] = $this->Common->mathsAdd($var, $temp);

				$this->request->data['ClientStock']['quantity'] = $this->Common->mathsAdd($specificallyThisOne['ClientStock']['quantity'], $this->request->data['ClientStock']['quantity']);

				if ($this->ClientStock->save($this->request->data)) {
					$this->Session->setFlash(__('The client stock has been purchased.'));
					return $this->redirect(array('controller' => 'clients', 'action' => 'view', $specificallyThisOne['ClientStock']['client_id']));
				} else {
					$this->Session->setFlash(__('The client stock could not be purchased. Please, try again.'));
				} 
			}

		} else{
			$cost = $this->ClientStock->Stock->read('lastTradePriceOnly', $id);

			debug($cost);

			if ($this->request->is(array('post', 'put'))) {
				$this->ClientStock->create();

					$this->request->data['ClientStock']['client_id'] = $client_id;
					$this->request->data['ClientStock']['stock_id'] = $id;

					$this->request->data['ClientStock']['cost'] = $this->request->data['ClientStock']['quantity'] * $cost['Stock']['lastTradePriceOnly'];
					
				if ($this->ClientStock->save($this->request->data)) {
					$this->Session->setFlash(__('The client stock has been purchased.'));
					return $this->redirect(array('controller' => 'clients', 'action' => 'view', $client_id));
			} else {
				$this->Session->setFlash(__('The client stock could not be saved. Please, try again.'));
				}
			}
		}
	}

	/* Function to sell stock Incomplete 24/01/15 */

	public function sellStock($client_id, $id){

		// search conditions
		$conditions = array('ClientStock.client_id' => $client_id, 'ClientStock.stock_id' => $id);

		if ($this->ClientStock->hasAny($conditions)){

			$specificallyThisOne = $this->ClientStock->find('first', array('conditions' => $conditions));		

			if($this->request->is(array('post', 'put'))) {

				if($this->request->data['ClientStock']['quantity'] < $specificallyThisOne['ClientStock']['quantity'] or $this->request->data['ClientStock']['quantity'] == $specificallyThisOne['ClientStock']['quantity']){

					$this->request->data['ClientStock']['id'] = $specificallyThisOne['ClientStock']['id'];
					$this->request->data['ClientStock']['client_id'] = $specificallyThisOne['ClientStock']['client_id'];
					$this->request->data['ClientStock']['stock_id'] = $specificallyThisOne['ClientStock']['stock_id'];

					$temp = $this->request->data['ClientStock']['quantity'] * $specificallyThisOne['Stock']['lastTradePriceOnly'];

					$var = $specificallyThisOne['ClientStock']['cost'];

					$this->request->data['ClientStock']['cost'] = $this->Common->mathsSub($var, $temp);
					
					$this->request->data['ClientStock']['quantity'] = $this->Common->mathsSub($specificallyThisOne['ClientStock']['quantity'], $this->request->data['ClientStock']['quantity']);
	
					if ($this->ClientStock->save($this->request->data)) {
						$this->Session->setFlash(__('The client stock has been sold.'));
						return $this->redirect(array('controller' => 'clients', 'action' => 'view', $specificallyThisOne['ClientStock']['client_id']));
					} else {
						$this->Session->setFlash(__('The client stock could not be sold. Please, try again.'));
						}
					} else {
						$this->Session->setFlash(__('The client does not have enough stock. Please, try again.'));
					} 
				}
			}
		}
}

