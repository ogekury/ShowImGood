<?php
namespace Admin\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\LoginForm; 
use Admin\Model\User; 
use Admin\Controller\AdminController;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Debug\Debug;


class UsersadminController extends AdminController
{
    
	public function __construct() {
        parent::__construct();
    }
    
    
    public function indexAction() {
    	
    	$this->user_details = $this->session->offsetGet('user');
    	$this->user_modules = json_decode($this->user_details->modules);
    	$this->setLayoutVariables(array("module_name"=>"Users"));
    	
        $all_users = $this->getUSerTable()->fetchAll();
        $fields = array("id","username");
        $table = new ViewModel(array('to_show'=>$all_users,"fields"=>$fields));
        $table->setTemplate('components/table');
       
        $view = new ViewModel();
        $view->addChild($table,'table');
        
        return $view;
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
