<?php
class Follow extends AppModel
{
	public $actsAs = array('Containable');

	public $validate = array(
		'user_id' => array(
			'rule-1' => array(
				'rule' => array('checkUnique', array('user_id', 'following_id')),
				'message' => 'This user is already following the specified user.',
			),
		),
	);

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Following' => array(
			'className' => 'User',
			'foreignKey' => 'following_id',
		)
	);

	public function checkUnique($data, $fields)
	{
		foreach ($fields as $key)
		{
			$tmp[$key] = $this->data[$this->name][$key];
		}

		if (isset($this->data[$this->name][$this->primaryKey]))
		{
			$tmp[$this->primaryKey] = '<>' . $this->data[$this->name][$this->primaryKey];
		}

		return $this->isUnique($tmp, false);
	}
}
