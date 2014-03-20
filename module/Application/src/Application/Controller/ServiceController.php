<?php

namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class ServiceController extends AbstractController
{

    use \Application\Service\EntityManagerAccessor;

    public function indexAction()
    {
        return new ViewModel();
    }

}
