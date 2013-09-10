<?php
/* 
    Document   : ErrorController
    Created on : 05.09.2013, 11:37:11
    Author     : cawa
    Description:
       Error controller
*/


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ErrorController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
