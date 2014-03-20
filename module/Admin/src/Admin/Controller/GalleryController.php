<?php

namespace Admin\Controller;

use Admin\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Zend\Validator\File\Size;

class GalleryController extends AbstractController
{

    use \Application\Service\EntityManagerAccessor;

    protected $_service = 'GalleryService';

    public function indexAction()
    {
        $images = $this->getService()->getRepository()->findAll();
        return new ViewModel(['images' => $images]);
    }

    public function getAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function uploadAction()
    {
        $adapter = new \Zend\File\Transfer\Adapter\Http();

        $adapter->setDestination(BASE_DIR . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR .
                'img' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR);
        // Returns all known internal file information

        $size = new Size(array('max' => 2000000));


        $adapter->addFilter('File\Rename', array('target' => $adapter->getDestination() .
            DIRECTORY_SEPARATOR . uniqid() . '.jpeg',
            'overwrite' => true));
        $adapter->addValidator($size);


        if (!$adapter->receive()) {
            $messages = $adapter->getMessages();
            return new ViewModel(['messages' => $messages]);
        } else {

            $image = new \Application\Entity\GalleryImage();
            $fileInfo = $adapter->getFileInfo();
            $tempImgName = explode('public', $fileInfo['uploadedfile']['tmp_name']);
            $image->setPath($tempImgName[1]);
            $image->setTitle($this->getRequest()->getPost()['title']);
            $this->getService()->save($image);
            $this->flashMessenger()->addSuccessMessage('Изображеине загружено');

            $this->redirect()->toRoute('admin', ['controller' => 'gallery',
                'action' => 'index']);
        }
    }

    public function removeAction()
    {
        $imageId = $this->params('id');

        $this->getService()->removeById($imageId);
        
        $this->flashMessenger()->addInfoMessage('Изображение удалено');

        $this->redirect()->toRoute('admin', ['controller' => 'gallery',
            'action' => 'index']);
    }

}
