<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController 

{

    /**
     * index method
     *
     * @return void
     */
     public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add'); // дозволяємо користувачам зареєструватися
    }
       
    
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Неправильний логін або пароль, повторіть спробу'));
            }
        }
     
    }

    
    public function logout(){
        $this->Session->delete('Permissions');
        $this->redirect($this->Auth->logout());
    }
    

    /**
     * add method
     *
     * @return void
     */
    public function registration() 
    {
        if ($this->request->is('post')) {
            //$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
            //$this->data['User']['password'] = $this->Auth->password($this->data['User']['password']);
            //$this->request->data ['User']['password'] = sha1( trim( $this->request->data ['User']['password'] ) ); 
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash('The user has been saved');
                    $this->redirect(array('controller' => 'posts','action' => 'index'));
            } else {
                    //$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        
        $groups = $this -> User -> Group -> find( 'list' );
        $this -> set( compact( 'groups' ) );
    }


}


