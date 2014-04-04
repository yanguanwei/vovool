<?php

namespace Youngx\Bundle\UserBundle\Entity;

use Youngx\MVC\Entity;
use Youngx\MVC\Query;

class Role extends Entity
{
    const MEMBER = 'member';
    const ADMIN = 'admin';
    const SUPER = 'super';

    protected $id;
    protected $name;
    protected $role;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public static function withUser(Query $query, User $user)
    {
        $query->leftJoinTable(array('y_user_roles', 'ur'), "ur.uid={$query->getAlias()}.uid");
        $query->where('ur.uid=?', $user->getId());

        return $query;
    }

    public static function type()
    {
        return 'role';
    }

    public static function table()
    {
        return 'y_roles';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array('id', 'name', 'role');
    }

    public function __toString()
    {
        return $this->getName();
    }
}