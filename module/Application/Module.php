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
        $eventManager        = $e->getApplication()->getEventManager();
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

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
            ),
        );
    }
    
    
    public function initView(MvcEvent $e)
    {
        $helperManager = $e->getApplication()->getServiceManager()->get('viewhelpermanager');

        $helperManager->get('headmeta')->setCharset('utf-8')
                                       ->setName('viewport', 'width=device-width, initial-scale=1.0');
        
        $helperManager->get('headtitle')->set('Zf2 blog system')->setSeparator(' - ')->setAutoEscape(false);

        $helperManager->get('headlink')
                        ->appendStylesheet('/css/bootstrap.min.css')
                        ->appendStylesheet('/css/bootstrap-responsive.min.css')
                        ->appendStylesheet('/css/style.css')
                        ->appendStylesheet('/css/main.css')
                        ->appendStylesheet('/js/rs-plugin/css/settings.css')
                        ->appendStylesheet('//fonts.googleapis.com/css?family=Oswald')
                        ->appendStylesheet('/css//icons/icons.css');
        
        $helperManager->get('headscript')->appendFile('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js')
                                         ->appendFile('//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js')
                                         ->appendFile('/js/jquery.min.js')
                                         ->appendFile('/js/theme20.js')
                                         ->appendFile('/js/bootstrap.min.js')
                                         ->appendFile('/js/rs-plugin/pluginsources/jquery.themepunch.plugins.min.js')
                                         ->appendFile('/js/rs-plugin/js/jquery.themepunch.revolution.min.js')
                                         ->appendFile('/js/jquery.prettyPhoto.js')
                                         ->appendFile('/js/jquery.flexslider-min.js')
                                         ->appendFile('/js/jquery.jplayer.js')
                                         ->appendFile('/js/jquery.nanoscroller.js')
                                         ->appendFile('/js/twitter/jquery.tweet.js')
                                         ->appendFile('/js/jquery.prettyPhoto.js')
                                         ->appendFile('/js/custom.js');
                                  

        
    }
    
    
}
