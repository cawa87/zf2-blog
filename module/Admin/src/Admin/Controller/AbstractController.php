<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AbstractController extends AbstractActionController {


     protected $_service;



    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function getService()
    {
        return $this->_service;
    }

}
