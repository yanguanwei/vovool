<?php

namespace Youngx\Bundle\PageBundle\Form;

use Youngx\MVC\Form;
use Youngx\MVC\Widget\FormWidget;

class AdminEntityListForm extends PageVariableSettingsForm
{
    protected function setup()
    {
        $this->add('entity_code', 'Entity类型')
            ->addValidator('required');

        $this->add('page_size', '数量')
            ->addValidator('required');
    }

    protected function renderFieldForFormWidget(FormWidget $formWidget)
    {
        $formWidget->addFieldInput('entity_code', 'entity-code-select');
        $formWidget->addFieldInput('page_size', 'text');
    }
}