<?php

namespace Youngx\Bundle\AdminBundle\Module\AceModule;

use Youngx\MVC\Bundle;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\Module;

class AceModule extends Module implements ListenerRegistry
{
    public static function registerListeners()
    {
        return array(
            __NAMESPACE__ . '\Listener\TemplateListener',
        );
    }
}