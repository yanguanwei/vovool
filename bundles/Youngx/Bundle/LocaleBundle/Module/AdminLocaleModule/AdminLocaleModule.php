<?php

namespace Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule;

use Youngx\Bundle\LocaleBundle\Entity\Locale;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html\SelectHtml;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\Module;

class AdminLocaleModule extends Module implements ListenerRegistry
{
    public function getModule()
    {
        return 'Admin';
    }

    public function onLocaleSelectInput(array $attributes)
    {
        $select = new SelectHtml($attributes);
        $select->setOptions(AppContext::db()->fetchAllKeyedField(Locale::table(), 'id', 'label', 'code ASC'));

        return $select;
    }

    public function onLocaleTypeSelectInput(array $attributes)
    {

        $select = new SelectHtml($attributes);
        $select->setOptions(array(
                'message' => 'message'
            ));

        return $select;
    }

    public static function registerListeners()
    {
        return array(
            'kernel.input#locale-select' => 'onLocaleSelectInput',
            'kernel.input#locale-type-select' => 'onLocaleTypeSelectInput'
        );
    }
}