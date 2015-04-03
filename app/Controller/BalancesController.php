<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'TransactionRecords');
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

	public function create($client){
		$this->Balance->create();
		$this->request->data['Balance']['client_id'] = $client;
		$this->request->data['Balance']['cash_balance'] = 0.00;
		if($this->Balance->save($this->request->data)){
			return true;
		}
		else{
			return false;
		}
	}
	
	/* Method to deposit cash into an account */
	public function deposit($id = null,$presetamount = null,$stock = null,$qty = null){
		if($presetamount != null){
			$this->set('default',round($presetamount,2)+0.01);
		}
		else{
			$this->set('default',0.00);
		}
		if ($this->request->is(array('post', 'put'))) {
			$options = array('conditions' => array('Balance.client_id' => $id));
			$balance = $this->Balance->find('first',$options);
			$tmp = $balance['Balance']['cash_balance']; //read current balance
			$amount = $this->request->data['Balance']['cash_balance']; // read amount to be added to balance
			if($amount<0.01){
				$this->Session->setFlash(__('Invalid amount entered.'),"error");
				return $this->redirect(array('controller' => 'balances', 'action' => 'deposit', $id));
			}
			$this->request->data['Balance']['id'] = $balance['Balance']['id'];
			$this->request->data['Balance']['client_id'] = $id;
			$this->request->data['Balance']['cash_balance'] = $this->Common->mathsAdd($tmp, $amount);

			// save the data to the database
			if ($this->Balance->save($this->request->data)) {
				$RecordCon = new TransactionRecordsController;
				$RecordCon->create($id,CASH,$amount);
				$this->Session->setFlash(__('Deposit successful.'),"success");
				$this->Session->write('balance',$this->request->data['Balance']['cash_balance']);
				if($stock != null && $qty != null){
					if($amount>=$presetamount){
						return $this->redirect(array('controller' => 'client_stocks', 'action' => 'buyStock', $stock, $this->Session->read('current_client'),$qty));
					}
					else{
						return $this->redirect(array('controller' => 'client_stocks', 'action' => 'buyStock', $stock, $this->Session->read('current_client')));
					}
				}
				else{
					return $this->redirect(array('controller' => 'clients', 'action' => 'portfolio', $id,$this->Session->read('current_client_name')));
				}
			} else {
				$this->Session->setFlash(__('The balance could not be saved. Please, try again.'),"error");
			}
		} else {
			$options = array('conditions' => array('Balance.' . $this->Balance->primaryKey => $id));
			$this->request->data = $this->Balance->find('first', $options);
		}

	}
	

	/* Method to withdraw cash from an account*/
	public function withdraw($id = null){

		if ($this->request->is(array('post', 'put'))) {
			
			$options = array('conditions' => array('Balance.client_id' => $id));
			$balance = $this->Balance->find('first',$options);
			$tmp = $balance['Balance']['cash_balance']; //read current balance
			$amount = $this->request->data['Balance']['cash_balance']; // read amount to be withdrawn
			if($amount<0.01){
				$this->Session->setFlash(__('Invalid amount entered.'),"error");
				return $this->redirect(array('controller' => 'balances', 'action' => 'withdraw', $id));
			}
			if($tmp<$amount){
				$this->Session->setFlash(__('Client has insufficient funds. Attempted to withdraw £'.$amount.' when client balance is only £'.$tmp.'.'),"error");
				return $this->redirect(array('controller' => 'balances', 'action' => 'withdraw', $id));
			}

			$this->request->data['Balance']['id'] = $balance['Balance']['id'];
			$this->request->data['Balance']['client_id'] = $id;
			$this->request->data['Balance']['cash_balance'] = $this->Common->mathsSub($tmp, $amount);
			 
			if ($this->Balance->save($this->request->data)) {
				$RecordCon = new TransactionRecordsController;
				$RecordCon->create($id,CASH,$amount*(-1));
				$this->Session->setFlash(__('Funds successfully withdrawn.'),"success");
				return $this->redirect(array('controller' => 'clients', 'action' => 'portfolio', $id,$this->Session->read('current_client_name')));
			} else {
				$this->Session->setFlash(__('The balance could not be saved. Please, try again.'),"error");
				}

		} 
	}
}
