<?php

namespace Admin\Controller;

use Admin\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Application\Form\UserReviewForm;
use Application\Entity\UserReview as Review;

class ReviewController extends AbstractController
{

    protected $_serviceName = 'ReviewService';

    public function indexAction()
    {
        $reviews = $this->getService()->getList();
        return new ViewModel(['reviews' => $reviews]);
    }

    public function createAction()
    {
        $service = $this->getServiceLocator()->get('ReviewService');
        $form = new UserReviewForm;

        if ($this->request->isPost()) {

            $form->setData($this->request->getPost());
            if ($form->isValid()) {

                $review = new \Application\Entity\UserReview($form->getData());

                $service->save($review, true);
                $this->flashMessenger()->addInfoMessage('Отзыв создан!');
                $this->redirect()->toRoute('admin', ['controller' => 'review',
                    'action' => 'index']);
            } else {
                $this->flashMessenger()->addErrorMessage('Произошла ошибка!');
            }
        }

        $response = new ViewModel(['form' => $form]);
        return $response;
    }

    public function deleteAction()
    {
        $postId = $this->params('id');

        $this->getService()->removeById($postId);

        $this->flashMessenger()->addInfoMessage('Отзыв успешно удален');

        $this->redirect()->toRoute('admin', ['controller' => 'review',
            'action' => 'index']);
    }

}
