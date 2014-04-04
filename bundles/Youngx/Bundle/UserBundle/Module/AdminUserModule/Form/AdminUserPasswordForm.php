<?php

namespace Youngx\Bundle\UserBundle\Module\AdminUserModule\Form;

use Youngx\Bundle\UserBundle\Entity\User;
use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;
use Youngx\MVC\Form;

class AdminUserPasswordForm extends Form
{
    /**
     * @var User
     */
    protected $entity;

    public function __construct(User $user)
    {
        $this->bindEntity($user);
        parent::__construct('adminUserPassword');
    }

    protected function setup()
    {
        $this->add('password_old', '原密码')
            ->addValidator('required');
        $this->add('password', '密码')
            ->addValidator('required');
        $this->add('password_confirm', '确认密码')
            ->addValidator('equalTo', array('password'));
    }

    protected function validateInternal()
    {
        if ($this->entity->getPassword() != $this->entity->encryptPassword($this->value('password_old'))) {
            return array(
                'password_old' => AppContext::translate('Old password is not correct.')
            );
        }
    }

    public function bindEntity(Entity $entity)
    {
        $this->entity = $entity;

        return $this;
    }

    public function submit()
    {
        $this->entity->updatePassword($this->value('password'));
    }
}