<?php
namespace Admin\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\LoginForm; 
use Admin\Model\User; 
use Admin\Controller\AdminController;
use Zend\Session\SessionManager;
use Zend\Session\Container;


class UsersadminController extends AdminController
{
    
	public function __construct() {
        parent::__construct();
    }
    
    
    public function indexAction() {
        $this->setLayoutVariables(array("module_name"=>"Users"));
    	return new ViewModel();
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
