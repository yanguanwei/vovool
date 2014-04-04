<?php

namespace Youngx\Bundle\PageBundle\Form;

use Youngx\MVC\Form;
use Youngx\MVC\Widget\FormWidget;

class AdminEntityReferenceForm extends PageVariableSettingsForm
{
    protected function setup()
    {
        $this->add('entity_code', 'Entity Code')
            ->addValidator('required');

        $this->add('entity_id', 'Entity ID')
            ->addValidator('required');
    }

    protected function renderFieldForFormWidget(FormWidget $formWidget)
    {
        $formWidget->addFieldInput('entity_code', 'entity-code-select');
        $formWidget->addFieldInput('entity_id', 'text');
    }
}