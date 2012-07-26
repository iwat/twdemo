<?php
class TweetsController extends AppController
{
	public function post()
	{
		if ($this->request->is('post'))
		{
			$this->request->data['Tweet']['user_id'] = $this->Auth->user('id');

			if ($this->Tweet->save($this->request->data))
			{
				$this->Session->setFlash('Tweeted');
			}
			else
			{
				if (isset($this->Tweet->validationErrors['message'][0]))
					$this->Session->setFlash($this->Tweet->validationErrors['message'][0]);
				else
					$this->Session->setFlash('Unable to send Tweet this time, please try again.');
			}

			$this->redirect($this->referer());
		}
	}
}
