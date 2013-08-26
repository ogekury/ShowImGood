<?php
namespace Front\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class FrontController extends AbstractActionController
{

    
    public function indexAction()
    {
    	$view = new ViewModel();
    	return $view;
    }

}