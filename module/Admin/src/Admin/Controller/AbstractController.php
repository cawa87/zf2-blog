<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM\EntityManager;

class AbstractController extends AbstractActionController
{

    /**
     *
     * @var stirng 
     * The name of the controller service
     */
    protected $_serviceName;

    /**
     * Service instance
     */
    protected $_service;

    /**
     * Creating array fom the entity by hidrating it 
     * @param DoctrineEntity $entity
     * @param \Doctrine\ORM\EntityManager $em
     * @return array
     * 
     */
    protected function extractArray($entity, EntityManager $em)
    {
        $hydrator = new DoctrineHydrator($em, get_class($entity));
        return $hydrator->extract($entity);
    }

    /**
     * 
     *  Setting the service for controller and returning the instance
     * @return Service
     */
    public function getService()
    {
        if (!isset($this->_service)) {
            $this->_service = $this->getServiceLocator()->get($this->_serviceName);
        }
        return $this->_service;
    }

}
