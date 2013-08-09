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
use Admin\Form\UserEditForm;

class UsersadminController extends AdminController
{
    
	public function __construct() {
        parent::__construct();
    }
    
    
    public function indexAction() 
    {
    	
    	
    	$this->setAdminModVars(array("users"=>array("href"=>"","class"=>"current")));
    	//get all the users
        $all_users = $this->getUSerTable()->fetchAll();
        $fields = array("id","username");
        $edit_address = $this->url()->fromRoute('usersadmin',array("controller"=>"useradmin","action"=>"edituser"));
        $table = new ViewModel(array('to_show'=>$all_users,"fields"=>$fields,"edit_address"=>$edit_address));
        $table->setTemplate('components/table');
       
        $view = new ViewModel();
        $view->addChild($table,'table');
        return $view;
    }
    
	public function edituserAction() 
	{
		//set vars and pass the breacrumbs
		$this->setAdminModVars(array("users"=>array("href"=>$this->url()->fromRoute('usersadmin'),"class"=>"current"),
		    						  "edit_user"=>array("href"=>"","class"=>"current")));
		 
		$edit_id = (int) $this->params()->fromRoute('id', 0);
		$user = $this->getUSerTable()->getUserById($edit_id);
		if(!$user){//redirect if user doesn't exists
			$this->redirect()->toRoute('admin',array('controller'=>'useradmin','action' => 'index'));
		}
		
		$edit_form = new UserEditForm('user',$user);
		$edit_form->bind($user);
		$form_tpl = new ViewModel(array("form"=>$edit_form,"module_name"=>"User"));
		$form_tpl->setTemplate('components/edit_form');
		
		$view = new ViewModel();
		$view->addChild($form_tpl,'edit_form');
		
		return $view;
	}
	
	
	public function newuserAction()
	{
		$this->setAdminModVars(array("users"=>array("href"=>$this->url()->fromRoute('usersadmin'),"class"=>"current"),
									  "new_user"=>array("href"=>"","class"=>"current")));
		$edit_form = new UserEditForm('user',$this->user_details);
		$form_tpl = new ViewModel(array("form"=>$edit_form,"module_name"=>"User"));
		$form_tpl->setTemplate('components/edit_form');
		
		$view = new ViewModel();
		$view->addChild($form_tpl,'new_form');
		
		return $view;
	}
	
	public function yourProfileAction()
	{
		$this->setAdminModVars();
		$this->redirect()->toUrl('/usersadmin/edituser/'.$this->user_details->id);
	}
	
	public function viewallusersAction()
	{
		$this->redirect()->toRoute('usersadmin');
	}
	
    
	protected function setAdminModVars($breadcrumbs=null)
	{
		$this->user_details = $this->session->offsetGet('user');
		$this->user_modules = json_decode($this->user_details->modules);
		if($breadcrumbs){
			$this->setLayoutVariables(array("breadcrumbs"=>$breadcrumbs));
		}
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
