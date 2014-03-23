<?php

namespace Application\Service;

/**
 * Description of CategoriesService
 *
 * @author cawa
 */
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Application\Service\EntityManagerAccessor;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Application\Entity\Tags as Tags;

class TagService extends AbstractEntityService implements EntityServiceInterface
{

    protected $_entity = 'Application\Entity\Tags';


    

   

}
