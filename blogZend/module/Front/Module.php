<?php
namespace Front;


use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


class Module
{
	
	
	public function onBootstrap($e)
	{
		$e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
			$controller = $e->getTarget();
			$controllerClass = get_class($controller);
			$moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
			$config = $e->getApplication()->getServiceManager()->get('config');
			if (isset($config['module_layouts'][$moduleNamespace])) {
				$controller->layout($config['module_layouts'][$moduleNamespace]);
			}
		}, 100);
	
	
	}
	
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Admin\Model\ContentTable' =>  function($sm) {
                	$tableGateway = $sm->get('ContentTableGateway');
                	$table = new ContentTable($tableGateway);
                	return $table;
                },
                'ContentTableGateway' => function ($sm) {
                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                	$resultSetPrototype = new ResultSet();
                	$resultSetPrototype->setArrayObjectPrototype(new Content());
                	return new TableGateway('content', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}