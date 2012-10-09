<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
   

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
    
    protected function _initAutoload()
    {

//        $config = array(
//            'name' => 'session',
//            'primary' => 'id',
//            'modifiedColumn' => 'modified',
//            'dataColumn' => 'data',
//            'lifetimeColumn' => 'lifetime'
//        );
//
//        Zend_Session::setSaveHandler(new Zend_Session_SaveHandler_DbTable($config));
//        Zend_Session::start();
        Zend_Controller_Action_HelperBroker::addPath(
            APPLICATION_PATH .'/controllers/helpers');
        Zend_Layout::startMvc();
        
    }

}

