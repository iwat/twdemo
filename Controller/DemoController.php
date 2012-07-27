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
					$this->saveToBLOB($file1);
					$this->saveToFile($file1);
				}
			}
		}
	}

	private function saveToBLOB($file)
	{
		$upload = $this->Upload->findByName($file['name']);

		if (!$upload)
		{
			$upload = $this->Upload->create();
			$upload['Upload']['name'] = $file['name'];
			$upload['Upload']['type'] = $file['type'];
			$upload['Upload']['data'] = file_get_contents($file['tmp_name']);
			$this->Upload->save($upload);
		}
		else
		{
			$upload['Upload']['type'] = $file['type'];
			$upload['Upload']['data'] = file_get_contents($file['tmp_name']);
			$this->Upload->save($upload, true, array('type', 'data'));
		}

		$this->set('blobURL', array('action' => 'download', $this->Upload->id));
	}

	private function saveToFile($file)
	{
		$info = pathinfo($file['name']); // split filename and extension
		$saveName = md5($info['basename']) . '.' . $info['extension'];
		$savePath = WWW_ROOT . 'uploads' . DS . $saveName;

		if (move_uploaded_file($file['tmp_name'], $savePath))
		{
			$this->set('fileURL', FULL_BASE_URL . $this->webroot . 'uploads/' . $saveName);
		}
	}

	public function download($uploadId)
	{
		$this->autoRender = false;

		$upload = $this->Upload->findById($uploadId);
		$this->response->type($upload['Upload']['type']);
		// enable this line to force download
		//$this->response->download($upload['Upload']['name']);
		$this->response->body($upload['Upload']['data']);
	}
}
