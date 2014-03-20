<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM\EntityManager;
class AbstractController extends AbstractActionController {


     protected $_service;



    protected function extractArray($entity, EntityManager $em)
    {
        $hydrator = new DoctrineHydrator($em, get_class($entity));
        return $hydrator->extract($entity);
    }
    
    public function getService()
    {
        return $this->getServiceLocator()->get($this->_service);
    }

}
