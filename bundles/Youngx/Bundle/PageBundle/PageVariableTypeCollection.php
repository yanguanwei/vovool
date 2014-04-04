<?php

namespace Youngx\Bundle\PageBundle;

use Youngx\MVC\ClassTypeExtensionCollection;

class PageVariableTypeCollection extends ClassTypeExtensionCollection
{
    public function __construct()
    {
        parent::__construct('page.variable.collect');
    }

    public function getSettingsForm($type)
    {
        return $this->getInstance($type)->settingsForm();
    }

    public function getValue($type, PageVariableSettings $settings)
    {
        return $this->getInstance($type)->value($settings);
    }
}