<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Balances');
App::import('Controller', 'TransactionRecords');
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
			throw new NotFoundException(__('Invalid client stock'),"error");
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
				$this->Session->setFlash(__('The client stock could not be saved. Please, try again.'),"error");
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
			$this->Session->setFlash(__('The client stock has been deleted.'),"success");
		} else {
			$this->Session->setFlash(__('The client stock could not be deleted. Please, try again.'),"error");
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function buyStock($stock,$client) {
		$this->ClientStock->Stock->recursive = 2;
		$options = array('conditions' => array('Stock.' . $this->ClientStock->Stock->primaryKey => $stock));
		$stockdetails = $this->ClientStock->Stock->find('first', $options);
		$this->set('stock', $stockdetails);
		$options = array('conditions' => array('Client.' . $this->ClientStock->Client->primaryKey => $client));
		$this->set('client', $this->ClientStock->Client->find('first', $options));
		$options = array('conditions' => array('Client.' . $this->ClientStock->Client->Balance->primaryKey => $client));
		$this->set('balance',$this->ClientStock->Client->Balance->find('first',$options));
		
		$conditions = array('ClientStock.client_id' => $client, 'ClientStock.stock_id' => $stock);
		
		
		if($this->request->is(array('post', 'put'))) {
			
			$quantity = $this->request->data['ClientStock']['quantity'];
			$cost = $quantity*$stockdetails['Stock']['lastTradePriceOnly']*(1/$stockdetails['StockExchange']['ExchangeRate']['rate']);
			
			$options = array('conditions' => array('Balance.client_id' => $client));
			$balance = $this->ClientStock->Client->Balance->find('first',$options);
			$clientbalance = $balance['Balance']['cash_balance']; //read current balance
			
			if($cost>$clientbalance){
					$this->Session->setFlash('Client has insufficient funds.','error');
					return $this->redirect(array('controller' => 'client_stocks', 'action' => 'buyStock', $stock, $client));
			}
			
			if (!$this->ClientStock->hasAny($conditions)){
				$this->ClientStock->create();
				$this->request->data['ClientStock']['client_id'] = $client;
				$this->request->data['ClientStock']['stock_id'] = $stock;
				$this->request->data['ClientStock']['cost'] = $cost;
				$this->request->data['ClientStock']['quantity'] = $quantity;
			}
			else{
				$specificallyThisOne = $this->ClientStock->find('first', array('conditions' => $conditions));
				$this->request->data['ClientStock']['id'] = $specificallyThisOne['ClientStock']['id'];
				$this->request->data['ClientStock']['client_id'] = $specificallyThisOne['ClientStock']['client_id'];
				$this->request->data['ClientStock']['stock_id'] = $specificallyThisOne['ClientStock']['stock_id'];
				$this->request->data['ClientStock']['cost'] = $this->Common->mathsAdd($specificallyThisOne['ClientStock']['cost'], $cost);
				$this->request->data['ClientStock']['quantity'] = $this->Common->mathsAdd($specificallyThisOne['ClientStock']['quantity'], $quantity);
			}

			$this->ClientStock->Client->Balance->updateAll(array('cash_balance' => $clientbalance-$cost),array('client_id' => $client));

			if($this->ClientStock->save($this->request->data)){
					$RecordCon = new TransactionRecordsController;
					$RecordCon->create($client,STOCK,$cost,$stockdetails['Stock']['id'],$quantity);
					$this->Session->setFlash("The client stock has been purchased.","success");
					return $this->redirect(array('controller' => 'clients', 'action' => 'portfolio', $this->Session->read('current_client'),$this->Session->read('current_client_name')));
			}
			else {
				$this->Session->setFlash('The client stock could not be saved. Please, try again.','error');
				}
		}
	}
	

	public function sellStock($stock,$client) {
		$this->ClientStock->Stock->recursive = 2;
		$options = array('conditions' => array('Stock.' . $this->ClientStock->Stock->primaryKey => $stock));
		$stockdetails = $this->ClientStock->Stock->find('first', $options);
		$this->set('stock', $stockdetails);
		$options = array('conditions' => array('Client.' . $this->ClientStock->Client->primaryKey => $client));
		$this->set('client', $this->ClientStock->Client->find('first', $options));
		$options = array('conditions' => array('Client.' . $this->ClientStock->Client->Balance->primaryKey => $client));
		$this->set('balance',$this->ClientStock->Client->Balance->find('first',$options));
		
		$conditions = array('ClientStock.client_id' => $client, 'ClientStock.stock_id' => $stock);
		
		if ($this->ClientStock->hasAny($conditions)){
			$specificallyThisOne = $this->ClientStock->find('first', array('conditions' => $conditions));
			$this->set('quantity',$specificallyThisOne['ClientStock']['quantity']);
			if($this->request->is(array('post', 'put'))) {
				$quantity = $this->request->data['ClientStock']['quantity'];
				$this->request->data['ClientStock']['id'] = $specificallyThisOne['ClientStock']['id'];
				$this->request->data['ClientStock']['client_id'] = $specificallyThisOne['ClientStock']['client_id'];
				$this->request->data['ClientStock']['stock_id'] = $specificallyThisOne['ClientStock']['stock_id'];
				
				
				if($quantity>$specificallyThisOne['ClientStock']['quantity']){
						$this->Session->setFlash(__('Client has insufficient stock in this company.'),"error");
						return $this->redirect(array('controller' => 'client_stocks', 'action' => 'sellStock', $stock, $client));
				}
				
				$cost = $quantity*$stockdetails['Stock']['lastTradePriceOnly']*(1/$stockdetails['StockExchange']['ExchangeRate']['rate'])*(-1);
				$this->request->data['ClientStock']['cost'] = $this->Common->mathsAdd($specificallyThisOne['ClientStock']['cost'], $cost);
				
				$options = array('conditions' => array('Balance.client_id' => $client));
				$balance = $this->ClientStock->Client->Balance->find('first',$options);
				$clientbalance = $balance['Balance']['cash_balance']; //read current balance
				
				$this->ClientStock->Client->Balance->updateAll(array('cash_balance' => $clientbalance-$cost),array('client_id' => $client));
		
				$this->request->data['ClientStock']['quantity'] = $this->Common->mathsSub($specificallyThisOne['ClientStock']['quantity'],$quantity );
				
				if($this->request->data['ClientStock']['quantity'] == 0){
					$this->request->data['ClientStock']['cost'] = 0;
				}
				if($this->ClientStock->save($this->request->data)){
						$RecordCon = new TransactionRecordsController;
						$RecordCon->create($client,STOCK,$cost,$stockdetails['Stock']['id'],$quantity);
						$this->Session->setFlash(__('The client stock has been sold.'),"success");
						return $this->redirect(array('controller' => 'clients', 'action' => 'portfolio', $this->Session->read('current_client'),$this->Session->read('current_client_name')));
			}
			else {
				$this->Session->setFlash(__('The client stock could not be saved. Please, try again.'),"error");
				}
			}
		}
		else{
				return $this->redirect(array('controller' => 'clients', 'action' => 'portfolio', $this->Session->read('current_client'),$this->Session->read('current_client_name')));
				
		}
		
	}

	
	
}

