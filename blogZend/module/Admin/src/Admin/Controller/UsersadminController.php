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
        
        $this->checkUserLogged();
        $this->user_details = $this->session->offsetGet('user');
        $layout = new ViewModel(array("logged"=>1));
        $layout->setCaptureTo('layout/admin_layout');
        
        return new ViewModel(array("logged"=>1));
    }
}
