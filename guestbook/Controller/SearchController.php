<?php
App::uses('AppController', 'Controller');

/**
 * Posts Controller
 *
 * @property Post $Post
 */
class SearchController extends AppController 

{

    function index() 
    {
        $this->Page->recursive = 0;
        $conditions=$this->Search->getConditions();
        $this->set('posts', $this->paginate(null,$conditions));
     }
     
}