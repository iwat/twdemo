<?php
class DemoController extends AppController
{
	public $uses = array('User', 'Tweet', 'Follow');

	public function index()
	{
		$users = $this->User->find('all');
		$tweets = $this->Tweet->find('all', array('contain' => array('User' => array('Follower'))));
		$follows = $this->Follow->find('all');

		$this->set(compact('users', 'tweets', 'follows'));
	}
}
