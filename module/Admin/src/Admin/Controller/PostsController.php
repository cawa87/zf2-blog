<?php

namespace Admin\Controller;

use Admin\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Application\Form\PostForm;
use Application\Entity\BlogPost as Post;
use Application\Service\PostService;

class PostsController extends AbstractController
{

    public function __construct(PostService $service)
    {
        $this->_service = $service;
    }

    public function indexAction()
    {
        $posts = $this->getService()->getList();
        return new ViewModel(['posts' => $posts]);
    }

    public function getAction()
    {

        $postId = $this->params('id');
        $categorie = $this->getService()->getById($postId);


        $form = new PostForm();
        $form->bind($categorie);

        $viewModel = new ViewModel(['form' => $form]);

        if ($this->request->isXmlHttpRequest()) {
            $viewModel->setTerminal(true);
        }
        return $viewModel;
    }

    public function createAction()
    {
        $form = new CategorieForm();

        $viewModel = new ViewModel(['form' => $form]);

        if ($this->request->isXmlHttpRequest()) {
            $viewModel->setTerminal(true);
        }

        if ($this->request->isPost()) {

            $form = new CategorieForm();

            $form->setData($this->request->getPost());
            if ($form->isValid()) {

                $categorie = new Categorie();

                $this->getService()->exchangeArray($categorie, $form->getData());
                $this->getService()->save($categorie);

                $this->flashMessenger()->addSuccessMessage('Categorie created');

                $this->redirect()->toRoute('admin', ['controller' => 'categories',
                    'action' => 'index']);
            }
        }
        return $viewModel;
    }

    public function updateAction()
    {
        if ($this->request->isPost()) {

            $form = new CategorieForm();

            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                $id = $form->getData();

                $categorie = $this->getService()->getById($id['id']);
                $this->getService()->exchangeArray($categorie, $form->getData());
                $this->getService()->save($categorie);


                $this->flashMessenger()->addSuccessMessage('Categorie updated');

                $this->redirect()->toRoute('admin', ['controller' => 'categories',
                    'action' => 'index']);
            }
        }
    }

    public function deleteAction()
    {
        $categorieId = $this->params('id');

        $this->getService()->deleteById($categorieId);

        $this->flashMessenger()->addInfoMessage('Categorie removed');

        $this->redirect()->toRoute('admin', ['controller' => 'categories',
            'action' => 'index']);
    }

}
