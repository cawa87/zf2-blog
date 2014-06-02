<?php

namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class SearchController extends AbstractController
{

    public function indexAction()
    {
        $view = new ViewModel();

        $query = $this->params('q',null);
        
        $posts = $this->getServiceLocator()->get('PostService')->getRepository()->find
        
        $view->setVariables(['results']);
        return $view;
    }

}
