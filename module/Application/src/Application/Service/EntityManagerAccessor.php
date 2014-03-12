<?php

namespace Application\Service;

/**
 * Description of EntityManagerAccessor
 *
 * @author cawa
 */
trait EntityManagerAccessor
{

    protected $em;
    /**
     * Get EntityManager
     * @return \Doctrine\ORM\EntityManager;
     */
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

}
