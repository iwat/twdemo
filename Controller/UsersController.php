<?php
App::uses('AuthComponent', 'Controller/Component');

class UsersController extends AppController
{
	public $uses = array('User', 'Tweet');

	public $paginate = array(
		'Tweet' => array(
			'limit' => 2,
			'order' => array('created' => 'desc')
		)
	);

	public function beforeFilter()
	{
		$this->Auth->allow('register');
	}

	public function register()
	{
		if ($this->request->is('post'))
		{
			if (empty($this->request->data['User']['password']) || $this->request->data['User']['password'] != $this->request->data['User']['repassword'])
			{
				$this->request->data['User']['password'] = '';
				$this->request->data['User']['repassword'] = '';
				$this->Session->setFlash('Password doesn\'t match.');
				return;
			}

			$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);

			if ($this->User->save($this->request->data))
			{
				$this->Session->setFlash('The user has been saved.');
				$this->redirect(array('action' => 'home'));
			}
			else
			{
				$this->request->data['User']['password'] = '';
				$this->request->data['User']['repassword'] = '';
				$this->Session->setFlash('The user could not be saved. Please try again.');
			}
		}
	}

	public function login()
	{
		if ($this->request->is('post'))
		{
			if ($this->Auth->login())
			{
				$this->redirect($this->Auth->redirect());
			}
			else
			{
				$this->Session->setFlash('Invalid username or password, try again');
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function home()
	{
		$user = $this->User->find('first', array(
			'conditions' => array('User.id' => $this->Auth->user('id')),
			'contain' => array('Following')
		));
		$userIds = array($this->Auth->user('id'));
		foreach ($user['Following'] as $following)
		{
			$userIds[] = $following['id'];
		}

		$tweets = $this->paginate('Tweet', array('User.id' => $userIds));
		$this->set(compact('tweets'));
		//debug($tweets);
	}
}
