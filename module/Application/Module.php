<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\View\Helper\ControllerName;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        //controllerName helper factrory
        $e->getApplication()->getServiceManager()->get('viewhelpermanager')->setFactory('controllerName', function($sm) use ($e) {
            $viewHelper = new ControllerName($e->getRouteMatch());
            return $viewHelper;
        });

        $eventManager->attach('render', array($this, 'initView'));
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
      }
     */

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'db1_proxy' => function($sm) {
            return $sm->get('db1');
        }
            ),
            'invokables' => [
            //  'CategorieService' => 'Application\Service\CategorieService'
            ]
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
            ),
            'factories' => array(
                'categoriesHelper' => function($sm) {
            return new View\Helper\CategoriesHelper($sm->getServiceLocator()->get('doctrine.entitymanager.orm_default'));
        },
            ),
        );
    }

    public function initView(MvcEvent $e)
    {
        $helperManager = $e->getApplication()->getServiceManager()->get('viewhelpermanager');

        $helperManager->get('headmeta')->setCharset('utf-8')
                ->setName('viewport', 'width=device-width, initial-scale=1.0');

        //set layout by route
        $sm = $e->getApplication()->getServiceManager();
        $config = $sm->get('config');
        $helperManager = $sm->get('viewhelpermanager');
        $routeMatch = $e->getRouteMatch();
        $routeName = !is_null($routeMatch)
                ? $routeMatch->getMatchedRouteName()
                : '';

        if ($routeName != 'admin' && $routeName != 'login') {

            $helperManager->get('headtitle')->set('Чупырь Таисия,Визажист')->setSeparator(' - ')->setAutoEscape(false);

            $helperManager->get('headlink')
            /*      ->appendStylesheet('/css/bootstrap.min.css')
              ->appendStylesheet('/css/bootstrap-responsive.min.css')
              ->appendStylesheet('/css/style.css')
              ->appendStylesheet('/css/main.css')
              ->appendStylesheet('/css/icons/icons.css')
             */
            ->appendStylesheet('/css/icons/icons.css')
            ->appendStylesheet('/js/rs-plugin/css/settings.css')
            ->appendStylesheet('/css/combined.min.css')
            ->appendStylesheet('//fonts.googleapis.com/css?family=Seymour+One&subset=latin,cyrillic');

            $helperManager->get('headscript')
                    ->appendFile('/js/jquery.min.js')
                    ->appendFile('//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js')
                    //             ->appendFile('/js/jquery.min.js')
                    ->appendFile('/js/theme20.js')
                    //->appendFile('/js/bootstrap.min.js')
                    //             ->appendFile('/js/rs-plugin/pluginsources/jquery.themepunch.plugins.min.js')
                    ->appendFile('/js/rs-plugin/js/jquery.themepunch.revolution.min.js')
                    //->appendFile('/js/jquery.flexslider-min.js')
                    ->appendFile('/js/jquery.roundabout.min.js')
                    ->appendFile('/js/modernizr.custom.63321.js')
                    //            ->appendFile('/js/jquery.nanoscroller.min.js')
                    ->appendFile('/js/jquery.stapel.js')
                    ->appendFile('/js/jquery.prettyPhoto.js')
                    ->appendFile('/js/bootstrap.file-input.js')
                    ->appendFile('/js/custom.js');
            //   ->appendFile('/js/combined.js');
        } else {
            $helperManager->get('layout')->setTemplate('layout/admin');

            $helperManager->get('headtitle')->set('Zf2 blog admin')->setSeparator(' - ')->setAutoEscape(false);

            $helperManager->get('headlink')
                    ->appendStylesheet('/admin/css/bootstrap.min.css')
                    ->appendStylesheet('/admin/css/bootstrap-responsive.min.css')
                    ->appendStylesheet('/admin/css/style.css')
                    ->appendStylesheet('//fonts.googleapis.com/css?family=Open+Sans+Condensed:700&subset=latin,cyrillic-ext');

            $helperManager->get('headscript')
                    ->appendFile('//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js')
                    ->appendFile('//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js')
                    ->appendFile('//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/js/bootstrap.min.js')
                    ->appendFile('/js/bootstrap.file-input.js')
                    ->appendFile('/admin/js/site.js');
        }
    }

}
