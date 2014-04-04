<?php

namespace Youngx\Bundle\UserBundle\Entity;

use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;
use Youngx\MVC\Query;
use Youngx\MVC\UserIdentity;

class User extends Entity implements UserIdentity
{
    const SuperAdministrator = 1;

    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $created_at;
    protected $phone;
    protected $roles;
    protected $is_active;
    protected $salt;

    private $updatedRoles;

    /**
     * @return array role ids
     */
    public function getRoles()
    {
        if ($this->roles === null) {
            $roles = array();
            $sql = "SELECT ur.role_id, r.role FROM y_user_role ur LEFT JOIN y_roles r ON r.id=ur.role_id WHERE ur.user_id=:user_id";
            foreach (AppContext::db()->query($sql, array(':user_id' => $this->getId()))->fetchAll() as $row) {
                $roles[intval($row['role_id'])] = $row['role'];
            }
            $this->roles = $roles;
        }
        return $this->roles;
    }

    public function getRoleIds()
    {
        return array_keys($this->getRoles());
    }

    public function setRoleIds(array $roles)
    {
        $this->updatedRoles = $roles;

        return $this;
    }

    public function hasRole($role)
    {
        $roles = $this->getRoles();
        return isset($roles[$role]) || array_search($role, $roles) !== false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getIsActive()
    {
        return $this->is_active;
    }

    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function updatePassword($password)
    {
        $this->password = $this->encryptPassword($password);
        return AppContext::db()->update($this->table(), array(
                'password' => $this->password
            ), 'id=:id', array(':id' => $this->id));
    }

    public function encryptPassword($password)
    {
        return md5(md5($password).$this->salt);
    }

    /**
     * @param $username
     * @return User
     */
    public static function findByUsername($username)
    {
        return self::find('username=:username', array(
                ':username' => $username
            ));
    }

    public static function type()
    {
        return 'user';
    }

    public static function table()
    {
        return 'y_users';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'username', 'email', 'password', 'created_at', 'is_active', 'salt', 'phone'
        );
    }

    protected function onAfterSave()
    {
        if ($this->updatedRoles !== null) {
            $db = AppContext::db();

            $db->delete('y_user_role', 'user_id=:user_id', array(':user_id' => $this->id));
            $data = array();
            $roles = $this->updatedRoles;
            if ($this->id == self::SuperAdministrator) {
                $roles[] = 1;
            }
            foreach ($roles as $roleId) {
                $data[$roleId] = array(
                    'user_id' => $this->id,
                    'role_id' => $roleId
                );
            }
            $db->insertMultiple('y_user_role', $data);
        }
    }

    public function __toString()
    {
        return $this->getUsername();
    }
}
