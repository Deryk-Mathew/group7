<?php
App::uses('AppController', 'Controller');
/**
 * Notes Controller
 *
 * @property Note $Note
 * @property PaginatorComponent $Paginator
 */
class MeetingsController extends AppController {

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
		$this->set('meetings', $this->Paginator->paginate());
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
			throw new NotFoundException(__('Invalid Meeting'));
		}
		$options = array('conditions' => array('Meeting.' . $this->Meeting->primaryKey => $id));
		$this->set('note', $this->Meeting->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $this->request->data['Client']['user_id'] = $this->Auth->user('id');
		$var = $this->Session->read('current_client');
        $var2 = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$this->Meeting->create();
			$this->request->data['Meeting']['client_id'] = $var;
            $this->request->data['Meeting']['user_id'] = $var2;
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('The meeting has been saved.'));
				return $this->redirect(array( 'controller' => 'meetings', 'action' => 'browse'));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.'));
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
		if (!$this->Meeting->exists($id)) {
			throw new NotFoundException(__('Invalid Meeting'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Meeting']['client_id'] = $client_id;
			$this->request->data['Meeting']['id'] = $id;
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlash(__('The note has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Note.' . $this->Meeting->primaryKey => $id));
			$this->request->data = $this->Meeting->find('first', $options);
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
		$this->Meeting->id = $id;
		if (!$this->Meeting->exists()) {
			throw new NotFoundException(__('Invalid Meeting'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Meeting->delete()) {
			$this->Session->setFlash(__('The meeting has been deleted.'));
		} else {
			$this->Session->setFlash(__('The meeting could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
