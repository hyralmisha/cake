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


    public function login()
    {
        $this -> layout();
        if (!empty($this->data)) {
            // перевіряємо, чи є в БД користувач з введеним email
            $someone = $this->User->findByUsername($this->data['User']['username']);
            //Якщо користувач існує, порівнюємо паролі
            if(!empty($someone['User']['password']) && 
                $someone['User']['password'] == md5($this->data['User']['password'])) {
                //Створюємо сесію
                $this->Session->write('User', $someone['User']);
                $this->Session->setFlash(__('Ви успішно ввійшли на сайт'));
                $this->redirect(array('controller' => 'posts','action' => 'index'));
            } else {
                $this->Session->setFlash(__('Ви не ввійшли на сайт. Спробуйте ще раз.'));
                $this->redirect(array('controller' => 'users','action' => 'login'));
            }
        }
    }
       
    public function logout() 
    {
        $this->Session->delete('User');
        $this->redirect(array('controller' => 'posts','action' => 'index'));
    }
    
    


    /**
     * add method
     *
     * @return void
     */
    public function registration() 
    {
        $this -> layout();
        if ($this->request->is('post')) {
            $this->request->data ['User']['date_create'] = date( "Y-m-d H:i:s" ); 
            $this->request->data ['User']['password'] = md5( trim( $this->request->data ['User']['password'] ) ); 
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'));
                    $this->redirect(array('controller' => 'posts','action' => 'index'));
            } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }


}
