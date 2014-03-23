<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Application\Service\EntityManagerAccessor;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Application\Service\EntityServiceInterface;
use Doctrine\ORM\ORMException;

/**
 * Description of AbstractEntityService
 *
 * @author cawa
 */
abstract class AbstractEntityService implements EntityServiceInterface, ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait,
        EntityManagerAccessor;

    
    /**
     * Name of the entity class
     * @var sting
     */
    protected $_entity;

    /**
     * Get repository for the entity class
     * @return Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->getEntityManager()->getRepository($this->_entity);
    }

    /**
     * Get array of all entities
     * @return DoctrineEntity[]
     */
    public function getList()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * Find entity by id
     * @param integer $id
     * @return DoctrineEntity
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Remove entity by id
     * @param integer $id
     */
    public function removeById($id)
    {
        $entity = $this->findById($id);

        try {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        } catch (ORMException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * 
     * @param DoctrineEntity $entity
     * @param array $data
     * @return type
     */
    public function exchangeArray($entity, array $data)
    {
        array_walk($data, function(&$value, &$key) use(&$entity) {
            $entity->offsetSet($key, $value);
        });
    }

    public function save($entity, $flush = false)
    {
        try {
            $this->getEntityManager()->persist($entity);
            if ($flush === true) {
                $this->getEntityManager()->flush();
            }
            return $entity;
        } catch (ORMException $ex) {
            echo $ex->getTraceAsString();
        }
    }

}
