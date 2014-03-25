<?php

namespace Admin\Controller;

use Admin\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Admin\Form\CategorieForm;
use Application\Entity\Categories as Categorie;

class CategoriesController extends AbstractController
{

    use \Application\Service\EntityManagerAccessor;

    protected $_serviceName = 'CategoriesService';

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

                $categorie = new Categorie($form->getData());

                $this->getService()->save($categorie,true);

                $this->flashMessenger()->addSuccessMessage('Категория создана');

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
                $categorie->fromArray( $form->getData());
                $this->getService()->save($categorie,true);


                $this->flashMessenger()->addSuccessMessage('Категория обновлена');

                $this->redirect()->toRoute('admin', ['controller' => 'categories',
                    'action' => 'index']);
            }
        }
    }

    public function deleteAction()
    {
        $categorieId = $this->params('id');

        $this->getService()->removeById($categorieId);

        $this->flashMessenger()->addInfoMessage('Категория удалена');

        $this->redirect()->toRoute('admin', ['controller' => 'categories',
            'action' => 'index']);
    }

}
