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
        $this -> Post -> recursive = 0;
        $this -> set( 'posts', $this -> paginate() );
    }
    
    /**
    * search method
    *
    * @return void
    */
    public function search() 
    {
        if (empty($this->params['named']) ) {
            $data = $this->params['url'];
        } else {
            $data = $this->params['named'] ;
        }
        $searchPhrase = $data['name'];
        $data = $this->Post->search($searchPhrase); 
        if ( empty( $data ) ) {
            $this -> Session -> setFlash(__( 'Пошук не дав результатів!') );
        }
        $this->set('posts', $data);//$this->paginate(null,$data));

        /*//
        $condtitle=NULL;
        //$this->set('posts', array());
        $condmessage=NULL;
        $data=array();
        if ($this->request->is('post')){
            //$this->set('error', NULL);
            $title=$this->data['name'];
            $message=$this->data['name'];
            if (!empty($title))
                $condtitle="Post.title LIKE '%$title%'";
            if (!empty($message))
                $condmessage="Post.message LIKE '%$message%'";
            //$date=date("Y-m-d",mktime(NULL, NULL, NULL, $this->data['created']['month'],$this->data['created']['day'], $this->data['created']['year']));
            $conditions=array('OR'=>array('date(Post.created)'=>$date,$condtitle, $condmessage));
            if ($data = $this->Post->find('all', array('order'=>array('id'=>'DESC'), 'conditions'=>$conditions))){
                //$this->set('posts', $data);
                $this->set('posts', $this->paginate(null,$data));
            } else
            {
                $this->set('error', 'За даним запитом нічого не знайдено<br />');
            }*/
        
        
        //$conditions=$this->getConditions($searchColumns);
        //$this->set('posts', $this->paginate(null,$conditions));
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
