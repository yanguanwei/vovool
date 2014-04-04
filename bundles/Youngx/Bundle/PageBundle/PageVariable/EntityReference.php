<?php

namespace Youngx\Bundle\PageBundle\PageVariable;

use Youngx\Bundle\PageBundle\Form\AdminEntityReferenceForm;
use Youngx\Bundle\PageBundle\PageVariableSettings;
use Youngx\Bundle\PageBundle\PageVariableType;
use Youngx\MVC\AppContext;

class EntityReference implements PageVariableType
{
    public static function name()
    {
        return 'entity-reference';
    }

    public static function label()
    {
        return 'Entity引用';
    }

    public function settingsForm()
    {
        return new AdminEntityReferenceForm();
    }

    public function value(PageVariableSettings $settings)
    {
        return AppContext::repository()->load(AppContext::schema()->getEntityTypeByCode($settings['entity_code']), $settings['entity_id']);
    }
}