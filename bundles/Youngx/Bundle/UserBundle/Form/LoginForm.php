<?php

namespace Youngx\Bundle\UserBundle\Form;

use Youngx\Bundle\UserBundle\Entity\User;
use Youngx\MVC\AppContext;
use Youngx\MVC\Form;

class LoginForm extends Form
{
    protected function setup()
    {
        $this->add('username', 'text', AppContext::translate('Username'))
            ->addValidator('required')
            ->addFilter('trim');

        $this->add('password', 'password', AppContext::translate('Password'))
            ->addValidator('required');

        $this->add('rememberMe', 'checkbox', AppContext::translate('Remember Me'));
    }

    protected function validateInternal()
    {
        $user = User::findByUsername($this->value('username'));
        if ($user && $user instanceof User) {
            if ($user->getPassword() === $user->encryptPassword($this->value('password'))) {
                if (!$user->getIsActive()) {
                    return array(
                        'username' => '用户未激活！'
                    );
                }
                AppContext::login($user, $this->value('rememberMe') ? 86400 * 365 : 0);
            } else {
                return array(
                    'password' => '密码错误！'
                );
            }
        } else {
            return array(
                'username' => '用户不存在！'
            );
        }
    }
}