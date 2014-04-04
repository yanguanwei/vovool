<?php

namespace Youngx\Bundle\UserBundle\Form;

use Youngx\Bundle\UserBundle\Entity\User;
use Youngx\MVC\AppContext;
use Youngx\MVC\Event\GetResponseEvent;
use Youngx\MVC\Form;

class AdminAccountForm extends Form
{
    /**
     * @var User
     */
    protected $user;

    public function __construct()
    {
        parent::__construct('adminAccountForm');
    }

    protected function setup()
    {
        $this->add('username', '用户名')
            ->addValidator('required')
            ->addValidator('name');

        $this->add('email', 'E-mail')
            ->addValidator('required');

        if (!$this->user) {
            $this->add('password', '密码')
                ->addValidator('required');
            $this->add('password_confirm', '确认密码')
                ->addValidator('equalTo', array('password'));
        }
    }

    protected function validateInternal()
    {
        if (AppContext::repository()->exist('user', 'name=:name', array(':name' => $this->value('username')), $this->user)) {
            return array('name' => '用户名已经存在！');
        }
    }

    public function submit(GetResponseEvent $event)
    {
        $user = AppContext::repository()->create('user', array(
                'created_at' => date('Y-m-d H:i:s'),
                'salt' => 'a2m4k3'
            ));

        $user->set($this->toArray());
        $user->save();
        $this->user = $user;

        AppContext::flash()->add('success', AppContext::translate("Successfully saved the user <i>%user%</i>'s account information", array(
                    '%user%' => $user->get('username')
                )));

    }
}