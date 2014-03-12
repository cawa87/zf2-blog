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
    /**
     * Save PostRepository
     * @param PostRepository $post
     * @return BlogPost
     */
    public function save(BlogPost $post)
    {
        $this->_em->persist($post);
        $this->_em->flush();
        return $post;
    }

    /**
     * Delete BlogPost
     * @param BlogPost $post
     */
    public function delete(BlogPost $post)
    {
        $this->_em->remove($post);
        $this->_em->flush();
    }


}