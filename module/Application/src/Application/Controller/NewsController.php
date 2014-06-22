<?php


namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class NewsController extends AbstractController
{

    public function indexAction()
    {
        $categorieId = $this->params('categorie');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $posts = $this->getServiceLocator()->get('PostService')->getRepository()->findByCategorie($categorieId);
        if ($categorieId) {
            $categorie = $em->getRepository('Application\Entity\Categories')->find($categorieId);
        } else {
            $categorie = $em->getRepository('Application\Entity\Categories')->findAll();
        }
        //var_dump($categorie); die();
        return new ViewModel(['posts' => $posts, 'categorie' => $categorie]);
    }

    public function viewAction()
    {
        $postId = $this->params('id');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $post = $em->getRepository('Application\Entity\BlogPost')->findOneById(['id'=>$postId]);
        
        return new ViewModel(['post'=>$post]);
    }

}
