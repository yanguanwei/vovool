<?php

namespace Youngx\Bundle\LocaleBundle;

use Youngx\MVC\Bundle;

class LocaleBundle extends Bundle
{
    public function registerModules()
    {
        return array(
            'AdminLocale'
        );
    }
}