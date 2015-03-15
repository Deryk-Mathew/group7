<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

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
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}
	public function browse() {
		$this->User->recursive = 2;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * dashboard function
 *
 * @throws NotFoundException
 * @return void
 */
	public function dashboard() {
		$this->User->recursive = 2;
	}
	
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->recursive = 2;
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'view'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'browse'));
	}

	/* Method to login */
	public function login() {
    if ($this->request->is('post')) {
    	if ($this->Session->read('Auth.User')) {
	        $this->Session->setFlash('You are logged in!');
	        return $this->redirect(array('controllers' => 'clients', 'action' => 'dashboard'));
	    }
        if ($this->Auth->login()) {
            return $this->redirect(array('controller' => 'clients', 'action' => 'dashboard',));
        }
        	$this->Session->setFlash(__('Your username or password was incorrect.'));
    	}
    }

    /* Method to logout*/
	public function logout() { 
		$this->Session->destroy(); // Destroys current session
	    $this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());
	}



	public function initDB() {
	    $group = $this->User->Group;

	    // Allow admins to everything
	    $group->id = 1;
	    $this->Acl->allow($group, 'controllers');

	    // Allow FA's access to certain functions
	    $group->id = 2;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Clients');
	    $this->Acl->deny($group, 'controllers/Clients/delete');
	    $this->Acl->allow($group, 'controllers/Notes');
	    $this->Acl->allow($group, 'controllers/Balance');
	    $this->Acl->allow($group, 'controllers/Stocks/index');
	    $this->Acl->allow($group, 'controllers/Stocks/view');
	    $this->Acl->allow($group, 'controllers/Stocks/browse');
	    $this->Acl->allow($group, 'controllers/Stocks/ajaxData');
	    $this->Acl->allow($group, 'controllers/ClientStocks');
	    $this->Acl->allow($group, 'controllers/TransactionRecords');
	    $this->Acl->allow($group, 'controllers/StockExchanges');
	    $this->Acl->allow($group, 'controllers/Meetings');

	    // allow basic users to log out
	    $this->Acl->allow($group, 'controllers/users/logout');

	    // we add an exit to avoid an ugly "missing views" error message
	    echo "all done";
	    exit;
	}
}
