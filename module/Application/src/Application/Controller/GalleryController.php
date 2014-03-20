<?php

namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class GalleryController extends AbstractController
{

    use \Application\Service\EntityManagerAccessor;

    public function indexAction()
    {
        $images = $this->getEntityManager()->getRepository('Application\Entity\GalleryImage')->findAll();
        return new ViewModel(['images' => $images]);
    }

}
