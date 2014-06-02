<?php

namespace Application\Provider\Identity;

use Doctrine\ORM\EntityManager;
use ZfcUser\Service\User;
use BjyAuthorize\Provider\Identity\ProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Application\Service\EntityManagerAccessor;

/**
 * Identity provider based on {@see \Doctrine\ORM\EntityManager}
 *
 */
class UserIdentity implements ProviderInterface, ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;

use EntityManagerAccessor;

    protected $roles = ['0' => 'guest', '1' => 'user', '2' => 'admin'];

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var string|\Zend\Permissions\Acl\Role\RoleInterface
     */
    protected $defaultRole;

    /**
     * @var string
     */
    protected $tableName = 'user_role_linker';

    /**
     * {@inheritDoc}
     */
    public function getIdentityRoles()
    {

        $authService = $this->getServiceLocator()->get('zfcuser_user_service')->getAuthService();

        if (false === $authService->hasIdentity()) {
            // get default/guest role
            return $this->getDefaultRole();
        } else {
            // get roles associated with the logged in user
            $builder = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getConnection()->createQueryBuilder();
            $builder->select("role_id")
                    ->from('user_role_linker', 'user_role_linker')
                    ->where('user_id=:user_id')
                    ->setParameter('user_id', $authService->getIdentity()->getId());
            $result = $builder->execute();
            $roles = array();

            foreach ($result as $row) {

                $roles[] = $this->roles[$row['role_id']];
            }



            return $roles;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultRole()
    {
        return $this->defaultRole;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultRole($defaultRole)
    {
        $this->defaultRole = $defaultRole;
    }

}
