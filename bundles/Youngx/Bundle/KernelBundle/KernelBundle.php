<?php

namespace Youngx\Bundle\KernelBundle;

use Doctrine\Common\Cache\FilesystemCache;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Youngx\MVC\AppContext;
use Youngx\MVC\Assets;
use Youngx\MVC\Database;
use Youngx\MVC\Menu;
use Youngx\MVC\ServiceRegistry;
use Youngx\MVC\Bundle;
use Youngx\MVC\EntityCollection;
use Youngx\MVC\Event\GetResponseForExceptionEvent;
use Youngx\MVC\Exception\HttpException;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\MenuCollection;
use Youngx\MVC\Repository;
use Youngx\MVC\Router;
use Youngx\MVC\Schema;

class KernelBundle extends Bundle implements ServiceRegistry, ListenerRegistry
{
    public function registerDatabaseService()
    {
        $database = new Database(
            AppContext::param('db.name'),
            AppContext::param('db.user'),
            AppContext::param('db.passwd'),
            AppContext::param('db.host'),
            AppContext::param('db.type', 'mysql'),
            AppContext::param('db.charset', 'UTF8')
        );

        return $database;
    }

    public function registerRepositoryService()
    {
        $repository = new Repository(AppContext::db(), AppContext::schema(), AppContext::app());

        return $repository;
    }

    public function registerSessionService()
    {
        $session = new Session();

        return $session;
    }

    public function registerCacheService()
    {
        $cache = new FilesystemCache(AppContext::locate('cache://doctrines'));

        return $cache;
    }

    public static function registerServices()
    {
        return array(
            'database' => array(
                'Youngx\Database\Connection',
                'Youngx\MVC\Database'
            ),
            'repository' => 'Youngx\MVC\Repository',
            'session' => 'Symfony\Component\HttpFoundation\Session\Session',
            'cache' => array(
                'Doctrine\Common\Cache\Cache',
                'Doctrine\Common\Cache\CacheProvider'
            )
        );
    }

    public function onHandleException(GetResponseForExceptionEvent $event)
    {
        $e = $event->getException();
        if ($e instanceof HttpException) {
            AppContext::dispatchOneWithMenu("kernel.exception.http#{$e->getStatusCode()}", array($event));
            if (!$event->hasResponse()) {
                $event->setResponse(new Response($e->getMessage(), $e->getStatusCode()));
            }
        }
    }

    public static function registerListeners()
    {
        return array(
            __NAMESPACE__ . '\Listener\RoutingListener',
            __NAMESPACE__ . '\Listener\ControllerListener',
            __NAMESPACE__ . '\Listener\TemplateListener',
            __NAMESPACE__ . '\Listener\BlockListener',
            __NAMESPACE__ . '\Listener\InputListener',
            __NAMESPACE__ . '\Listener\ValidateListener',
            __NAMESPACE__ . '\Listener\FilterListener',
            'kernel.exception' => 'onHandleException',
        );
    }
}