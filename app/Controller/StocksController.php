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
			$this->Stock->recursive = 2;
			$this->set('stocks', $this->Paginator->paginate());
		}

/**
 * index method
 *
 * @return void
 */

	public function index() {
		$this->loadModel('StockExchange');
		$this->set('exchanges', $this->paginate($this->StockExchange));
	}

	public function ajaxData() {
		$this->Stock->recursive = 2;
		$this->modelClass = "Stock";
		//$this->autoRender = false;          
        $output = $this->Stock->GetData();
         
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
