<?php
/* 
    Document   : ErrorController
    Created on : 05.09.2013, 11:37:11
    Author     : cawa
    Description:
       Error controller
*/


namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class NewsController extends AbstractController 
{
    public function indexAction()
    {
        $categorieId = $this->params('categorie');
        
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $posts = $em->getRepository('Application\Entity\BlogPost')->findByCategorieId($categorieId);
        $categorie = $em->getRepository('Application\Entity\Categories')->find($categorieId);
 
        return new ViewModel(['posts'=>$posts,'categorie'=>$categorie]);
    }
}
