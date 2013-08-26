<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Front\Controller\Front' => 'Front\Controller\FrontController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'album' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/front[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Front\Controller\Front',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'front' => __DIR__ . '/../view',
        ),
    ),
	'module_layouts' => array(
		'Front' => 'layout/front_layout.phtml',
	),
);