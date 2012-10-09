<?php

class AdminController extends Zend_Controller_Action
{
    private $session;

    public function init()
    {
        $this->session=new Zend_Session_Namespace();
    }

    public function indexAction()
    {
        if(!is_int($this->session->__get('user')))
        {
            $this->_helper->redirector('login','');
        }
        Zend_Layout::getMvcInstance()->title='Administration';
        $user = new Application_Model_User();
        $mapper  = new Application_Model_UserMapper();
        $mapper->find((int)$this->session->__get('user'),$user);
        $this->view->username=$user->getUsername();
    }


}

