<?php

namespace Youngx\Bundle\AdminBundle;

use Youngx\Bundle\UserBundle\Entity\Role;
use Youngx\MVC\AppContext;
use Youngx\MVC\Bundle;
use Youngx\MVC\Event\GetResponseEvent;
use Youngx\MVC\Event\GetResponseForExceptionEvent;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\MenuBuilder;
use Youngx\MVC\MenuCollection;

class AdminBundle extends Bundle implements ListenerRegistry
{
    public function initializeMenuCollection(MenuCollection $collection)
    {
        $collection->setPrefix('/admin');
    }

    public function onHttpException401ForAdmin(GetResponseForExceptionEvent $event)
    {
        $event->setResponse(AppContext::redirectResponse(AppContext::generateUrl('admin-login', array(
                        'returnUrl' => AppContext::request()->getUri()
                    ))));
    }

    public function onMenuForAdmin(MenuBuilder $menuBuilder)
    {
        if (!is_bool($menuBuilder->getAccessible()) && !in_array($menuBuilder->getName(), array('admin-login', 'admin-logout'))) {
            $menuBuilder->addRoleAccessible(Role::ADMIN);
        }
    }

    public function onAccessibleDenyForUserLogin(GetResponseEvent $event)
    {
        $event->setResponse(AppContext::redirectResponse(AppContext::generateUrl('admin')));
    }

    public function onAccessibleDenyForUserLogout(GetResponseEvent $event)
    {
        $event->setResponse(AppContext::redirectResponse(AppContext::generateUrl('admin-login')));
    }

    public function onValueOfAdminConfirmDelete($entityType, $id, $menu, array $params = array())
    {
        $parameters = array(
            'entityType' => $entityType,
            '_targetUrl' => AppContext::generateUrl($menu, $params)
        );

        if ($id) {
            $parameters['id'] = $id;
        }

        return AppContext::generateUrl('admin-confirm-delete', $parameters);
    }

    public static function registerListeners()
    {
        return array(
            'kernel.exception.http#401@collection:Admin' => 'onHttpException401ForAdmin',
            'kernel.accessible.deny#admin-login' => 'onAccessibleDenyForUserLogin',
            'kernel.accessible.deny#admin-logout' => 'onAccessibleDenyForUserLogout',
            'kernel.value#admin-confirm-delete' => 'onValueOfAdminConfirmDelete',
            'kernel.menu@collection:Admin' => 'onMenuForAdmin',
        );
    }
}