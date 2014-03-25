<?php

namespace Application\Service;

class PostService extends AbstractEntityService
        implements EntityServiceInterface
{

    protected $_entity = 'Application\Entity\BlogPost';

    public function removeById($id)
    {
        $post = $this->findById($id);

        unlink(BASE_DIR . DIRECTORY_SEPARATOR . 'public' . $post->getImage()->getPath());

        $this->getEntityManager()->remove($post);
        $this->getEntityManager()->flush();
    }

}
