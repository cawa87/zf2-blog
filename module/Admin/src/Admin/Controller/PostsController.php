<?php

namespace Admin\Controller;

use Admin\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Admin\Form\PostForm;
use Application\Entity\BlogPost as Post;
use Admin\Form\PostFormValidator;

class PostsController extends AbstractController
{

    use \Application\Service\EntityManagerAccessor;

    protected $_service = 'PostService';

    public function indexAction()
    {
        $posts = $this->getService()->getRepository()->findAll();
        return new ViewModel(['posts' => $posts]);
    }

    public function createAction()
    {
        $form = new PostForm();
        $categories = $this->getServiceLocator()->get('CategoriesService')->getList();

        foreach ($categories as $categorie) {
            $data[$categorie->getId()] = $categorie->getCategorieName();
        }

        $form->get('categorie')->setValueOptions($data);

        $response = $this->fileprg($form);

        if (is_array($response)) {
            $post = new Post();
            {
                $form->setData($response);
                // $form->setInputFilter($formValidator->getInputFilter());
            }
            if ($form->isValid()) {
                $tempImgName = explode('public', $form->getData()['image-file']['tmp_name']);

                $image = new \Application\Entity\BlogPostImages();
                $image->setPath($tempImgName[1]);
                $cat = $this->getEntityManager()->getRepository('Application\Entity\Categories')->findOneById($form->getData()['categorie']);
                $post->fromArray($form->getData());
                $post->setCategorie($cat);
                $image->setPost($post);
                $this->getEntityManager()->persist($post);
                $this->getEntityManager()->persist($image);
                $this->getEntityManager()->flush();

                $this->flashMessenger()->addSuccessMessage('Запись создана');
                $this->redirect()->toRoute('admin', ['controller' => 'posts',
                    'action' => 'index']);
            } else {
                $this->flashMessenger()->addErrorMessage('Произошла ошибка!');
            }
        }

        $response = new ViewModel(['form' => $form]);
        return $response;
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

        $this->flashMessenger()->addInfoMessage('Запись успешно удалена');

        $this->redirect()->toRoute('admin', ['controller' => 'posts',
            'action' => 'index']);
    }

    public function getAction()
    {
        $form = new PostForm();
        $postId = $this->params('id');
        $post = $this->getService()->getRepository()->findOneById($postId);
        $form->get('text')->setValue($post->getText());
        $response = new ViewModel(['form' => $form]);
        return $response;
    }

}
