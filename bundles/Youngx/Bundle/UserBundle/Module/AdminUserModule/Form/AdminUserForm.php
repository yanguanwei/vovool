<?php

namespace Youngx\Bundle\UserBundle\Module\AdminUserModule\Form;

use Youngx\Bundle\UserBundle\Entity\Role;
use Youngx\Bundle\UserBundle\Entity\User;
use Youngx\MVC\AppContext;
use Youngx\MVC\EntityForm;

class AdminUserForm extends EntityForm
{
    protected function setup()
    {
        $this->add('username', '用户名')
            ->addValidator('required')
            ->addValidator('name')
            ->addFilter('trim');

        $this->add('role_ids', '角色', 'array');

        $this->add('email', 'E-Mail')
            ->addValidator('required')
            ->addFilter('trim');

        $this->add('phone', '手机号');

        $this->add('is_active', '状态');

        if ($this->entity->isNew() || AppContext::user()->hasRole(Role::SUPER)) {
            $this->add('password', '密码');
            if ($this->entity->isNew()) {
                $this->getField('password')
                    ->addValidator('required');
            }
        }
    }

    protected function onBindDataFromEntity($entity)
    {
        foreach ($this->getFields() as $name => $field) {
            if ($name != 'password') {
                $this->bindField($entity, $name);
            }
        }
    }

    protected function validateInternal()
    {
        $user = $this->getEntity();
        if (AppContext::repository()->exist('user', 'username=:username', array(':username' => $this->value('username')), $user)) {
            return array('username' => '用户名已经存在！');
        }
    }

    /**
     * @param User $entity
     * @param array $data
     */
    protected function onBindEntity($entity, array $data)
    {
        if (isset($data['password']) && !$data['password']) {
            unset($data['password']);
        }
        $entity->set($data);
    }

    /**
     * @param User $entity
     */
    protected function onBeforeEntitySave($entity)
    {
        if ($this->hasField('password') && $this->value('password')) {
            $entity->setPassword($entity->encryptPassword($entity->getPassword()));
        }
    }
}