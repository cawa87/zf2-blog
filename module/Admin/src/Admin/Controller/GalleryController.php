<?php

namespace Admin\Controller;

use Admin\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use \Application\Entity\GalleryImage as Image;
use Application\UploadAdapter\HttpAdapter;

class GalleryController extends AbstractController
{

    use \Application\Service\EntityManagerAccessor;

    protected $_serviceName = 'GalleryService';

    public function indexAction()
    {
        $images = $this->getService()->getList();
        return new ViewModel(['images' => $images]);
    }

    public function getAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function uploadAction()
    {
        $upload = new HttpAdapter();

        if (!$upload->getAdapter()->receive()) {
            $messages = $upload->getAdapter()->getMessages();
            return new ViewModel(['messages' => $messages]);
        } else {

            $image = new Image();
            $fileInfo = $upload->getAdapter()->getFileInfo();

            $tempImgName = explode('public', $fileInfo['uploadedfile']['tmp_name']);
            $image->setPath($tempImgName[1]);

            $image->setTitle($this->getRequest()->getPost()['title']);
            $this->getService()->save($image,true);

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
