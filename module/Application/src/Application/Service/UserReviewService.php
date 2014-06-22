<?php

namespace Application\Service;

class UserReviewService extends AbstractEntityService
        implements EntityServiceInterface
{

    protected $_entity = 'Application\Entity\UserReview';

    public function getList()
    {
         return $this->getRepository()->findBy(array(), array('createdAt' => 'DESC'));
    }

}
