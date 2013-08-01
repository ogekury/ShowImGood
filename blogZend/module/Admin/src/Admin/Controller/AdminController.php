<?php
namespace Admin\Controller;



use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\LoginForm; 
use Admin\Model\User; 
use Zend\Session\SessionManager;
use Zend\Session\Container;

class AdminController extends AbstractActionController
{
    protected $userTable;
    
    protected $session;
    
    protected $user_details;
    
    public function __construct() {
        $this->session = new Container('admin');
    }
    
    public function indexAction()
    {
         //check if user is logged 
         $this->checkUserLogged();
         
         $this->user_details = $this->session->offsetGet('user');
         $this->layout()->logged = 1;
         //check and redirect in the first controller
         $user_modules = json_decode($this->user_details->modules);
         if( count($user_modules)>0 ){//if the user has at least a module assigned
             return $this->redirect()->toRoute($user_modules[0]->name.'admin',array('controller'=>$user_modules[0]->name.'admin','action' => 'index'));
         }
         return new ViewModel();
    }
    
    public function loginAction()
    {
        
        $form  = new LoginForm();
        $request = $this->getRequest();
        if($request->isPost()){
           $user = new User();
           $form->setInputFilter($user->getInputFilter());
           $form->setData($request->getPost());
           if ($form->isValid()) {
               $user = $this->getUSerTable()->getUser($request->getPost('username'),$request->getPost('password'));
               if($user){
                   $this->session->offsetSet('user', $user);
                   return $this->redirect()->toRoute('admin',array('controller'=>'admin'));
               }
           }
        }
        return array('form' => $form);
        
    }
    
    public function logoutAction()
    {
        $this->session->offsetUnset('user');
        return $this->redirect()->toRoute('admin',array('controller'=>'admin','action' => 'login'));
    }
    
    protected function checkUserLogged(){
        if(!$this->session->offsetGet('user')){
           return $this->redirect()->toRoute('admin',array('controller'=>'admin','action' => 'login'));
        }
        return true;
    }
    
    
    public function getUSerTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Admin\Model\UserTable');
        }
        return $this->userTable;
    }
    
    
    
}