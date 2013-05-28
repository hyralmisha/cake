<?php 
App::uses('AppModel', 'Model');


class Group extends AppModel {
    
    public $displayField = 'name';
    
    /*
    public $hasMany = array(
            'Permission' => array(
                    'className' => 'Permission',
                    'foreignKey' => 'group_id',
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
    */
    public $hasAndBelongsToMany = array(
            'Permission' => array('className' => 'Permission',
                        'joinTable' => 'groups_permission',
                        'foreignKey' => 'group_id',
                        'associationForeignKey' => 'permission_id',
                        'unique' => true
            ),
            'User' => array('className' => 'User',
                        'joinTable' => 'groups_users',
                        'foreignKey' => 'group_id',
                        'associationForeignKey' => 'user_id',
                        'unique' => true
            )
    );
}