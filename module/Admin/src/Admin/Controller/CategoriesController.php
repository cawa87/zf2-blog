<?php

namespace Admin\Controller;

use Admin\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Application\Form\CategorieForm;
use Application\Entity\Categories as Categorie;
use Application\Service\CategorieService;

class CategoriesController extends AbstractController
{

    public function __construct(CategorieService $service)
    {
        $this->_service = $service;
    }

    public function indexAction()
    {
        $categories = $this->getService()->getList();
        return new ViewModel(['categories' => $categories]);
    }

    public function getAction()
    {

        $categorieId = $this->params('id');
        $categorie = $this->getService()->getById($categorieId);


        $form = new CategorieForm();
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
