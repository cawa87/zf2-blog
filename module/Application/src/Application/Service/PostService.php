<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Application\Service\EntityManagerAccessor;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class PostService implements ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;

use EntityManagerAccessor;

    public function getRepository()
    {
        return $this->getEntityManager()->getRepository('Application\Entity\BlogPost');
    }

    public function deleteById($id)
    {
        $post = $this->getEntityManager()->getRepository('Application\Entity\BlogPost')->find($id);
        $this->getEntityManager()->remove($post);
        $this->getEntityManager()->flush();
    }

}
