<?php
App::uses('AppController', 'Controller');
/**
 * Notes Controller
 *
 * @property Note $Note
 * @property PaginatorComponent $Paginator
 */
class NotesController extends AppController {

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
		$this->Note->recursive = 0;
		$this->set('notes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
		}
		$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
		$this->set('note', $this->Note->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($client) {
		if ($this->request->is('post')) {
			$this->Note->create();
			$this->request->data['Note']['client_id'] = $client;
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('The note has been saved.'),'success');
				return $this->redirect(array( 'controller' => 'clients', 'action' => 'profile', $client,$this->Session->read('current_client_name')));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.'),'error');
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
	public function edit($id = null, $client_id) {
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Note']['client_id'] = $client_id;
			$this->request->data['Note']['id'] = $id;
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('The note has been saved.'),'success');
				return $this->redirect(array( 'controller' => 'clients', 'action' => 'profile', $client_id,$this->Session->read('current_client_name')));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.'),'error');
			}
		} else {
			$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
			$this->request->data = $this->Note->find('first', $options);
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
		$this->Note->id = $id;
		if (!$this->Note->exists()) {
			throw new NotFoundException(__('Invalid note'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Note->delete()) {
			$this->Session->setFlash(__('The note has been deleted.'),'success');
		} else {
			$this->Session->setFlash(__('The note could not be deleted. Please, try again.'),'error');
		}
		return $this->redirect(array( 'controller' => 'clients', 'action' => 'profile', $this->Session->read('current_client'),$this->Session->read('current_client_name')));
	}
}
