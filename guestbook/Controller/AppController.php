<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');
//App::uses('Configure', 'Configure');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller 

{
    /**
     * components
     * 
     * Array of components to load for every controller in the application
     * 
     * @var $components array
     * @access public
     */
    public $components = array('Auth', 'Session');
    
    /**
     * beforeFilter
     * 
     * Ця дія обробляється перед будь-якою дією контроллера 
     * 
     * @access public 
     */
    
    public function beforeFilter(){
        
        //вказуємо layout
        $this -> layout = 'main';	
        //назва сторінки
        $this -> set( 'title_for_layout', 'Гостьова книга' );
        
        //Встановлюємо поля для авторизації у компоненті Auth замість тих, що стоять за замовчуванням
        //$this->Auth->fields = array('username'=>'email_address','password'=>'password');
        // Устанавливаем действия доступные без авторизации по всей системе
        //Зокрема вказуємо, що головна сторінка і сторінка перегляду... будуть відкриті завжди
        $this->Auth->allow(array('index', 'view', 'registration', 'search'));//, 'registration', 'add'));
        //Сторінка, на яку буде переходити користувач після виходу з системи
        $this->Auth->logoutRedirect = array('controller'=>'posts', 'action'=>'index');

        //Сторінка, на яку буде переходити користувач після входу у систему
        $this->Auth->loginRedirect = array('controller'=>'posts', 'action'=>'index');
        
        //Розширюємо компонент Auth за допомогою дії isAuthorized
        $this->Auth->authorize = 'controller';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        
        //Розширюємо доступ тільки тим користувачам, чиї профілі активні
        $this->Auth->userScope = array('User.active = 1');
        //Передаємо компонент авторизації на сторінки виду
        $this->set('Auth',$this->Auth->user());
    }
    
    /**
     * beforeRender
     * 
     * Ці дії будуть відбуватися перед тим, як формується сторінка 
     *
     * 
     * @access public 
     */
    public function beforeRender(){
        //Якщо користувач авторизований, то ми опрацьовуємо список 
        //дозволених для нього дій
        
         if($this->Auth->user()){
                $controllerList = App::objects('controller');//Configure
            $permittedControllers = array();
            foreach($controllerList as $controllerItem){
                if($controllerItem <> 'App'){
                    if($this->__permitted($controllerItem,'index')){
                        $permittedControllers[] = $controllerItem;
                    }
                }
            }
        }
        $this->set(compact('permittedControllers'));
    
    
    }
    
    /**
     * isAuthorized
     * 
     * Викликається компонентом Auth для перевіркм доступу до елементу
     * тут ми будемо проводити нашу перевірку
     * 
     * @return true if authorised/false if not authorized
     * @access public
     */
    public function isAuthorized(){
        return $this->__permitted($this->name,$this->action);
    }
    
    /**
     * __permitted
     * 
     * Допоміжна функція, яка проводить перевірку прав користувача
     * описаних у формі $controllerName:$actionName
     * 
     * @return 
     * @param $controllerName Object
     * @param $actionName Object
     */
    private function __permitted($controllerName,$actionName){
        //Ім'я контроллера і екшена вказуємо у нижньому регістрі
        $controllerName = strtolower( $controllerName );
        $actionName = strtolower( $actionName );
        //Якщо у сесії права не були закешовані
        //(перевіряємо чи існує змінна сесії)
        if(!$this->Session->check('Permissions')){
            //...то готуємо масив для збереження
            $permissions = array();
            //у всіх є право вийти з системи
            $permissions[]='users:logout';
            //Імпортуємо модель користувача, щоб отримати права
            App::import('Model', 'User');
            $thisUser = new User;
            //Отримуємо поточного користувача і його групу
            $thisGroups = $thisUser->find('first', array ('conditions' => 
                array('User.id'=>$this->Auth->user('id'))));
            $thisGroups = $thisGroups['Group'];
            foreach($thisGroups as $thisGroup){
                $thisPermissions = $thisUser->Group->find('first', array ('conditions' =>
                    array('Group.id'=>$thisGroup['id'])));
                $thisPermissions = $thisPermissions['Permission'];
                foreach($thisPermissions as $thisPermission){
                    $permissions[]=$thisPermission['name'];
                }
            }
            //Записуємо права у сесію
            $this->Session->write('Permissions',$permissions);
        }else{
            //...права закешовані, загружаємо із сесії
            $permissions = $this->Session->read('Permissions');
        }
        //Шукаємо серед прав ті, які відповідають поточному користувачу
        foreach($permissions as $permission){
            if($permission == '*'){
                return true;//Знайдено права СуперАдміна
            }
            if($permission == $controllerName.':*'){
                return true;//Дозволяються всі дії у даному контроллері
            }
            if($permission == $controllerName.':'.$actionName){
                return true;//Знайдено визначену дію
            }
        }
        return false;
    }
}