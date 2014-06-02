<?php

namespace Application\Provider\Role;

use Application\Entity\Role;
use Doctrine\ORM\EntityManager;
use BjyAuthorize\Provider\Role\ProviderInterface;
use Application\Entity\User;
use Application\Entity\RoleLink;

/**
 * Role provider based on a {@see \Doctrine\ORM\EntityManager}
 *
 * @author Ben Youngblood <bx.youngblood@gmail.com>
 */
class UserProvider implements ProviderInterface
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $tableName = 'role';

    /**
     * @var string
     */
    protected $roleIdFieldName = 'role_id';

    /**
     * @var string
     */
    protected $parentRoleFieldName = 'parent_id';

    /**
     * @param array         $options
     * @param EntityManager $entityManager
     */
    public function __construct(array $options, $sm)
    {

        $entityManager = $sm->get('Doctrine\ORM\EntityManager');

        if (isset($options['table'])) {
            $this->tableName = $options['table'];
        }

        if (isset($options['role_id_field'])) {
            $this->roleIdFieldName = $options['role_id_field'];
        }

        if (isset($options['parent_role_field'])) {
            $this->parentRoleFieldName = $options['parent_role_field'];
        }

        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        // get roles associated with the logged in user
        $roles = array();

        $rowset = $this
                ->entityManager
                ->getConnection()
                ->createQueryBuilder()
                ->select($this->roleIdFieldName, $this->parentRoleFieldName)
                ->from($this->tableName, $this->tableName)
                ->execute();

        // Pass One: Build each object
        foreach ($rowset as $row) {
            $roleId = $row[$this->roleIdFieldName];
            $role = new Role();
            $role->setRoleId($roleId);
            //$role->setParent($row[$this->parentRoleFieldName]);
            $roles[$roleId] = $role;
        }

        // Pass Two:
        //Re-inject parent objects to preserve hierarchy
        /* @var $roleObj Role */
        foreach ($roles as $roleObj) {
            $parentRoleObj = $roleObj->getParent();

            if ($parentRoleObj && $parentRoleObj->getRoleId()) {
                $roleObj->setParent($roles[$parentRoleObj->getRoleId()]
                );
            }
        }
        return array_values($roles);
    }

    public function addRole(UserNew $user, $role = 'user')
    {

        $role = new RoleLink();
        $role->setUserId('1');
        $role->setUserEmail($user->getEmail());

        $this->entityManager->persist($role);
        $this->entityManager->flush();
        /* ->getConnection()
          ->createQueryBuilder()
          ->update('user_role_linker')
          //->update($this->tableName,$this->tableName)
          ->set('user_email', $user->getEmail())
          //->from($this->tableName,$this->tableName)
          ->execute(); */


        var_dump($user->getId());
        return $rowset;
    }

}
