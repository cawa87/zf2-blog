<?php

namespace Admin\Controller;

use Admin\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class UserController extends AbstractController
{

    public function indexAction()
    {
        $vm = new ViewModel();
        $vm->setTerminal(true);
        return $vm;
    }

    public function guessAction()
    {
        $data = $this->getRequest()->getPost();
        var_dump($data);
        $session = new Container('user');
        if ($data->secret == '123456') {

            $session->offsetSet('auth', true);
            $this->redirect()->toRoute('admin', ['controller' => 'index']);
        }

        var_dump($session->offsetGet('auth'));
        $vm = new ViewModel();
        $vm->setTerminal(true);
        return $vm;
    }

}
