<?php

namespace Admin\Controller;

use Admin\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class TagsController extends AbstractController
{

    use \Application\Service\EntityManagerAccessor;

    protected $_service = 'TagService';

    public function indexAction()
    {
    }

    

}
