<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Post $Post
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	
        
        public $displayField = 'first_name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

        public $validate = array(
               'last_name' => array( 
                    'rule' => 'notEmpty',
                    'message' => 'Поле не повинно бути порожнім'
                ),
                'first_name' => array( 
                    'rule' => 'notEmpty',
                    'message' => 'Поле не повинно бути порожнім'
                ),
		'username' => array(
                    array(
                        'rule' => array('email', true),
                        'message' => 'Ви не правильно ввели email',
                    ),
                    array(
                        'rule' => 'isUnique',
                        'message' => 'Такий email уже зареєстровано.'
                    )
                ),
                'password' => array(
                    'rule' => 'alphaNumeric',
                    'message' => 'Пароль повинен містити тільки букви і цифри.'
                )
	);
        
        
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

        
        
}

    
