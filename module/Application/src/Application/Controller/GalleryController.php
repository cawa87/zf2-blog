<?php

namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class GalleryController extends AbstractController
{

    use \Application\Service\EntityManagerAccessor;

    public function indexAction()
    {
        $images = $this->getServiceLocator()->get('GalleryService')->getList();
        return new ViewModel(['images' => $images]);
    }

}
