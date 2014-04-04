<?php

namespace Youngx\Bundle\PageBundle\Form;

use Youngx\MVC\Widget\FormWidget;

class AdminUrlAttributeForm extends PageVariableSettingsForm
{
    protected function setup()
    {
        $this->add('key', '变量名')
            ->addValidator('required');
    }

    protected function renderFieldForFormWidget(FormWidget $formWidget)
    {
        $formWidget->addFieldInput('key', 'text');
    }
}