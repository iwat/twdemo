<?php
class Tweet extends AppModel
{
	public $actsAs = array('Containable');

	public $validate = array(
		'message' => array(
			'rule-1' => array(
				'rule' => array('notempty'),
				'message' => 'Tweet message must not be empty.',
			),
		),
		'user_id' => array(
			'rule-1' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid user_id.',
			),
		),
	);

	public $belongsTo = array('User');
}
