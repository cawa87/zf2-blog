<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{

    public function indexAction()
    {
        $posts = $this->getServiceLocator()->get('PostService')->getRepository()->findAllByDate();
        return new ViewModel(['posts' => $posts]);
    }

}
