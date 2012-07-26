<?php
App::uses('AuthComponent', 'Controller/Component');

class UsersController extends AppController
{
	public $uses = array('User', 'Tweet', 'Follow');

	public $paginate = array(
		'Tweet' => array(
			'limit' => 5,
			'order' => array('created' => 'desc')
		),
		'Follow' => array(
			'limit' => 5,
			'order' => array('id' => 'asc')
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
	}

	public function follow($userId = null)
	{
		if ($this->request->is('post'))
		{
			$this->User->contain();
			$user = $this->User->findByUsername($this->request->data['User']['username']);
		}
		else
		{
			$this->User->contain();
			$user = $this->User->findById($userId);
		}

		if ($user)
		{
			$follow = $this->Follow->create();
			$follow['Follow']['user_id'] = $this->Auth->user('id');
			$follow['Follow']['following_id'] = $user['User']['id'];

			if ($this->Follow->save($follow))
			{
				$this->Session->setFlash('You are now following @' . $user['User']['username']);
			}
			else
			{
				if (isset($this->Follow->validationErrors['user_id']))
				{
					$this->User->validationErrors['username'] = $this->Follow->validationErrors['user_id'];
				}
			}
		}
		else
		{
			$this->Session->setFlash('The specified username does not exist.');
		}

		if (!$this->request->is('post'))
			$this->redirect($this->referer());
	}

	public function unfollow($userId)
	{
		$this->Follow->contain(array('Following'));
		$follow = $this->Follow->findByUserIdAndFollowingId($this->Auth->user('id'), $userId);

		if ($follow)
		{
			$this->Follow->delete($follow['Follow']['id']);
			$this->Session->setFlash('@' . $follow['Following']['username'] . ' has been unfollowed.');
		}
		else
		{
			$this->Session->setFlash('User is not being followed by you.');
		}

		$this->redirect($this->referer());
	}

	public function following()
	{
		$this->Follow->contain(array('Following'));
		$follows = $this->paginate('Follow', array('Follow.user_id' => $this->Auth->user('id')));
		$this->set(compact('follows'));
	}

	public function followers()
	{
		$this->Follow->contain(array('User'));
		$follows = $this->paginate('Follow', array('Follow.following_id' => $this->Auth->user('id')));
		$this->set(compact('follows'));
	}
}
