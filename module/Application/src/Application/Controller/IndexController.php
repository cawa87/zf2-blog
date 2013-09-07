<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        //$test = $em->getRepository('Application\Entity\Test')->findById(1);
        //$t = $test[0]->getTest();
        //var_dump($t->getText(),$test);die();
        $posts = $em->getRepository('Application\Entity\BlogPost')->findAll();
        return new ViewModel(['posts'=>$posts]);
    }
}
