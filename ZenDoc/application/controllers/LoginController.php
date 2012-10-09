<?php

class LoginController extends Zend_Controller_Action
{
    private $session;

    public function init()
    {
        $this->session=new Zend_Session_Namespace();
    }

    public function indexAction()
    {
        Zend_Layout::getMvcInstance()->title='Login';
       
        $form    = new Application_Form_Login();
        $request = $this->getRequest();
        $this->view->form=$form;
        if ($this->getRequest()->isPost()) 
        {
            if ($form->isValid($request->getPost())) 
            {
                $user = new Application_Model_User($form->getValues());
                $mapper  = new Application_Model_UserMapper();
                //check credentials
                $mapper->authUser($user);
                if(!$user->getId())
                {   
                    $this->view->message="User not authorized";
                }
                else
                {
                    $this->session->user=$user->getId();
                    return $this->_helper->redirector('admin','');
                }
            }
        
        }
    }

    

    
}



