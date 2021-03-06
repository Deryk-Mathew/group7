<?php
App::uses('AppController', 'Controller');
/**
 * Stocks Controller
 *
 * @property Stock $Stock
 * @property PaginatorComponent $Paginator
 */
class StocksController extends AppController {

/**
 * Components
 *
 * @var array
 */
    //public $components = array('Paginator');
	
	/*
	public $components = [
        'DataTable.DataTable' => [
            'Stock' => [
                'columns' => [
                    'id',
                    'averageDailyVolume',
                    'change',
					'daysLow',
					'daysHigh',
					'yearLow',
					'yearHigh',
					'marketCapitalization',
					'lastTradePriceOnly',
					'daysRange',
					'name',
					'symbol',
					'volume',
					'exchange_id',
                    'Actions' => null,
                ],
            ],
        ],
    ];
*/
/*
	public $components = [
        'DataTable.DataTable' => [
            'Stock' => [
                'columns' => [
                    'change',
					'daysLow',
					'daysHigh',
					'lastTradePriceOnly',
					'name',
					'symbol',
                    'Actions' => null,
                ],
            ],
        ],
    ];

    public $helpers = [
        'DataTable.DataTable',
    ];*/

        function browse(){
			$this->loadModel('StockExchange');
			$this->paginate = array('limit' => 100);
			$this->set('exchanges', $this->paginate($this->StockExchange));
		}

/**
 * index method
 *
 * @return void
 */

	public function index() {
		$this->loadModel('StockExchange');
		$this->paginate = array('limit' => 100);
		$this->set('exchanges', $this->paginate($this->StockExchange));
	}

	public function ajaxData() {
		$this->modelClass = "Stock";
		$this->autoRender = false;          
        $output = $this->Stock->GetData($this);
         
        echo json_encode($output);
	}
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Stock->recursive = 2;
		if (!$this->Stock->exists($id)) {
			throw new NotFoundException(__('Invalid stock'));
		}
		if($this->Session->read('current_client') != null){
			$conditions = array('ClientStock.client_id' => $this->Session->read('current_client'), 'ClientStock.stock_id' => $id);
			if($this->Stock->ClientStock->hasAny($conditions)){
				$this->set('cansell',true);
				$this->set('ownedstock',$this->Stock->ClientStock->find('first', array('conditions' => $conditions)));
			}
			else{
				$this->set('cansell',false);
			}
		}
		$options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
		$this->set('stock', $this->Stock->find('first', $options));
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Stock->create();
			if ($this->Stock->save($this->request->data)) {
				$this->Session->setFlash(__('The stock has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stock could not be saved. Please, try again.'));
			}
		}
		$stockExchanges = $this->Stock->StockExchange->find('list');
		$this->set(compact('stockExchanges'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Stock->exists($id)) {
			throw new NotFoundException(__('Invalid stock'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Stock->save($this->request->data)) {
				$this->Session->setFlash(__('The stock has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stock could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
			$this->request->data = $this->Stock->find('first', $options);
		}
		$stockExchanges = $this->Stock->StockExchange->find('list');
		$this->set(compact('stockExchanges'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Stock->id = $id;
		if (!$this->Stock->exists()) {
			throw new NotFoundException(__('Invalid stock'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Stock->delete()) {
			$this->Session->setFlash(__('The stock has been deleted.'));
		} else {
			$this->Session->setFlash(__('The stock could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}