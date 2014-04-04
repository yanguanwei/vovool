<?php

namespace Youngx\Bundle\PageBundle;

use Youngx\MVC\ClassTypeExtension;

interface PageVariableType extends ClassTypeExtension
{
    public function value(PageVariableSettings $settings);
    public function settingsForm();
}