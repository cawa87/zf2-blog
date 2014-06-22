<?php

namespace Admin;

use Zend\EventManager\EventInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class Module
{

    public function onBootstrap(EventInterface $e)
    {

        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);


       /* $eventManager->attach(MvcEvent::EVENT_ROUTE, function($e) {
            $route = $e->getRouteMatch()->getMatchedRouteName();
            $controller = $e->getRouteMatch()->getParam('controller');
            $session = new Container('user');

            if ($route === 'admin' && !$session->offsetGet('auth') && $controller !== 'user') {
                $router = $e->getRouter();
                $url = $router->assemble(array(), array('name' => 'login'));
                $response = $e->getResponse();
                $response->getHeaders()->addHeaderLine('Location', $url);
                $response->setStatusCode(302);

                return $response;
            }
        });*/
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /* public function getAutoloaderConfig()
      {
      return array(
      'Zend\Loader\StandardAutoloader' => array(
      'namespaces' => array(
      __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
      ),
      ),
      );
      } */
}
