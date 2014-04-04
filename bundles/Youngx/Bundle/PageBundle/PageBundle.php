<?php

namespace Youngx\Bundle\PageBundle;

use Youngx\MVC\Bundle;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\ServiceRegistry;

class PageBundle extends Bundle implements ListenerRegistry, ServiceRegistry
{
    public function registerModules()
    {
        return array(
            'AdminPage', 'FrontPage'
        );
    }

    public function onPageVariableCollect()
    {
        return array(
            __NAMESPACE__ . '\PageVariable\EntityReference',
            __NAMESPACE__ . '\PageVariable\EntityList',
            __NAMESPACE__ . '\PageVariable\ArchiveContentList',
            __NAMESPACE__ . '\PageVariable\GroupPageList'
        );
    }

    public static function registerListeners()
    {
        return array(
            'page.variable.collect' => 'onPageVariableCollect'
        );
    }

    public static function registerServices()
    {
        return array(
            'pageVariableTypeCollection' => __NAMESPACE__.'\PageVariableTypeCollection',
        );
    }
}