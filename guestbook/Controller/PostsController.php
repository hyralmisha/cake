<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class PostsController extends AppController 

{

    /**
     * index method
     *
     * @return void
     */
    public function index() 
    {
        $this -> layout();
        $this -> Post -> recursive = 0;
        $this -> set( 'posts', $this -> paginate() );
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) 
    {
        $this -> layout();
        if ( !$this -> Post -> exists( $id ) ) {
            $this -> Session -> setFlash(__( 'Такого поста не існує.') );
            $this -> redirect( array( 'controller' => 'posts', 'action' => 'index'), null, true );
        }
        $options = array( 'conditions' => array( 'Post.' . $this -> Post -> primaryKey => $id));
        $this -> set( 'post', $this -> Post -> find( 'first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() 
    {
        $this -> layout();    
        $this -> checkSession();
        if ( $this -> request -> is( 'post' ) ) {
            $this -> request -> data ['Post']['date_create'] = date( "Y-m-d H:i:s" ); 
            $this -> request -> data ['Post']['date_edit'] = date( "Y-m-d H:i:s" ); 
            $this -> request -> data = Sanitize::clean ( $this -> request -> data );
            $this -> Post -> create();
            if ($this -> Post -> save( $this -> request -> data ) ) {
                $this -> Session -> setFlash(__( 'Пост був успішно збережений.' ) );
                $this -> redirect( array( 'controller' => 'posts', 'action' => 'index'), null, true );
            } else {
                $this -> Session -> setFlash(__( 'Пост не був збережений. Будь ласка спробуйте ще раз.' ) );
            }
        }
        $users = $this -> Post -> User -> find( 'list' );
        $tags = $this -> Post -> Tag -> find( 'list' );
        $this -> set( compact( 'users', 'tags' ) );
    }

    /**
    * edit method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit($id = null) 
    {
        $this -> layout();    
        $this -> checkSession();
        if ( !$this -> Post -> exists( $id ) ) {
            $this -> Session -> setFlash(__( 'Такого поста не існує.') );
            $this -> redirect( array( 'action' => 'index'), null, true );
        }
        if ($this -> request -> is( 'post' ) || $this -> request -> is( 'put' ) ) {
            $this -> request -> data ['Post']['date_edit'] = date( "Y-m-d H:i:s" ); 
            $this -> request -> data = Sanitize::clean ( $this -> request -> data );
            if ( $this -> Post -> save( $this -> request -> data ) ) {
                    $this -> Session -> setFlash(__( 'Пост успішно збережений.' ) );
                    $this -> redirect( array( 'controller' => 'posts', 'action' => 'index'), null, true );
            } else {
                    $this -> Session -> setFlash(__( 'Пост не був збережений. Будь ласка спробуйте ще раз.' ) );
            }
        } else {
                $options = array( 'conditions' => array( 'Post.' . $this -> Post -> primaryKey => $id));
                $this -> request -> data = $this -> Post -> find( 'first', $options);
        }
        $users = $this -> Post -> User -> find( 'list' );
        $tags = $this -> Post -> Tag -> find( 'list' );
        $this -> set( compact( 'users', 'tags' ) );
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) 
    {
        $this -> layout();
        $this -> checkSession();
        $this -> Post -> id = $id;
        if ( !$this -> Post -> exists() ) {
            $this -> Session -> setFlash(__( 'Такого поста не існує.') );
            $this -> redirect( array( 'controller' => 'posts', 'action' => 'index'), null, true );
        }
        $this -> request -> onlyAllow( 'post', 'delete' );
        if ( $this -> Post -> delete() ) {
                $this -> Session -> setFlash(__( 'Post deleted' ) );
                $this -> redirect( array( 'controller' => 'posts', 'action' => 'index'), null, true );
        }
        $this -> Session -> setFlash(__( 'Post was not deleted' ) );
        $this -> redirect( array( 'controller' => 'posts', 'action' => 'index'), null, true );
    }
}
