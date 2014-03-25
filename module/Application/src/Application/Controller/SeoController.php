<?php

namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class SeoController extends AbstractController
{

    public function robotsAction()
    {
        $vm = new ViewModel();
        $vm->setTerminal(true);
        return $vm;
    }

}
