<?php

return array(
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin[/[:controller[/[:action]/[:id]]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*/?',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*/?',
                        'id' => '[0-9_-]*/?',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            //'сategories' => 'Admin\Controller\CategoriesController',
            //'posts' => 'Admin\Controller\PostsController',
        ),
        'factories' => array(
            'categories' => function(Zend\Mvc\Controller\ControllerManager $cm) {
        return new \Admin\Controller\CategoriesController($cm->getServiceLocator()->get('CategorieService'));
    },
            'posts' => function(Zend\Mvc\Controller\ControllerManager $cm) {
        return new \Admin\Controller\PostsController($cm->getServiceLocator()->get('PostService'));
    },
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
