<?php

namespace Application\Service;

/**
 * Description of CategorieService
 *
 * @author cawa
 */
use Doctrine\ORM\EntityManager;
use Application\Entity\Categories as Categorie;

class CategorieService
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getList()
    {

        $categories = $this->em->getRepository('Application\Entity\Categories')->findAll();
        return $categories;
    }

    public function getById($id)
    {
        $categorie = $this->em->getRepository('Application\Entity\Categories')->find($id);
        return $categorie;
    }

    public function save(Categorie $categorie)
    {
        try {
            $this->em->persist($categorie);
            $this->em->flush();
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
        $categorie = $this->em->getRepository('Application\Entity\Categories')->find($id);
        $this->em->remove($categorie);
        $this->em->flush();
    }
}
