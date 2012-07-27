<?php
class DemoController extends AppController
{
	public $uses = array('User', 'Tweet', 'Follow', 'Upload');

	public function index()
	{
		$users = $this->User->find('all');
		$tweets = $this->Tweet->find('all', array('contain' => array('User' => array('Follower'))));
		$follows = $this->Follow->find('all');

		$this->set(compact('users', 'tweets', 'follows'));
	}

	public function upload()
	{
		if ($this->request->is('post'))
		{
			$file1 = $this->request->data['Demo']['file1'];

			if ($file1['error'] == 0 && $file1['size'] > 0 && $file1['tmp_name'] != 'none')
			{
				if (is_uploaded_file($file1['tmp_name']))
				{
					$info = pathinfo($file1['name']); // split filename and extension

					// Save to BLOB
					$upload = $this->Upload->findByName($file1['name']);

					if (!$upload)
					{
						$upload = $this->Upload->create();
						$upload['Upload']['name'] = $file1['name'];
						$upload['Upload']['type'] = $file1['type'];
						$upload['Upload']['data'] = file_get_contents($file1['tmp_name']);
						$this->Upload->save($upload);
					}
					else
					{
						$upload['Upload']['type'] = $file1['type'];
						$upload['Upload']['data'] = file_get_contents($file1['tmp_name']);
						$this->Upload->save($upload, true, array('type', 'data'));
					}

					// Save to Disk
					$saveName = md5($info['basename']) . '.' . $info['extension'];
					$savePath = WWW_ROOT . 'uploads' . DS . $saveName;

					if (move_uploaded_file($file1['tmp_name'], $savePath))
					{
						$this->Session->setFlash(FULL_BASE_URL . $this->webroot . 'uploads/' . $saveName);
					}
				}
			}
		}
	}

	public function download()
	{
		$this->autoRender = false;

		$filename = $this->request->query['q'];

		$upload = $this->Upload->findByName($filename);
		$this->response->type($upload['Upload']['type']);
		// enable this line to force download
		//$this->response->download($upload['Upload']['name']);
		$this->response->body($upload['Upload']['data']);
	}
}
