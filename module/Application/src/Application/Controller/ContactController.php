<?php
namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractController 
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
