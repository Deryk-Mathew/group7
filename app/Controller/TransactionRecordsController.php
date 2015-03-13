<?php
App::uses('AppController', 'Controller');
/**
 * TransactionRecords Controller
 *
 * @property TransactionRecords 
 * @property PaginatorComponent $Paginator
 */
class TransactionRecordsController extends AppController {
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function create($client,$type,$cost,$stock = null,$quantity = null){
		$this->TransactionRecord->create();
		$this->request->data['TransactionRecord']['client_id'] = $client;
		$this->request->data['TransactionRecord']['type'] = $type;
		if($type==STOCK){
			$this->request->data['TransactionRecord']['stock_id'] = $stock;
			$this->request->data['TransactionRecord']['quantity'] = $quantity;
		}
		$this->request->data['TransactionRecord']['balance_change'] =  $cost;
		$this->request->data['TransactionRecord']['date'] = DboSource::expression('NOW()');
		if($this->TransactionRecord->save($this->request->data)){
			return true;
		}
		else{
			return false;
		}
	}
}
