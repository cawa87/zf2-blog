<?php

namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Application\Form\UserReviewForm;

class ReviewController extends AbstractController
{

    public function indexAction()
    {

        $service = $this->getServiceLocator()->get('ReviewService');
        $reviews = $service->getList();
        //var_dump($categorie); die();
        return new ViewModel(['reviews' => $reviews]);
    }

    public function addAction()
    {

        $service = $this->getServiceLocator()->get('ReviewService');
        $form = new UserReviewForm;

        if ($this->request->isPost()) {

            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                $review = new \Application\Entity\UserReview($form->getData());

                $service->save($review, true);

                $this->redirect()->toRoute('home', ['controller' => 'review',
                    'action' => 'index']);
            }
        }

        return new ViewModel(['form' => $form]);
    }

}
