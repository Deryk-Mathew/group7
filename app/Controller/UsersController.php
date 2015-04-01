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
				$this->Session->setFlash(__('The user has been saved.'),'success');
				return $this->redirect(array('controller' => 'users','action' => 'browse'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'),'error');
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
				$this->Session->setFlash(__('The user has been saved.'),'success');
				return $this->redirect(array('controller' => 'users','action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'),'error');
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
	if($this->Session->read('Auth.User') != null){
		return $this->redirect(array('action' => 'dashboard'));
	}else {
	$this->layout = 'login';
	
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
    }

    /* Method to logout*/
	public function logout() { 
		$this->Session->destroy(); // Destroys current session
	    $this->Session->setFlash('Good-Bye','notice');
		$this->redirect($this->Auth->logout());
	}
	
		/* Method to change password */
	public function change_password() {

		if ($this->request->is('post')) {

			$this->id = $this->User->id = AuthComponent::user('id');

			$options = array('conditions' => array('User.' . $this->User->primaryKey => $this->User->id));

			$user = $this->User->find('first', $options);

			$password = $user['User']['password'];

			$password_new = $this->data['User']['password'];
			$password_new_2 = $this->data['User']['password2'];

			if(AuthComponent::password($this->data['User']['password_old']) == $password)
			{


				if($password_new==$password_new_2){

			if($this->User->saveField('password',$this->data['User']['password']))
			{
			$this->Session->setFlash('Password Change Success!');
			$this->redirect(array('controller' => 'clients', 'action' => 'dashboard',));
			}
}else 	$this->Session->setFlash('passwords dont match');
			}
			else
			$this->Session->setFlash('incorrect old password');
		}



	}
	
	public function forgot_password() {
		$this->layout = 'login';

		if ($this->request->is('post'))
		{

			if(!empty($this->data))
			{
				$options = array('conditions' => array('User.username' => $this->data['User']['username']));
				$user = $this->User->find('first', $options);
				$this->set('user', $user);

				if ($user === false)
				{
						   $this->Session->setFlash('User could not be found.','error');

				}
				else
				{
				$rand_pass = $this->generateRandomString();
				App::uses('CakeEmail', 'Network/Email');
				$this->User->id = $user['User']['id'];
					if($this->User->saveField('password', $rand_pass))
					{

					$Email = new CakeEmail('gmail');
					$Email->from('group7.forgot@gmail.com');
					$Email->to($user['User']['email']);

					$Email->subject('Your New Password!');
					$Email->send('Your new temporary password is: '.$rand_pass.'

Please change your password next time you log in.

Best of luck! Group7 Team ');

					$this->Session->setFlash('Password reset email sent!','success');
					//echo 'email sent';
					return $this->redirect(array('action' => 'login'));
					}

				}



			}
		}
	}
	
	/* Method to random password*/
	public function generateRandomString($length = 8) {
		$characters = '0123456789klmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOP0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}



	public function initDB() {
	    $group = $this->User->Group;

	    // Allow admins to everything
	    $group->id = ADMIN;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Clients');
	    $this->Acl->allow($group, 'controllers/Users');

	    // Allow FA's access to certain functions
	    $group->id = FA;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Clients');
	    $this->Acl->deny($group, 'controllers/Clients/delete');
	    // $this->Acl->allow($group, 'controllers/Users/browse');
	    // $this->Acl->allow($group, 'controllers/Users/dashboard');
	    $this->Acl->allow($group, 'controllers/Notes');
	    $this->Acl->allow($group, 'controllers/Balances');
	    $this->Acl->allow($group, 'controllers/Stocks');
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
