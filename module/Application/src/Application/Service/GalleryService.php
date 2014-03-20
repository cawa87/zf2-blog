<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Application\Service\EntityManagerAccessor;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Application\Entity\GalleryImage;

class GalleryService implements ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;

use EntityManagerAccessor;

    protected $_entity = 'Application\Entity\GalleryImage';

    public function getRepository()
    {
        return $this->getEntityManager()->getRepository($this->_entity);
    }

    public function removeById($id)
    {
        $imageRepo = $this->getRepository();
        $image = $imageRepo->find($id);

        unlink(BASE_DIR . DIRECTORY_SEPARATOR . 'public' . $image->getPath());

        $this->getEntityManager()->remove($image);
        $this->getEntityManager()->flush();
    }

    /**
     * Save GalleryImage
     * @param GalleryImage $post
     * @return GalleryImage
     */
    public function save(GalleryImage $image)
    {
        $this->getEntityManager()->persist($image);
        $this->getEntityManager()->flush();
        return $image;
    }

}
