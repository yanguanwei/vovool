<?php

namespace Youngx\Bundle\UserBundle\Module\AdminUserModule;

use Youngx\Bundle\UserBundle\Entity\Role;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html\SelectHtml;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\Module;

class AdminUserModule extends Module implements ListenerRegistry
{
    public function onRoleSelectInput(array $attributes)
    {
        $attributes['multiple'] = true;
        $select = new SelectHtml($attributes);
        $select->setOptions(AppContext::db()->fetchAllKeyedField(Role::table(), 'id', 'name', 'id ASC'));

        return $select;
    }

    public static function registerListeners()
    {
        return array(
            'kernel.input#role-select' => 'onRoleSelectInput',
        );
    }
}