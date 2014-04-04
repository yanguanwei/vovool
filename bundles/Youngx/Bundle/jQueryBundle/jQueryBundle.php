<?php

namespace Youngx\Bundle\jQueryBundle;

use Youngx\MVC\Bundle;
use Youngx\MVC\ListenerRegistry;

class jQueryBundle extends Bundle implements ListenerRegistry
{
    public static function registerListeners()
    {
        return array(
            __NAMESPACE__ . '\Listener\FormatListener'
        );
    }
}