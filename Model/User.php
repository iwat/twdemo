<?php
class User extends AppModel
{
	public $actsAs = array('Containable');
	public $displayField = 'username';

	public $validate = array(
		'username' => array(
			'rule-1' => array(
				'rule' => array('notempty'),
				'message' => 'Username must not be empty.',
			),
			'rule-2' => array(
				'rule' => array('isUnique'),
				'message' => 'This username is already registered.'
			)
		),
		'password' => array(
			'rule-1' => array(
				'rule' => array('notempty'),
				'message' => 'Password must not be empty.',
			),
		),
	);

	public $hasMany = array(
		'Tweet' => array(
			'order' => 'created DESC',
		)
	);

	public $hasAndBelongsToMany = array(
		'Following' => array(
			'className' => 'User',
			'joinTable' => 'follows',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'following_id'
		),
		'Follower' => array(
			'className' => 'User',
			'joinTable' => 'follows',
			'foreignKey' => 'following_id',
			'associationForeignKey' => 'user_id'
		)
	);
}
