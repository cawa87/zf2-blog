<?php

namespace Application\Service;

use Application\Service\AbstractEntityService;
use Application\Service\EntityServiceInterface;

class GalleryService extends AbstractEntityService
        implements EntityServiceInterface
{

    protected $_entity = 'Application\Entity\GalleryImage';

    public function removeById($id)
    {
        $image = $this->findById($id);

        unlink(BASE_DIR . DIRECTORY_SEPARATOR . 'public' . $image->getPath());

        $this->getEntityManager()->remove($image);
        $this->getEntityManager()->flush();
    }

}
