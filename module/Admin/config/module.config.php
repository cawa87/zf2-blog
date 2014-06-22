<?php
namespace Admin;

return array(
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin[/[:controller[/[:action][/:id]]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*/?',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*/?',
                        'id' => '[0-9_-]*/?',
                    ),
                    'defaults' => array(
                        'controller' => 'index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true, 
            ),
            'login' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/user',
                    'defaults' => array(
                        'controller' => 'user',
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
            'index' => 'Admin\Controller\IndexController',
            'categories' => 'Admin\Controller\CategoriesController',
            'posts' => 'Admin\Controller\PostsController',
            'gallery' => 'Admin\Controller\GalleryController',
            'review' => 'Admin\Controller\ReviewController'
        ),
        'factories' => array(
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
