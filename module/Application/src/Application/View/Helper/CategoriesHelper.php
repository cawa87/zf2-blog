<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerName
 *
 * @author Cawa
 */


namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

class CategoriesHelper extends AbstractHelper
{

    protected $template;
    protected $em;


    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->template = new ViewModel();
        $this->template->setTemplate('templates/categories');
        //var_dump($this->template);die();
        $this->em = $em;
    }

    public function __invoke()
    {
        $categories = $this->em->getRepository('Application\Entity\Categories')->findAll();
        $this->template->setVariables(['categories'=>$categories]);
        return $this->getView()->render($this->template);
        
        
    }
}