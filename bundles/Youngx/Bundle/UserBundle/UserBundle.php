<?php

namespace Youngx\Bundle\UserBundle;

use Youngx\Bundle\UserBundle\Entity\Role;
use Youngx\MVC\AppContext;
use Youngx\MVC\Bundle;
use Youngx\MVC\EntityCollection;
use Youngx\MVC\Event\GetResponseEvent;
use Youngx\MVC\Event\GetResponseForExceptionEvent;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\ServiceRegistry;

class UserBundle extends Bundle implements ServiceRegistry, ListenerRegistry
{
    public function registerModules()
    {
        return array(
            'AdminUser'
        );
    }

    public function registerUserIdentityStorageService()
    {
        return new CookieIdentityStorage();
    }

    public static function registerServices()
    {
        return array(
            'userIdentityStorage' => 'Youngx\MVC\UserIdentityStorage'
        );
    }

    public function onHttpException401(GetResponseForExceptionEvent $event)
    {
        $event->setResponse(AppContext::redirectResponse(AppContext::generateUrl('user-login', array(
            'returnUrl' => AppContext::request()->getUri()
        ))));
    }

    public function onAccessibleForUserLogin()
    {
        if (AppContext::user()) {
            return false;
        }
        return true;
    }

    public function onAccessibleForUserLogout()
    {
        if (AppContext::user()) {
            return true;
        }
        return false;
    }

    public function onAccessibleDenyForUserLogin(GetResponseEvent $event)
    {
        $event->setResponse(AppContext::redirectResponse(AppContext::generateUrl('home')));
    }

    public function onAccessibleDenyForUserLogout(GetResponseEvent $event)
    {
        $event->setResponse(AppContext::redirectResponse(AppContext::generateUrl('user-login')));
    }

    public function onAccessibleForRole($roles)
    {
        $user = AppContext::user();
        if ($user) {
            if ($user->hasRole(Role::SUPER)) {
                return true;
            }

            if (is_array($roles)) {
                foreach ($roles as $role) {
                    if (!$user->hasRole($role)) {
                        return false;
                    }
                }
                return true;
            } else {
                return $user->hasRole($roles);
            }
        }
        return false;
    }

    public static function registerListeners()
    {
        return array(
            'kernel.exception.http#401' => 'onHttpException401',
            'kernel.accessible#user-login' => 'onAccessibleForUserLogin',
            'kernel.accessible#user-logout' => 'onAccessibleForUserLogout',
            'kernel.accessible.deny#user-login' => 'onAccessibleDenyForUserLogin',
            'kernel.accessible.deny#user-logout' => 'onAccessibleDenyForUserLogout',
            'kernel.accessible#role' => 'onAccessibleForRole',
        );
    }
}
