<?php

namespace Application\Service;

/**
 * Description of CategoriesService
 *
 * @author cawa
 */
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Application\Service\EntityManagerAccessor;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Application\Entity\Categories as Categorie;

class CategoriesService implements ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;

use EntityManagerAccessor;

    public function getList()
    {

        $categories = $this->getEntityManager()->getRepository('Application\Entity\Categories')->findAll();
        return $categories;
    }

    public function getById($id)
    {
        $categorie = $this->getEntityManager()->getRepository('Application\Entity\Categories')->find($id);
        return $categorie;
    }

    public function save(Categorie $categorie)
    {

        try {
            $this->getEntityManager()->persist($categorie);
            $this->getEntityManager()->flush();
        } catch (\Doctrine\ORM\ORMException $ex) {
            var_dump($ex->getTrace());
        }
    }

    public function exchangeArray(Categorie $entity, Array $data)
    {

        $entity = $entity;
        array_walk($data, function(&$value, &$key) use(&$entity) {
            $entity->offsetSet($key, $value);
        });
    }

    public function deleteById($id)
    {
        $categorie = $this->getEntityManager()->getRepository('Application\Entity\Categories')->find($id);
        $this->getEntityManager()->remove($categorie);
        $this->getEntityManager()->flush();
    }

    public function getRepository()
    {
        
    }

}
