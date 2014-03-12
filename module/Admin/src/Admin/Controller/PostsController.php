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

    public function getAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function createAction()
    {
        $form = new PostForm();
        $categories = $this->getEntityManager()->getRepository('Application\Entity\Categories')->findAll();

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
            } else {
                var_dump($form->getMessages());
                die('Error');
            }
        }

        $response = new ViewModel(['form' => $form]);
        return $response;
    }

    public function uploadAction()
    {


        /*



          if ($form->isValid()) {
          $data = $form->getData();
          // Form is valid, save the form!
          $tempImgName = explode('public', $data['image-file']['tmp_name']);
          $success = new ViewModel(['img' => str_replace('\\', '/', $tempImgName[1])]);
          $success->setTemplate('application/upload/success.phtml');
          return $success;
          //$this->redirect()->toRoute('application',['controller'=>'upload','action'=>'success']);
          } else {
          // Form not valid, but file uploads might be valid...
          // Get the temporary file information to show the user in the view
          $fileErrors = $form->get('image-file')->getMessages();
          if (empty($fileErrors)) {
          $tempFile = $form->get('image-file')->getValue();
          }
          }
          }

          return array(
          'form' => $form,
          'tempFile' => $tempFile,
          ); */
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
