<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Post $Post
 */
class User extends AppModel 

{

/**
 * Display field
 *
 * @var string
 */
	
        
    public $displayField = 'username';

    
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
         'email_address' => array(
             array(
                 'rule' => array('email'),
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
         ),
         'active' => array(
             'rule' => 'numeric',
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

 
    public $hasAndBelongsToMany = array(
            'Group' => array(
                    'className' => 'Group',
                    'joinTable' => 'groups_users',
                    'foreignKey' => 'user_id',
                    'associationForeignKey' => 'group_id',
                    'unique' => true
            )
    );
           
    
    public function beforeSave() {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
}

    
