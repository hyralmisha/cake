<?php
App::uses('AppController', 'Controller');


class GroupsController extends AppController 

{

    /**
     * add method
     *
     * @return void
     */
    public function add() 
    {
        if ( $this -> request -> is( 'post' ) ) {
            $this -> Group -> create();
            if ($this -> Group -> save( $this -> request -> data ) ) {
                $this -> Session -> setFlash(__( 'Група була успішно збережена у БД.' ) );
            } else {
                $this -> Session -> setFlash(__( 'Група не була збережена у БД.' ) );
            }
        }
    }
    
}