<?php

/**
 * namespace
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository as Repository;
use Application\Entity\BlogPost;

/**
 * Class PostRepository
 * @package Application\Repository
 */
class PostRepository extends Repository
{

    public function findAllByDate()
    {
        return $this->findBy(array(), array('createdAt' => 'DESC'));
    }

}
