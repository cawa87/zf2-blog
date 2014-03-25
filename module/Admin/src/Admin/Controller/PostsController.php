<?php

namespace Admin\Controller;

use Admin\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Admin\Form\PostForm;
use Application\Entity\BlogPost as Post;
use Application\Entity\BlogPostImages as Image;

class PostsController extends AbstractController
{

    protected $_serviceName = 'PostService';

    public function indexAction()
    {
        $posts = $this->getService()->getList();
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

            if ($form->isValid()) {
                $tempImgName = explode('public', $form->getData()['image-file']['tmp_name']);

                $image = new Image();

                $categorie = $this->getServiceLocator()->get('CategoriesService')
                        ->findById($form->getData()['categorie']);

                $post = new Post($form->getData());
                $post->setCategorie($categorie);
                $image->setPost($post);
                $image->setPath($tempImgName[1]);
               
                $this->getService()->save($post);
                $this->getService()->save($image, true);

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
        
    }

    public function deleteAction()
    {
        $postId = $this->params('id');

        $this->getService()->removeById($postId);

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
