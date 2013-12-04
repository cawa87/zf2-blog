<?php

namespace Application\Service;

/**
 * Description of PostService
 *
 * @author cawa
 */
use Doctrine\ORM\EntityManager;
use Application\Entity\BlogPost as Post;

class PostService
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getList()
    {

        $categories = $this->em->getRepository('Application\Entity\BlogPost')->findAll();
        return $categories;
    }

    public function getById($id)
    {
        $categorie = $this->em->getRepository('Application\Entity\BlogPost')->find($id);
        return $categorie;
    }

    public function save(Post $categorie)
    {
        try {
            $this->em->persist($categorie);
            $this->em->flush();
        } catch (\Doctrine\ORM\ORMException $ex) {
            var_dump($ex->getTrace());
        }
    }

    public function exchangeArray(Post $entity, Array $data)
    {

        $entity = $entity;
        array_walk($data, function(&$value, &$key) use(&$entity) {
            $entity->offsetSet($key, $value);
        });
    }

    
    public function deleteById($id)
    {
        $categorie = $this->em->getRepository('Application\Entity\BlogPost')->find($id);
        $this->em->remove($categorie);
        $this->em->flush();
    }
}
