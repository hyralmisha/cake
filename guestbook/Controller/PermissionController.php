<?php
App::uses('AppController', 'Controller');

/**
 * Permission Controller
 *
 * @property Permission $Permission
 */
class PermissionController extends AppController 

{


   

    /**
     * add method
     *
     * @return void
     */
    public function add() 
    {
        if ( $this -> request -> is( 'post' ) ) {
            $this -> Permission -> create();
            if ($this -> Permission -> save( $this -> request -> data ) ) {
                $this -> Session -> setFlash(__( 'Пост був успішно збережений.' ) );
            } else {
                $this -> Session -> setFlash(__( 'Пост не був збережений. Будь ласка спробуйте ще раз.' ) );
            }
        }
        $groups = $this -> Permission -> Group -> find( 'list' );
        $this -> set( compact( 'groups' ) );
    }
}